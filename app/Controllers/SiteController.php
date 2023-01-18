<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Controllers;

use Lowel\Workproject\App\Exceptions\IncorrectAuthDataException;
use Lowel\Workproject\App\Exceptions\UserAlreadyExistsException;
use Lowel\Workproject\App\Exceptions\ValidationException;
use Lowel\Workproject\App\Services\Auth;

class SiteController extends AbstractController
{
    function index(): string
    {
        return self::render('index');
    }

    function post()
    {
        try {
            Auth::$instance->register(
                'admin', 'admin',
                'name', 'name',
                88888888
            );
        } catch (\Throwable $e) {
        }

        $this->response->json([
            'data' => Auth::$instance->user
        ]);
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
        $username = input('username');
        $first_name = input('first_name');
        $last_name = input('last_name');
        $phone = input('phone');
        $password = input('password');
        $password_confirm = input('password_confirm');

        try {
            Auth::$instance->register($username, $first_name, $last_name, $phone, $password, $password_confirm);
        } catch (UserAlreadyExistsException $e) {
            redirect(route(
                'register_form',
                null,
                ['old' => ['username' => $username, 'first_name' => $first_name, 'last_name' => $last_name, 'phone' => $phone], 'validation_error' => ['username' => "Пользователь под ником '$e->username' уже существует!"]]
            ));

        } catch (ValidationException $e) {
            redirect(route(
                'register_form',
                null,
                ['old' => ['username' => $username, 'first_name' => $first_name, 'last_name' => $last_name, 'phone' => $phone], 'validation_error' => $e->getErrors()]
            ));

        }

        redirect(route('home'));
    }
}