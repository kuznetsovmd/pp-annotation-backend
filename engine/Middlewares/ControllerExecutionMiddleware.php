<?php

namespace Engine\Middlewares;

use Engine\Middlewares\IMiddleware;
use Engine\Request;

/**
 * ControllerExecutionMiddleware.php
 *
 * Middleware class for controllers execution.
 */
class ControllerExecutionMiddleware implements IMiddleware
{
    
    /**
     * Method providing middlewares chain call.
     *
     * @param Request $request
     * @return Request
     */
    public function let(?Request $request): Request
    {
        $request->route->execute($request);
        return $request;
    }

}
