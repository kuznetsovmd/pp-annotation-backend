<?php

namespace Engine\Middlewares;

use Engine\Services\AuthService;
use Engine\Middlewares\IMiddleware;
use Engine\Request;
use Engine\Config;
use Error;

/**
 * AuthMiddleware.php
 *
 * Class AuthMiddleware checks access to pages.
 */
class AuthMiddleware implements IMiddleware
{

    /**
     * Sets of permissions for routs.
     *
     * @access private
     * @var array $_permissions_sets
     */
    private array $_permissions_sets;

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
        foreach ($this->_permissions_sets as $permission_set) {
            if ($permission_set->test($request->route->name)) {

                $id = AuthService::authenticated();
                if (isset($id) && AuthService::allowed($id, $permission_set->permissions)) {
                    return $request;
                } else {
                    throw new Error('You do not have access to this page!', 403);
                }
            }
        }

        return $request;
    }

}
