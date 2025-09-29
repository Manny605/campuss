<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use SweetAlert2\Laravel\Swal;

class RolePermissionController extends Controller
{
    public function PageAffectPermissionsToRole(String $role_id)
    {
        $role = Role::findOrFail($role_id);
        $permissions = Permission::all();
        return view('pages.gestion_comptes.roles.affecter_permissions', compact('role', 'permissions'));
    }

    public function AffectPermissionsToRole(Request $request, Role $role)
    {
        $permissions = $request->input('permissions', []);

        $role->syncPermissions($request->permissions ?? []);

        Swal::toast([
            'icon' => 'success',
            'title' => 'Permissions affectées avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->back();
    }
}
