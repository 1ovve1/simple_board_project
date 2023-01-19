<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Controllers;

use Lowel\Workproject\App\Exceptions\IncorrectAuthDataException;
use Lowel\Workproject\App\Exceptions\UserAlreadyExistsException;
use Lowel\Workproject\App\Exceptions\ValidationException;
use Lowel\Workproject\App\Services\Auth;
use Lowel\Workproject\App\Validators\IValidator;
use Lowel\Workproject\App\Validators\UserRegistrationValidator;

class SiteController extends AbstractController
{
    private IValidator $validator;

    public function __construct()
    {
        $this->validator = new UserRegistrationValidator();
        parent::__construct();
    }


    function index(): string
    {
        return self::render('index');
    }

    /**
     * @return string
     */
    function loginForm(): string
    {
        return self::render('login');
    }

    /**
     * @return void
     */
    function logout(): void
    {
        Auth::$instance->logout();

        redirect(route('index'));
    }

    function login()
    {
        $username = input('username');
        $password = input('password');

        try {
            Auth::$instance->login($username, $password);
        } catch (IncorrectAuthDataException $e) {
            return self::render('login', ['username_not_found' => $e->username]);
        }

        return self::render('index');
    }

    /**
     * @return string
     */
    function registerForm(): string
    {
        return self::render(
            'register',
            ['old' => input('old', null), 'validation_error' => input('validation_error')]
        );
    }

    /**
     * @return void
     */
    function register(): void
    {

        try {
            $args = $this->validator->validate();

            extract($args);

            Auth::$instance->register($username, $first_name, $last_name, $phone, $password, $password_confirm);
        } catch (UserAlreadyExistsException $e) {
            redirect(route(
                'register_form',
                null,
                ['old' => input()->all(['username', 'first_name', 'last_name', 'phone']), 'validation_error' => $e->getErrors()]
            ));

        } catch (ValidationException $e) {
            redirect(route(
                'register_form',
                null,
                ['old' => input()->all(['username', 'first_name', 'last_name', 'phone']), 'validation_error' => $e->getErrors()]
            ));

        }

        redirect(route('home'));
    }
}