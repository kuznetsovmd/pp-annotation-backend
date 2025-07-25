<?php

namespace App\Controllers;

use Engine\Services\AuthService as Auth;
use Engine\Services\RedirectionService as Redirection;
use Engine\Request;
use Engine\View;
use App\Models\User;
use App\Models\Group;
use App\Models\Permission;

/**
 * ManageGroups.php
 *
 * Controller class for actors users management.
 */
class ManageGroups
{

    /**
     * Goes to groups index page.
     *
     * @param Request $request
     */
    public static function toGroupsPage(Request $request)
    {
        $user = User::getById(Auth::authenticated());
        $request->view = new View('manage_groups/groups.php', [
            'title' => 'Groups',
            'id' => $user['id'],
            'name' => $user['name'],
            'groups' => Group::getAll(),
        ]);
    }

    /**
     * Goes to group edit page.
     *
     * @param Request $request
     * @param int $id - User id
     */
    public static function toPermissionsPage(Request $request, int $id)
    {
        $user = User::getById(Auth::authenticated());
        $request->view = new View('manage_groups/permissions.php', [
            'title' => 'Permissions',
            'id' => $user['id'],
            'name' => $user['name'],
            'group' => Group::getById($id),
            'permissions' => Permission::getForGroup($id),
            'all_permissions' => Permission::getAll(),
        ]);
    }

    /**
     * Assign group.
     *
     * @param Request $request
     * @param int $id - User id
     */
    public static function assign(Request $request, int $id)
    {
        Permission::associateById($id, $request->parameters['permission']);
        Redirection::redirect("/groups/{$id}/permissions");
    }

    /**
     * Disassign group.
     *
     * @param Request $request.
     * @param int $id - User id
     */
    public static function disassign(Request $request, int $id)
    {   
        Permission::disassociateById($id, $request->parameters['permission']);
        Redirection::redirect("/groups/{$id}/permissions");
    }

}
