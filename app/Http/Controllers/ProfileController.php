<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('pages.parametres.profile.index');
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validatedData = $request->validate([
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'identifiant' => 'required|string|max:255|unique:users,identifiant,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'avatar_url' => 'nullable|image|max:2048', // 2MB Max
        ]);

        $user->prenom = $validatedData['prenom'];
        $user->nom = $validatedData['nom'];
        $user->telephone = $validatedData['telephone'];
        $user->identifiant = $validatedData['identifiant'];

        if (!empty($validatedData['password'])) {
            $user->password = bcrypt($validatedData['password']);
        }

        if ($request->hasFile('avatar_url')) {
            $path = $request->file('avatar_url')->store('avatars', 'public');
            $user->avatar_url = $path;
        }

        $user->save();

        Swal::toast([
            'icon' => 'success',
            'title' => 'Profil mis à jour avec succès',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->back();
    }
}
