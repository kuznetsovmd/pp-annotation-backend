<?php

namespace Engine\Services;

use Engine\Config;
use Engine\Service;

/**
 * DebugService.php
 *
 * Debug class for application.
 */
class DebugService extends Service
{

    /**
     * Objects to print.
     *
     * @access private
     * @var array
     */
    private array $_items = [];

    /**
     * If debug printing allowed.
     *
     * @access private
     * @var bool
     */
    private bool $_allowed;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->_allowed = Config::get('env')['debug'];
    }

    /**
     * Pushes new object to print queue.
     *
     * @access protected
     * @param $obj - Object to print
     * @return void
     */
    protected function push($obj): void
    {
        array_push($this->_items, $obj);
    }

    /**
     * Prints objects if it is allowed.
     *
     * @access protected
     * @return void
     */
    protected function printIfAllowed(): void
    {
        if (count($this->_items) > 0 && $this->_allowed) {
            dump($this->_items);
        }
    }

}
