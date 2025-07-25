<?php

/**
 * Patterns for parameters:
 *
 * (0-9+)      <- number
 * (a-zA-Z+)   <- word
 */

use App\Controllers\Annotation;
use App\Controllers\Register;
use App\Controllers\Login;
use App\Controllers\Home;
use App\Controllers\Welcome;
use App\Controllers\ManageUsers;
use App\Controllers\ManageGroups;
use App\Controllers\ManageData;
use Engine\Routing\Route;
use Engine\Config;


Config::set('routes', [

    # Auth management
    new Route('register', 'get', '/^register$/', [Register::class, 'toRegisterPage']),
    new Route('register', 'post', '/^register$/', [Register::class, 'register']),
    new Route('login', 'get', '/^login$/', [Login::class, 'toLoginPage']),
    new Route('login', 'post', '/^login$/', [Login::class, 'login']),
    new Route('logout', 'post', '/^logout$/', [Login::class, 'logout']),

    # Pages
    new Route('welcome', 'get', '/^$/', [Welcome::class, 'toWelcomePage']),
    new Route('home', 'get', '/^home$/', [Home::class, 'toHomePage']),
    new Route('annotation', 'get', '/^annotation$/', [Annotation::class, 'toAnnotationPage']),
    new Route('annotation', 'post', '/^annotation$/', [Annotation::class, 'processAnnotations']),

    # Users
    new Route('users', 'get', '/^users$/', [ManageUsers::class, 'toUsersPage']),
    new Route('user-groups', 'get', '/^users\/([0-9]+)\/groups$/', [ManageUsers::class, 'toGroupsPage']),
    new Route('user-group', 'post', '/^users\/([0-9]+)\/groups$/', [ManageUsers::class, 'assign']),
    new Route('user-group', 'delete', '/^users\/([0-9]+)\/groups$/', [ManageUsers::class, 'disassign']),

    # Permissions
    new Route('groups', 'get', '/^groups$/', [ManageGroups::class, 'toGroupsPage']),
    new Route('group-permissions', 'get', '/^groups\/([0-9]+)\/permissions$/', [ManageGroups::class, 'toPermissionsPage']),
    new Route('group-permissions', 'post', '/^groups\/([0-9]+)\/permissions$/', [ManageGroups::class, 'assign']),
    new Route('group-permission', 'delete', '/^groups\/([0-9]+)\/permissions$/', [ManageGroups::class, 'disassign']),

    # Data
    new Route('data', 'get', '/^data$/', [ManageData::class, 'toDataPage']),
    new Route('data-upload', 'post', '/^data-upload$/', [ManageData::class, 'upload']),
    new Route('data-download', 'get', '/^data-download$/', [ManageData::class, 'download']),

]);