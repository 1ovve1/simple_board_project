<?php declare(strict_types=1);

use Lowel\Workproject\App\Controllers\BoardsController;
use Lowel\Workproject\App\Controllers\SiteController;
use Lowel\Workproject\App\Middleware\AuthMiddleware;
use Lowel\Workproject\App\Middleware\OnlyAuthMiddleware;
use Pecee\SimpleRouter\SimpleRouter as Router;

Router::group([
    'middleware' => AuthMiddleware::class
], function () {
    Router::get('/', [SiteController::class, 'index'], ['as' => 'index']);

    Router::get('/login', [SiteController::class, 'loginForm'], ['as' => 'login_form']);
    Router::post('/login', [SiteController::class, 'login'], ['as' => 'login']);

    Router::post('/logout', [SiteController::class, 'logout'], ['as' => 'logout']);

    Router::get('/register', [SiteController::class, 'registerForm'], ['as' => 'register_form']);
    Router::post('/register', [SiteController::class, 'register'], ['as' => 'register']);

    Router::group(['prefix' => '/home', 'middleware' => OnlyAuthMiddleware::class], function() {
        Router::group(['prefix' => '/boards'], function() {
            Router::get('/', [BoardsController::class, 'index'], ['as' => 'home']);

            Router::get('/add', [BoardsController::class, 'store'], ['as' => 'boards.store']);
            Router::post('/add', [BoardsController::class, 'create'], ['as' => 'boards.create']);

            Router::get('/edit/{id}', [BoardsController::class, 'edit'], ['as' => 'boards.edit']);
            Router::post('/update/{id}', [BoardsController::class, 'update'], ['as' => 'boards.update']);

            Router::post('/delete/{id}', [BoardsController::class, 'delete'], ['as' => 'boards.delete']);
        });
    });
});