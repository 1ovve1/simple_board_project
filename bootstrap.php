<?php declare(strict_types=1);

//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
//error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/helpers.php';

// Register global paths and services
$_ENV['BASE_PATH'] = __DIR__;
$_ENV['VIEWS_PATH'] = __DIR__ . '/views/';

require_once __DIR__ . '/database/database.php';

if (defined('CLI_MOD') === false) {
    require_once __DIR__ . '/routes/routes.php';
}
