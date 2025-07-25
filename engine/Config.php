<?php

namespace Engine;

/**
 * Config.php
 *
 * Class managing configuration variables.
 */
class Config
{

    /**
     * Variable of config.
     *
     * @var array
     */
    private static array $_variables = [];

    /**
     * Sets configuration variable.
     *
     * @param string $key - Variable name
     * @param mixed $value - Variable value
     * @return void
     */
    public static function set(string $key, mixed $value): void
    {
        static::$_variables[$key] = $value;
    }

    /**
     * Unsets configuration variable.
     *
     * @param string $key - Variable name
     * @return void
     */
    public static function unset(string $key): void
    {
        unset(static::$_variables[$key]);
    }

    /**
     * Gives configuration variable.
     *
     * @param string $key - Variable name
     * @return mixed
     */
    public static function get(string $key): mixed
    {
        return static::$_variables[$key];
    }

}
