<?php

namespace App\Models;

use Engine\Services\RawSQLService as SQL;
use PDO;

/**
 * Password.php
 *
 * Class that provides password model.
 */
class Password
{

    /**
     * Adds new password into database.
     *
     * @param int $id - User id
     * @param string $password - Password string
     * @return bool
     */
    public static function create(int $id, string $password): bool
    {
        $sql = <<<SQL

        INSERT INTO `passwords` (
            `id`,
            `value`
        ) VALUE 
            (?, ?)
            
        SQL;

        return null !== SQL::set($sql, [$id, $password]);
    }

    /**
     * Gives encrypted password.
     *
     * @param int $id - User id
     * @return null|array
     */
    public static function getValue(int $id): ?array
    {
        $sql = <<<SQL

        SELECT `value` FROM `passwords` WHERE `id` = ?

        SQL;

        return SQL::get($sql, [$id], all: false);
    }

}