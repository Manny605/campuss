<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use SweetAlert2\Laravel\Swal;


class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('pages.gestion_comptes.roles.index', compact('roles'));
    }


    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles,name']);

        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }

        Swal::toast([
            'icon' => 'success',
            'title' => 'Rôle créé avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->route('roles.index');
    }
    
    public function update(Request $request, Role $role)
    {
        $request->validate(['name' => 'required|unique:roles,name,' . $role->id]);

        $role->update(['name' => $request->name]);

        $role->syncPermissions($request->permissions ?? []);

        Swal::toast([
            'icon' => 'success',
            'title' => 'Rôle mis à jour avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->route('roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        Swal::toast([
            'icon' => 'success',
            'title' => 'Rôle supprimé avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->route('roles.index');
    }
}