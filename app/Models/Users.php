<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Models;

use QueryBox\Migration\MigrateAble;
use QueryBox\Migration\MigrationParams;
use QueryBox\QueryBuilder\QueryBuilder;

class Users extends QueryBuilder implements MigrateAble
{
    /**
     * @inheritDoc
     */
    static function migrationParams(): array
    {
        return [
            'fields' => [
                'id' => 'BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
                'email' => 'VARCHAR(255) NOT NULL',
                'first_name' => 'VARCHAR(255) NOT NULL',
                'last_name' => 'VARCHAR(255) NOT NULL',
                'phone' => 'INT UNSIGNED',
                'password' => 'VARCHAR(255) NOT NULL',
            ]
        ];
    }
}