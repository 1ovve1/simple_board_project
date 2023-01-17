<?php declare(strict_types=1);

use Lowel\Workproject\App\Controllers\SiteController;
use Pecee\SimpleRouter\SimpleRouter as Router;

Router::get('/', [SiteController::class, 'index']);