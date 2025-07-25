<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Group;
use Engine\Services\AuthService as Auth;
use Engine\Services\RedirectionService as Redirection;
use Engine\Request;
use Engine\View;

/**
 * Register.php
 *
 * Controller class for registration management.
 */
class Register
{

    /**
     * Goes to registeration page.
     *
     * @param Request $request
     */
    public static function toRegisterPage(Request $request)
    {
        if (Auth::authenticated()) {
            Redirection::redirect('/home');
            return;
        }

        $request->view = new View('register.php', array(
            'title' => 'Register',
        ));
    }

    /**
     * Registers new user.
     *
     * @param Request $request
     */
    public static function register(Request $request)
    {
        $user = $request->parameters['user'];

        if ($user['password'] != $user['password_confirm']) {
            Redirection::redirect('/register');
            return;
        }

        if (!empty(User::getByEmail($user['email']))) {
            Redirection::redirect('/register');
            return;
        }

        if (User::create($user)) {
            $stored_user = User::getByName($user['name']);

            if (Auth::register($stored_user['id'], $user['password'])) {
                Group::associateByName($stored_user['id'], 'Authenticated');
                if (Auth::login($stored_user['id'], $user['password'])) {
                    Redirection::redirect('/home');
                    return;
                }
            }
        }

        Redirection::redirect('/register');
    }

}