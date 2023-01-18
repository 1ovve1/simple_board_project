<?php declare(strict_types=1);

use Lowel\Workproject\App\Controllers\SiteController;
use Lowel\Workproject\App\Middleware\AuthMiddleware;
use Pecee\SimpleRouter\SimpleRouter as Router;

Router::group([
    'middleware' => AuthMiddleware::class
], function () {
    Router::get('/', [SiteController::class, 'index'], ['as' => 'index']);
    Router::get('/home', [SiteController::class, 'home'], ['as' => 'home']);

    Router::get('/login', [SiteController::class, 'loginForm'], ['as' => 'login_form']);
    Router::post('/login', [SiteController::class, 'login'], ['as' => 'login']);

    Router::post('/logout', [SiteController::class, 'logout'], ['as' => 'logout']);

    Router::get('/register', [SiteController::class, 'registerForm'], ['as' => 'register_form']);
    Router::post('/register', [SiteController::class, 'register'], ['as' => 'register']);
});