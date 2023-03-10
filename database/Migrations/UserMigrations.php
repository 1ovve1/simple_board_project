<?php declare(strict_types=1);

namespace Lowel\Workproject\DB\Migrations;

use QueryBox\DBFacade;
use QueryBox\Migration\MetaTable;
use QueryBox\Migration\MigrateAble;

class UserMigrations
{
    /**
     * Do migration by using app config /config/migrations.php
     * @return void
     */
    static function migrateFromConfig(): void
    {
        //TODO: write custom exceptions
        $classList = get_config('migrations');
        $migrateTool = MetaTable::createImmutable(DBFacade::getImmutableDBConnection());

        foreach ($classList as $params) {
            if (is_string($params) && is_a($params, MigrateAble::class, true)) {
                $migrateTool->doMigrateFromMigrateAble($params);
            }
        }
    }

    /**
     * Delete tables from config
     * @return void
     */
    static function dropTablesFromConfig(): void
    {
        $classList = get_config('migrations');
        $migrateTool = MetaTable::createImmutable(DBFacade::getImmutableDBConnection());

        $migrateTool->doDeleteTableFromMigrateAble($classList);
    }
}