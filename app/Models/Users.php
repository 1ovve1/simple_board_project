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
                'username' => 'VARCHAR(255) NOT NULL UNIQUE',
                'first_name' => 'VARCHAR(255) NOT NULL',
                'last_name' => 'VARCHAR(255) NOT NULL',
                'phone' => 'INT UNSIGNED',
                'password_hash' => 'VARCHAR(255) NOT NULL',
            ]
        ];
    }
}