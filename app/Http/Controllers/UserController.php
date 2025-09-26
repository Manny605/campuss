<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use SweetAlert2\Laravel\Swal;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('pages.gestion_comptes.comptes.index', compact('users'));
    }

    public function create()
    {
        $roles = \Spatie\Permission\Models\Role::all();
        return view('pages.gestion_comptes.comptes.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'array',
            'roles.*' => 'exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($request->has('roles')) {
            $user->assignRole($request->roles);
        }

        Swal::toast([
            'icon' => 'success',
            'title' => 'Utilisateur créé avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $user = User::findOrFail($user->id);
        $roles = \Spatie\Permission\Models\Role::all();
        return view('pages.gestion_comptes.comptes.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $user = User::findOrFail($user->id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'array',
            'roles.*' => 'exists:roles,name',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        } else {
            $user->syncRoles([]);
        }

        Swal::toast([
            'icon' => 'success',
            'title' => 'Utilisateur mis à jour avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user = User::findOrFail($user->id);
        $user->delete();

        Swal::toast([
            'icon' => 'success',
            'title' => 'Utilisateur supprimé avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->route('users.index');
    }
}
