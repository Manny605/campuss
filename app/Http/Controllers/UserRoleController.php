<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserRoleController extends Controller
{

        // 📌 Liste des rôles & permissions d’un utilisateur
    public function index(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('users.roles.index', [
            'user' => $user,
            'roles' => $roles,
            'permissions' => $permissions,
            'userRoles' => $user->roles->pluck('name')->toArray(),
            'userPermissions' => $user->permissions->pluck('name')->toArray(),
        ]);
    }


    public function assignRole(Request $request, User $user)
    {
        $request->validate(['role' => 'required|exists:roles,name']);
        $user->assignRole($request->role);

        return back()->with('success', 'Rôle attribué avec succès.');
    }

    public function revokeRole(Request $request, User $user)
    {
        $request->validate(['role' => 'required|exists:roles,name']);
        $user->removeRole($request->role);

        return back()->with('success', 'Rôle retiré.');
    }

    public function givePermission(Request $request, User $user)
    {
        $request->validate(['permission' => 'required|exists:permissions,name']);
        $user->givePermissionTo($request->permission);

        return back()->with('success', 'Permission attribuée.');
    }

    public function revokePermission(Request $request, User $user)
    {
        $request->validate(['permission' => 'required|exists:permissions,name']);
        $user->revokePermissionTo($request->permission);

        return back()->with('success', 'Permission retirée.');
    }

}
