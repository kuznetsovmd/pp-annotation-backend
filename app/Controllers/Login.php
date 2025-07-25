<?php

namespace App\Controllers;

use Engine\Services\AuthService as Auth;
use Engine\Services\RedirectionService as Redirection;
use Engine\Request;
use Engine\View;
use App\Models\User;

/**
 * Login.php
 *
 * Controller class for login management.
 */
class Login
{

    /**
     * Goes to login page.
     *
     * @param Request $request
     */
    public static function toLoginPage(Request $request)
    {
        if (Auth::authenticated()) {
            Redirection::redirect('/home');
            return;
        }

        $request->view = new View('login.php', [
            'title' => 'Login',
        ]);
    }

    /**
     * Logs user in.
     *
     * @param Request $request
     */
    public static function login(Request $request)
    {
        $user = User::getByEmail($request->parameters['user']['email']);
        $password = $request->parameters['user']['password'];

        if (empty($user)) {
            Redirection::redirect('/login');
            return;
        }

        if (!Auth::login($user['id'], $password)) {
            Redirection::redirect('/login');
            return;
        }
        
        Redirection::redirect('/home');
    }

    /**
     * Logs user out.
     *
     * @param Request $request
     */
    public static function logout()
    {
        Auth::logout();
        Redirection::redirect('/');
    }

}
