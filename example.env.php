<?php

use Engine\Config;

Config::set('env', [

    # Debug prints
    'debug' => true,

    # Paths
    'views'       => __DIR__ . '/views',
    'resources'   => __DIR__ . '/resources',
    'sessions'    => __DIR__ . '/resources',

    # Database credentials
    'db_driver'   => 'mysql',
    'db_address'  => 'db',
    'db_name'     => 'annotation',
    'db_user'     => 'annotation',
    'db_password' => 'secret',

]);
