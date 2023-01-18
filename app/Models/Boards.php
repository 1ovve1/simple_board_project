<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Models;

use QueryBox\Migration\MigrateAble;
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
                'price' => 'BIGINT UNSIGNED NOT NULL',
                'publish' => 'TINYINT UNSIGNED NOT NULL',
                'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP' ,
                'updated_at' => 'DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            ]
        ];
    }

}