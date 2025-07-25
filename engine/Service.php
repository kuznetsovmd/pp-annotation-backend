<?php

namespace Engine;

use Engine\ServiceBus;

/**
 * Service.php
 *
 * Base class for service.
 */
abstract class Service
{

    /**
     * Binding of static calls to objects.
     *
     * @param string $method
     * @param array $args
     */
    public static function __callStatic(string $method, array $args): mixed
    {
        return call_user_func_array(
            [ServiceBus::instance()->get(static::class), $method], 
            $args
        );
    }

}
