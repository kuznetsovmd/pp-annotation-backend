<?php

namespace Engine;

use Engine\Config;
use Engine\Service;
use Error;

/**
 * ServiceBus.php
 *
 * Class ServiceBus contains all services to use.
 */
class ServiceBus
{

    /**
     * ServiceBus instance.
     *
     * @access private
     * @var ServiceBus
     */
    private static ServiceBus $_instance;

    /**
     * ServiceBus array.
     *
     * @access private
     * @var array
     */
    private array $_services;

    /**
     * ServiceBus services registration.
     *
     * @return ServiceBus
     */
    public function __construct()
    {
        set_error_handler(function($errno, $errstr, $errfile, $errline) {
            throw new Error($errstr, $errno);
        });

        $services = Config::get('services');

        foreach ($services as $service) {
            $this->_services[$service] = [$service, null];
        }
    }

    /**
     * ServiceBus instance getter.
     *
     * @return ServiceBus
     */
    public static function instance(): ServiceBus
    {
        if (!isset(static::$_instance)) {
            static::$_instance = new ServiceBus;
        }
        return static::$_instance;
    }

    /**
     * Service getter.
     *
     * @param Service $service
     * @return object
     */
    public function get(string $service): object
    {
        if (!isset($this->_services[$service][1])) {
            $this->_services[$service][1] = new $this->_services[$service][0];
        }

        return $this->_services[$service][1];
    }

}
