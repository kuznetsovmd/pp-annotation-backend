<?php

namespace App\Models;

use Engine\Services\RawSQLService as SQL;
use PDO;

/**
 * User.php
 *
 * Class that provides user model.
 */
class User
{

    /**
     * Adds new user into database.
     *
     * @param array $user - Array of values
     * @return bool
     */
    public static function create(array $user): bool
    {
        $sql = <<<SQL

        INSERT INTO `users` (
            `name`,
            `email`
        ) VALUE 
            (?, ?)

        SQL;
        
        return null !== SQL::set($sql, [$user['name'], $user['email']]);
    }

    /**
     * Gives array with user info.
     *
     * @param string $name - User`s name
     * @return null|array
     */
    public static function getByName(string $name): ?array
    {
        $sql = <<<SQL
        
        SELECT * FROM `users` WHERE `name` = ?
        
        SQL;
        
        return SQL::get($sql, [$name], all: false);
    }

    /**
     * Gives array with user info.
     *
     * @param string $name - User`s name
     * @return null|array
     */
    public static function getByEmail(string $email): ?array
    {
        $sql = <<<SQL
        
        SELECT * FROM `users` WHERE `email` = ?

        SQL;

        return SQL::get($sql, [$email], all: false);
    }

    /**
     * Gives array with user info.
     *
     * @param int $id - User id
     * @return null|array
     */
    public static function getById(int $id): ?array
    {
        $sql = <<<SQL

        SELECT * FROM `users` WHERE `id` = ?

        SQL;
        
        return SQL::get($sql, [$id], all: false);
    }

    /**
     * Gives array with all users info.
     *
     * @return null|array
     */
    public static function getAll(): ?array
    {
        $sql = <<<SQL

        SELECT * FROM `users`

        SQL;
        
        return SQL::get($sql);
    }

}