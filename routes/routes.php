<?php declare(strict_types=1);

use Pecee\SimpleRouter\SimpleRouter;

// load routes
require_once __DIR__ . '/api.php';
require_once __DIR__ . '/web.php';

// start route process (or ignore if we use testing)
if (!defined('PHPUNIT_TEST_RUNTIME')) {
    SimpleRouter::start();
}
