<?php declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/routes/api.php';
require_once __DIR__ . '/routes/web.php';

$_ENV['BASE_PATH'] = __DIR__;
$_ENV['VIEWS_PATH'] = __DIR__ . '/views/';

if (!defined('PHPUNIT_TEST_RUNTIME')) {
    \Pecee\SimpleRouter\SimpleRouter::start();
}
