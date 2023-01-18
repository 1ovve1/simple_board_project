<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Services;

use Lowel\Workproject\App\Exceptions\IncorrectAuthDataException;
use Lowel\Workproject\App\Exceptions\UserAlreadyExistsException;
use Lowel\Workproject\App\Exceptions\ValidationException;
use Lowel\Workproject\App\Repositories\UsersRepository;

class Auth
{
    public static ?Auth $instance = null;
    public readonly ?array $user;

    /**
     * Singleton auth init
     * @return void
     */
    static function start(): void
    {
        self::$instance = new Auth();
    }

    /**
     * Check if session is active and fill field $user
     */
    private function __construct()
    {
        session_start();

        if (isset($_SESSION['user_id'])) {
            $this->user = UsersRepository::findUserDataById($_SESSION['user_id']);
        } else {
            $this->user = null;
        }
    }

    /**
     * Check if user exists and data for login is correct
     * @param string $username
     * @param string $password
     * @return void
     * @throws IncorrectAuthDataException
     */
    function login(string $username, string $password): void
    {
        $user = UsersRepository::findUserByUsername($username);

        if ($user === false || password_verify($password, $user['password_hash']) === false) {
            throw new IncorrectAuthDataException($username);
        }

        self::addUserToSession($user['id']);
    }

    /**
     * Add user data into $_SESSION
     * @param int $user_id
     * @return void
     */
    private function addUserToSession(int $user_id): void
    {
        $_SESSION['user_id'] = $user_id;

        Auth::start();
    }

    /**
     * @return void
     */
    function logout(): void
    {
        self::removeUserFromSession();
    }

    /**
     * @return void
     */
    private function removeUserFromSession(): void
    {
        $_SESSION['user_id'] = null;

        Auth::start();
    }

    /**
     * Register user and add him to session
     * @param string $username
     * @param string $first_name
     * @param string $last_name
     * @param string $phone
     * @param string $password
     * @param string $password_confirm
     * @return void
     * @throws UserAlreadyExistsException|ValidationException
     */
    function register(string $username, string $first_name,
                      string $last_name, string $phone,
                      string $password, string $password_confirm): void
    {
        self::validate($username, $first_name, $last_name, $phone, $password, $password_confirm);

        if (UsersRepository::isUserExists($username)) {
            throw new UserAlreadyExistsException($username);
        }

        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $userId = UsersRepository::addUser($username, $password_hash, $first_name, $last_name, $phone);

        self::addUserToSession($userId);
    }

    /**
     * God, please, forgive it for me....
     * @param string $username
     * @param string $first_name
     * @param string $last_name
     * @param string $phone
     * @param string $password
     * @param string $password_confirm
     * @return void
     * @throws ValidationException
     */
    function validate(string $username, string $first_name,
                      string $last_name, string $phone,
                      string $password, string $password_confirm): void
    {
        if (strlen($password) > 255 || strlen($password) < 8) {
            throw new ValidationException('password', 'Слишком длинный пароль! (до 255 символов)');
        }
        if ($password !== $password_confirm) {
            throw new ValidationException('password', 'Подтверждение пароля не соответствует паролю!');
        }
        if (strlen($username) > 50) {
            throw new ValidationException('username', 'Слишком длинный логин! (до 50 символов)');
        }
        if (strlen($first_name) > 50) {
            throw new ValidationException('first_name', 'Слишком длинное имя! (до 50 символов)');
        }
        if (strlen($last_name) > 50) {
            throw new ValidationException('last_name', 'Слишком длинная фамилия! (до 50 символов)');
        }
        if (strlen($phone) > 50) {
            throw new ValidationException('phone', 'Слишком длинный номер телефона! (до 50 символов)');
        }
        if (!preg_match('/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/', $phone)) {
            throw new ValidationException('phone', 'Неверный формат телефона! (поддерживаются ТОЛЬКО номера РФ)');
        }
    }

    /**
     * @return array|null
     */
    static function user(): ?array
    {
        return self::$instance->user;
    }
}