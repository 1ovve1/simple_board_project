<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Services;

use Lowel\Workproject\App\Exceptions\IncorrectAuthDataException;
use Lowel\Workproject\App\Exceptions\UserAlreadyExistsException;
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
        $login_accept = password_verify($password, $user['password_hash']);

        if ($user === false || $login_accept === false) {
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
        session_start();

        $_SESSION['user_id'] = $user_id;

        Auth::start();
    }

    function logout(): void
    {
        self::removeUserFromSession();
    }

    private function removeUserFromSession(): void
    {
        session_start();

        $_SESSION['user_id'] = null;

        Auth::start();
    }

    /**
     * Register user and add him to session
     * @param string $username
     * @param string $password
     * @param string $first_name
     * @param string $last_name
     * @param int|null $phone
     * @return void
     * @throws UserAlreadyExistsException
     */
    function register(string $username, string $password,
                      string $first_name, string $last_name,
                      ?int $phone = null): void
    {

        if (UsersRepository::isUserExists($username)) {
            throw new UserAlreadyExistsException($username);
        }

        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $userId = UsersRepository::addUser($username, $password_hash, $first_name, $last_name, $phone);

        self::addUserToSession($userId);
    }
}