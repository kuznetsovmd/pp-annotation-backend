<?php

use Engine\Services\DebugService;
use Engine\Services\MiddlewareService;
use Engine\Services\SessionService;
use Engine\Services\RawSQLService;
use Engine\Services\AuthService;
use Engine\Services\RedirectionService;
use Engine\Services\FileSystemService;
use Engine\Services\CSRFService;
use Engine\Config;

Config::set('services', [
    
    DebugService::class,
    MiddlewareService::class,
    SessionService::class,
    RawSQLService::class,
    AuthService::class,
    RedirectionService::class,
    FileSystemService::class,
    CSRFService::class,

]);
