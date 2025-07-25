<?php

use Engine\Services\DebugService as Debug;
use Engine\Services\MiddlewareService as Queue;
use Engine\View;

try {

    Queue::run();

} catch (Throwable $exception) {

    Debug::push($exception);
    $view = new View('exception.php', ['exception' => $exception]);
    $view->display();

}