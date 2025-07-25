<?php

namespace Engine\Middlewares;

use Engine\Middlewares\IMiddleware;
use Engine\Request;

/**
 * RendererMiddleware.php
 *
 * Class RendererMiddleware - calls renderer display method.
 */
class RendererMiddleware implements IMiddleware
{

    /**
     * Method providing middlewares chain call.
     *
     * @param Request $request
     * @return Request
     */
    public function let(?Request $request): Request
    {
        if (isset($request->view)) {
            $request->view->display();
        }
        return $request;
    }

}
