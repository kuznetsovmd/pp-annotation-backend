<?php

namespace Engine\Routing;

/**
 * Route.php
 *
 * Class Route contains info about route.
 */
class Route
{

    /**
     * Route name.
     *
     * @var string
     */
    public string $name;

    /**
     * Route pattern.
     *
     * @var string
     */
    public string $pattern;

    /**
     * Request method.
     *
     * @var string
     */
    public string $method;

    /**
     * Controller to execute.
     *
     * @var array
     */
    public array $controller;

    /**
     * Request parameters.
     *
     * @var array
     */
    public array $args;

    /**
     * Route constructor.
     *
     * @param string $name - Route name
     * @param string $method - HTTP method
     * @param string $patetrn - Pattern for url
     * @param array $controller - Controller to exec
     */
    public function __construct(string $name, 
                                string $method, 
                                string $pattern, 
                                array $controller)
    {
        $this->name = $name;
        $this->method = $method;
        $this->pattern = $pattern;
        $this->controller = $controller;
    }

    /**
     * Test route if it fits.
     *
     * @param string $name - Route name
     * @param string $method - HTTP method
     * @return bool
     */
    public function test(string $uri, string $method): bool
    {
        if ($this->method == $method &&
            preg_match($this->pattern, $uri, $params_matches)) {
            array_shift($params_matches);
            $this->args = $params_matches;
            return true;
        }
        return false;
    }

    /**
     * Executes controller action.
     *
     * @param Request $request - Request object to response
     */
    public function execute($request)
    {
        forward_static_call($this->controller, $request, ...$this->args);
    }

}
