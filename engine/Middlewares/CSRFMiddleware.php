<?php

namespace Engine\Middlewares;

use Engine\Services\CSRFService;
use Engine\Middlewares\IMiddleware;
use Engine\Request;
use Engine\Config;
use Error;

/**
 * CSRFMiddleware.php
 *
 * Class checking CSRF.
 */
class CSRFMiddleware implements IMiddleware
{

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->_permissions_sets = Config::get('permissions');
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
        if ($request->parameters['method'] == 'get') return $request;
        
        if (!isset($request->parameters['csrf_token'])) {
            throw new Error('Cross-Site request forgery!', 403);
        }

        if (!CSRFService::test($request->parameters['csrf_token'])) {
            throw new Error('Cross-Site request forgery!', 403);
        }

        return $request;
    }

}
