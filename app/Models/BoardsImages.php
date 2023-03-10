<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Models;

use QueryBox\Migration\MigrateAble;
use QueryBox\QueryBuilder\QueryBuilder;

class BoardsImages extends QueryBuilder implements MigrateAble
{
    /**
     * @inheritDoc
     */
    static function migrationParams(): array
    {
        return [
            'fields' => [
                'id' => 'BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
                'id_board' => 'BIGINT UNSIGNED NOT NULL',
                'src' => 'VARCHAR(255)',
            ],
            'foreign' => [
                'id_board' => [Boards::class, 'id'],
            ]
        ];
    }

}