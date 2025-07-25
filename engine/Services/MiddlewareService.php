<?php

namespace Engine\Services;

use Engine\Receive\Request;
use Engine\Service;
use Engine\Config;

/**
 * MiddlewareService.php
 *
 * Class that contains core middlewares important for application.
 */
class MiddlewareService extends Service
{

    /**
     * Middlewares providing different activities.
     *
     * @access private
     * @var array
     */
    private array $_middlewares;

    /**
     * ServiceBus services registration.
     *
     * @return ServiceBus
     */
    public function __construct()
    {
        $this->_middlewares = Config::get('middlewares');
    }

    /**
     * Iterate all middlewares as a chain.
     *
     * @access protected
     * @return Request
     */
    protected function run(): Request
    {
        $result = null;

        foreach ($this->_middlewares as $middleware) {
            $m = new $middleware();
            $result = $m->let($result);
        }

        return $result;
    }

}
