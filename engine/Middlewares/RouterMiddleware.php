<?php

namespace Engine\Middlewares;

use Engine\Middlewares\IMiddleware;
use Engine\Request;
use Engine\Config;
use Error;

/**
 * RouterMiddleware.php
 *
 * Simple router class for managing urls.
 */
class RouterMiddleware implements IMiddleware
{
    /**
     * Map for urls and controllers.
     *
     * @access private
     * @var array
     */
    private array $_routes;

    /**
     * ServiceBus services registration.
     *
     * @return ServiceBus
     */
    public function __construct()
    {
        $this->_routes = Config::get('routes');
    }

    /**
     * Method providing middlewares chain call.
     *
     * @param Request $request
     * @return Request
     * @throws Error
     */
    public function let(?Request $request): Request
    {

        foreach ($this->_routes as $route) {
            if ($route->test($request->parameters['uri'],
                             $request->parameters['method'])) {
                
                $request->route = $route;
                return $request;
            }
        }
        
        throw new Error('The requested route does not exist!', 404);
    }

}
