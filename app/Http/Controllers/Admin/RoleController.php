<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::where('created_at', 'desc')->get();
        return view('pages.admin.roles.index', [
            'roles' => $roles
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'nom' => 'required|string|max:255|unique:roles,nom',
        ]);

        Role::create([
            'nom' => $request->nom,
        ]);
        
        Swal::toast([
            'icon' => 'success',
            'title' => 'Role enregistré avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nom' => 'required|string|max:255|unique:roles,nom,' . $id,
        ]);

        $role = Role::findOrFail($id);
        $role->update([
            'nom' => $request->nom,
        ]);

        Swal::toast([
            'icon' => 'success',
            'title' => 'Role mis à jour avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->back();
    }

    public function destroy($id) {
        $role = Role::findOrFail($id);
        $role->delete();

        Swal::toast([
            'icon' => 'success',
            'title' => 'Role supprimé avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->back();
    }
}
