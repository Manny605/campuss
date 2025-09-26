<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function PageAffectPermissionsToRole(String $role_id)
    {
        $role = Role::findOrFail($role_id);
        $permissions = Permission::all();
        return view('pages.gestion_comptes.roles.affecter_permissions', compact('role', 'permissions'));
    }
}
