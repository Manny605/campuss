<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use SweetAlert2\Laravel\Swal;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('pages.gestion_comptes.permissions.index', compact('permissions'));
    }


    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:permissions,name']);
        Permission::create(['name' => $request->name]);

        Swal::toast([
            'icon' => 'success',
            'title' => 'Permission créée avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->route('permissions.index');
    }


public function update(Request $request, Permission $permission)
{
    $request->validate([
        'name' => 'required|unique:permissions,name,' . $permission->id,
    ]);

    try {
        $permission->update(['name' => $request->name]);

        Swal::toast([
            'icon' => 'success',
            'title' => 'Permission mise à jour avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
    } catch (\Exception $e) {
        // Ici on affiche le vrai message d'erreur de Laravel/MySQL
        Swal::toast([
            'icon' => 'error',
            'title' => 'Erreur : ' . $e->getMessage(),
            'position' => 'top-end',
            'timer' => 10000,
            'showConfirmButton' => true,
        ]);
    }

    return redirect()->route('permissions.index');
}



    public function destroy(Permission $permission)
    {
        $permission->delete();

        Swal::toast([
            'icon' => 'success',
            'title' => 'Permission supprimée avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->route('permissions.index');
    }
}
