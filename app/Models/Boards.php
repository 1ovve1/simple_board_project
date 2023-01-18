<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Models;

use QueryBox\Migration\MigrateAble;
use QueryBox\Migration\MigrationParams;
use QueryBox\QueryBuilder\QueryBuilder;

class Boards extends QueryBuilder implements MigrateAble
{
    /**
     * @inheritDoc
     */
    static function migrationParams(): array
    {
        return [
            'fields' => [
                'id' => 'BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
                'title' => 'VARCHAR(255) NOT NULL',
                'address' => 'VARCHAR(255) NOT NULL',
                'content' => 'TEXT',
                'price' => 'BIGINT UNSIGNED NOT NULL'
            ]
        ];
    }

}