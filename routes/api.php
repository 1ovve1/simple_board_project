<?php declare(strict_types=1);

use Lowel\Workproject\App\Controllers\SiteController;
use Pecee\SimpleRouter\SimpleRouter as Router;

Router::group(['prefix' => '/api/v1'], function() {
    Router::post('/post', [SiteController::class, 'post'], ['as' => 'post-test']);
});