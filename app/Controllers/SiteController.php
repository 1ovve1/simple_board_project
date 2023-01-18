<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Controllers;

use Lowel\Workproject\App\Exceptions\IncorrectAuthDataException;
use Lowel\Workproject\App\Exceptions\UserAlreadyExistsException;
use Lowel\Workproject\App\Services\Auth;

class SiteController extends AbstractController
{
    function index(): string
    {
        return self::render('welcome');
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

    function logout()
    {
        Auth::$instance->logout();

        return self::render('welcome');
    }

    function login()
    {
        try {
            Auth::$instance->login('admin', 'admin');
        } catch (IncorrectAuthDataException $e) {
            echo '<pre>';
            var_dump($e);
            echo '</pre>';
            die();
        }

        return self::render('welcome');
    }
}