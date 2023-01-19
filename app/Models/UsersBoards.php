<?php declare(strict_types=1);

namespace Lowel\Workproject\App\Models;

use QueryBox\Migration\MigrateAble;
use QueryBox\Migration\MigrationParams;
use QueryBox\QueryBuilder\QueryBuilder;

class UsersBoards extends QueryBuilder implements MigrateAble
{
    /**
     * @inheritDoc
     */
    static function migrationParams(): array
    {
        return [
            'fields' => [
                'id' => 'BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY',
                'id_user' => 'BIGINT UNSIGNED NOT NULL',
                'id_board' => 'BIGINT UNSIGNED NOT NULL',
            ],
            'foreign' => [
                'id_user' => [Users::class, 'id'],
                'id_board' => [Boards::class, 'id'],
            ]

        ];
    }

}