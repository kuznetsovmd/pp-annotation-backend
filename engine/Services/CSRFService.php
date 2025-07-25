<?php

namespace Engine\Services;

use App\Models\Password;
use App\Models\Permission;
use Engine\Service;
use Engine\Services\SessionService as Session;

/**
 * CSRFService.php
 *
 * Service for CSRF check.
 */
class CSRFService extends Service
{

    /**
     * CSRF page token.
     *
     * @access private
     * @return int
     */
    private string $_hash;

    /**
     * Generates CSRF token.
     *
     * @access protected
     * @return string
     */
    protected function generate(): string
    {
        if (!isset($this->_hash)) {
            $this->_hash = md5(md5(rand()));
            Session::set('csrf', $this->_hash);
        }

        return $this->_hash;
    }

    /**
     * Tests CSRF token.
     *
     * @access protected
     * @param string $hash - CSRF token to test
     * @return int
     */
    protected function test(string $hash): bool
    {
        $stored_hash = Session::get('csrf');
        return $hash == $stored_hash;
    }

}
