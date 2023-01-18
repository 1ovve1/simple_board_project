<?php declare(strict_types=1);

use Lowel\Workproject\App\Controllers\SiteController;
use Lowel\Workproject\App\Middleware\AuthMiddleware;
use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/', [SiteController::class, 'index'], ['middleware' => AuthMiddleware::class]);

Router::group(['prefix' => '/api/v1', 'middleware' => AuthMiddleware::class], function() {
    Router::post('/post', [SiteController::class, 'post'], ['as' => 'post-test']);
    Router::get('/logout', [SiteController::class, 'logout'], ['as' => 'logout']);
    Router::get('/login', [SiteController::class, 'login'], ['as' => 'login']);
});