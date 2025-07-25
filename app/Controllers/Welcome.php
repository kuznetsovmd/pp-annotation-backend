<?php

namespace App\Controllers;

use Engine\Services\AuthService as Auth;
use Engine\Request;
use Engine\View;

/**
 * Welcome.php
 *
 * Controller class for welcome page.
 */
class Welcome
{

    /**
     * Goes to welcome page.
     *
     * @param Request $request
     */
    public static function toWelcomePage(Request $request)
    {
        $request->view = new View('welcome.php', [
            'id' => Auth::authenticated(),
            'title' => 'Welcome',
        ]);
    }

}
