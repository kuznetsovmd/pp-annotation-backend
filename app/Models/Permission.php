<?php

namespace App\Models;

use Engine\Services\RawSQLService as SQL;
use PDO;

/**
 * Permission.php
 *
 * Class that provides permission model.
 */
class Permission
{

    /**
     * Gives all user permissions.
     *
     * @param int $id - User id
     * @return array - Permissions values
     */
    public static function getForUser(int $id): array
    {   
        $sql = <<<SQL

        SELECT `for` FROM `users`
            INNER JOIN `group_user`         ON `users`.`id` = `group_user`.`user_id`
            INNER JOIN `groups`             ON `group_user`.`group_id` = `groups`.`id`
            INNER JOIN `group_permission`   ON `groups`.`id` = `group_permission`.`group_id` 
            INNER JOIN `permissions`        ON `group_permission`.`permission_id` = `permissions`.`id` 
        WHERE `users`.`id` = ?

        SQL;

        return SQL::get($sql, [$id], options: PDO::FETCH_COLUMN);
    }

    /**
     * Gives all group permissions.
     *
     * @param int $id - Group id
     * @return null|array - Permissions values
     */
    public static function getForGroup(int $id): ?array
    {
        $sql = <<<SQL

        SELECT * FROM `permissions`
            INNER JOIN `group_permission`   ON `permissions`.`id` = `group_permission`.`permission_id`
            INNER JOIN `groups`             ON `group_permission`.`group_id` = `groups`.`id` 
        WHERE `groups`.`id` = ?

        SQL;

        return SQL::get($sql, [$id]);
    }

    /**
     * Gives array with all permissions.
     *
     * @return null|array
     */
    public static function getAll(): ?array
    {
        $sql = <<<SQL

        SELECT * FROM `permissions`

        SQL;

        return SQL::get($sql);
    }

    /**
     * Associates group with permission.
     *
     * @param int $id - Group id
     * @param string $permission - Permission value
     * @return bool
     */
    public static function associateByName(int $id, string $permission): bool
    {
        $sql = <<<SQL
        
        INSERT INTO `group_permission` (
            `group_id`, 
            `permission_id`
        ) VALUE
            (?, (SELECT `id` FROM `permission` WHERE `for` = ?))

        SQL;

        return null !== SQL::set($sql, [$id, $permission]);
    }

    /**
     * Associates group with permission.
     *
     * @param int $id - Group id
     * @param string $permission - Permission id
     * @return bool
     */
    public static function associateById(int $id, int $permission_id): bool
    {
        $sql = <<<SQL

        INSERT INTO `group_permission` (
            `group_id`, 
            `permission_id`
        ) VALUE 
            (?, ?)

        SQL;

        return null !== SQL::set($sql, [$id, $permission_id]);
    }

    /**
     * Disassociates group with permission.
     *
     * @param int $id - Group id
     * @param string $permission - Permission id
     * @return bool
     */
    public static function disassociateByName(int $id, string $permission): bool
    {
        $sql = <<<SQL

        DELETE FROM `group_permission`
        WHERE `group_id` = ? AND
              `permission_id` = (SELECT `id` FROM `permissions` WHERE `for` = ?)

        SQL;

        return null !== SQL::set($sql, [$id, $permission]);
    }

    /**
     * Disassociates group with permission.
     *
     * @param int $id - Group id
     * @param string $permission_id - Permission id
     * @return bool
     */
    public static function disassociateById(int $id, int $permission_id): bool
    {
        $sql = <<<SQL

        DELETE FROM `group_permission`
        WHERE `group_id` = ? AND
              `permission_id` = ?

        SQL;

        return null !== SQL::set($sql, [$id, $permission_id]);
    }

}