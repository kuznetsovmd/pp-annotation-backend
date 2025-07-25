<?php

namespace Engine\Middlewares;

use Engine\Middlewares\IMiddleware;
use Engine\Request;
use Engine\Services\SessionService as Session;

/**
 * PostResponseMiddleware.php
 *
 * Class providing after session job.
 */
class PostResponseMiddleware implements IMiddleware
{
    
    /**
     * Method providing middlewares chain call.
     *
     * @param Request $request
     * @return Request
     */
    public function let(?Request $request): Request
    {
        Session::finish_request();

        if (isset($request->post_response)) {
            ($request->post_response)();
        }
        
        return $request;
    }

}
