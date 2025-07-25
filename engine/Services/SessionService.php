<?php

namespace Engine\Services;

use Engine\Service;
use Engine\Config;

/**
 * SessionService.php
 *
 * Service for sessions management.
 */
class SessionService extends Service
{

    /**
     * Constructor of service class.
     */
    public function __construct()
    {
        session_save_path(Config::get('env')['sessions']);
        session_start();
    }

    /**
     * Sets session variable.
     *
     * @access protected
     * @param string $name - Name of a variable
     * @param $value - Storing value
     */
    protected function set(string $name, $value): void
    {
        $_SESSION[$name] = $value;
    }

    /**
     * Gives session variable.
     *
     * @access protected
     * @param string $name - Name of a variable
     * @return mixed
     */
    protected function get(string $name)
    {
        if (array_key_exists($name, $_SESSION))
            return $_SESSION[$name];
        return null;
    }

    /**
     * Finishes request.
     * 
     * @access protected
     */
    protected function finish_request(): void
    {
        session_write_close();
        fastcgi_finish_request();
    }

    /**
     * Destroys session.
     * 
     * @access protected
     */
    protected function destroy(): void
    {
        session_destroy();
    }

}
