<?php declare(strict_types=1);

use Lowel\Workproject\App\Controllers\SiteController;
use Pecee\SimpleRouter\SimpleRouter as Router;


Router::group([
    'prefix' => '/api'
], function() {
    Router::post('/search', [\Lowel\Workproject\App\Controllers\ApiController::class, 'searchBoards']);
});
