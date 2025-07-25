<?php

namespace Engine\Routing;

/**
 * RoutePermission.php
 *
 * Class RoutePermission defines permissions for 
 * visiting and accepting requests on different routes.
 */
class RoutePermission
{

    /**
     * Name of related route.
     *
     * @var string
     */
    public string $name;

    /**
     * Permissions list.
     *
     * @var array
     */
    public array $permissions;

    /**
     * Permission constructor.
     *
     * @param string $name - Route name
     * @param array $permissions - Permission token
     */
    public function __construct(string $name, 
                                array $permissions)
    {
        $this->name = $name;
        $this->permissions = $permissions;
    }


    /**
     * Test if permissions for proper route.
     *
     * @param string $name - Route name.
     */
    public function test(string $name): bool
    {
        if ($this->name == $name) {
            return true;
        }
        return false;
    }

}
