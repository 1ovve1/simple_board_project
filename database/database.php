<?php declare(strict_types=1);

use Lowel\Workproject\DB\UnknownDbProperty;

$connection_info = get_config('db');

$req_properties_list = ['DB_TYPE', 'DB_HOST', 'DB_NAME', 'DB_PORT', 'DB_USER', 'DB_PASS'];

foreach ($req_properties_list as $prop) {
    $_ENV[$prop] = $connection_info[$prop] ?? throw new UnknownDbProperty($prop);
}