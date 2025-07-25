<?php

use Engine\Middlewares\ReceiverNginxMiddleware;
use Engine\Middlewares\RouterMiddleware;
use Engine\Middlewares\AuthMiddleware;
use Engine\Middlewares\ControllerExecutionMiddleware;
use Engine\Middlewares\CSRFMiddleware;
use Engine\Middlewares\PostResponseMiddleware;
use Engine\Middlewares\RendererMiddleware;
use Engine\Config;

Config::set('middlewares', [

    ReceiverNginxMiddleware::class,
    CSRFMiddleware::class,
    RouterMiddleware::class,
    AuthMiddleware::class,
    ControllerExecutionMiddleware::class,
    RendererMiddleware::class,
    PostResponseMiddleware::class,

]);