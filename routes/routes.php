<?php declare(strict_types=1);

use Pecee\SimpleRouter\SimpleRouter;
use Pecee\Http\Middleware\BaseCsrfVerifier;

// load routes
require_once __DIR__ . '/api.php';
require_once __DIR__ . '/web.php';

// add csrf protection
SimpleRouter::csrfVerifier(new BaseCsrfVerifier());

// start route process (or ignore if we use testing)
if (!defined('PHPUNIT_TEST_RUNTIME')) {
    SimpleRouter::start();
}
