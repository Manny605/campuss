<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Etudiant;
use App\Models\Tuteur;
use SweetAlert2\Laravel\Swal;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index()
    {
        $roles = Role::withCount('users')->where('name', '!=', 'Tuteur')->get();
        return view('pages.gestion_comptes.comptes.accueil', compact('roles'));
    }

    public function indexUsersByRole(Role $role)
    {
        $users = User::role($role->name)->paginate(10);
        return view('pages.gestion_comptes.comptes.index', compact('users', 'role'));
    }

    public function create(Role $role)
    {
        return view('pages.gestion_comptes.comptes.create', compact('role'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // User Compte
            'prenom'      => ['required', 'string', 'max:100'],
            'nom'         => ['required', 'string', 'max:100'],
            'telephone'   => ['required', 'string', 'max:30'],
            'identifiant' => ['required', 'string', 'max:100', 'unique:users,identifiant'],
            'password'    => ['required', 'confirmed', 'min:8'],
            'role'        => ['required', 'string', 'exists:roles,name'], // admin, etudiant, enseignant, tuteur
            'avatar_url'  => ['nullable', 'image', 'max:2048'],

            // Étudiant
            'matricule'      => ['nullable', 'string', 'max:100'],
            'date_naissance' => ['nullable', 'date'],
            'lieu_naissance' => ['nullable', 'string', 'max:150'],
            'genre'          => ['nullable', 'in:masculin,feminin'],

            // Tuteur
            'prenom_tuteur'    => ['nullable', 'string', 'max:100'],
            'nom_tuteur'       => ['nullable', 'string', 'max:100'],
            'telephone_tuteur' => ['nullable', 'string', 'max:30'],
            'password_tuteur'  => ['nullable', 'confirmed', 'min:8'],
            'relation'         => ['nullable', 'in:pere,mere,autre'],

        ]);

        $avatarPath = $request->hasFile('avatar_url') ? $request->file('avatar_url')->store('avatars', 'public') : null;

        // Création du User
        $user = User::create([
            'prenom'      => $validated['prenom'],
            'nom'         => $validated['nom'],
            'telephone'   => $validated['telephone'],
            'identifiant' => $validated['identifiant'],
            'password'    => bcrypt($validated['password']),
            'statut'      => 'active',
            'avatar_url'  => $avatarPath,
        ]);

        // 🎭 Attribution du rôle
        $user->assignRole($validated['role']);

        // 🔀 Cas selon le rôle Etudiant
        if ($validated['role'] === 'Etudiant') {
            $etudiant = Etudiant::create([
                'user_id'        => $user->id,
                'matricule'      => $validated['matricule']      ?? null,
                'date_naissance' => $validated['date_naissance'] ?? null,
                'lieu_naissance' => $validated['lieu_naissance'] ?? null,
                'genre'          => $validated['genre']          ?? null,
            ]);

            // 👨‍👩‍👦 Si un tuteur est fourni en même temps
            if (!empty($validated['prenom_tuteur']) && !empty($validated['nom_tuteur']) && !empty($validated['telephone_tuteur']) && !empty($validated['password_tuteur'])) {
                $userTuteur = User::create([
                    'prenom'      => $validated['prenom_tuteur'],
                    'nom'         => $validated['nom_tuteur'],
                    'telephone'   => $validated['telephone_tuteur'],
                    'identifiant' => $validated['telephone_tuteur'], // identifiant = téléphone
                    'password'    => bcrypt($validated['password_tuteur']),
                    'statut'      => 'active',
                ]);

                $userTuteur->assignRole('tuteur');

                $tuteur = Tuteur::create([
                    'user_id'  => $userTuteur->id,
                    'relation' => $validated['relation'] ?? null,
                ]);

                // 🔗 Lier étudiant <-> tuteur via pivot
                $etudiant->tuteurs()->attach($tuteur->id);
            }
        }

        // ✅ Notification
        Swal::toast([
            'icon' => 'success',
            'title' => 'Utilisateur créé avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        // 🔀 Redirection avec l'id du rôle
        $role = Role::where('name', $validated['role'])->first();
        return redirect()->route('users.indexUsersByRole', ['role' => $role->id]);
    }


    public function edit(Role $role, User $user)
    {
        $tuteur = $user->etudiant?->tuteurs()->first();
        return view('pages.gestion_comptes.comptes.edit', compact('user', 'tuteur', 'role'));
    }


    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            // User Compte
            'prenom'      => ['required', 'string', 'max:100'],
            'nom'         => ['required', 'string', 'max:100'],
            'telephone'   => ['required', 'string', 'max:30'],
            'identifiant' => ['required', 'string', 'max:100', Rule::unique('users')->ignore($user->id)],
            'password'    => ['nullable', 'confirmed', 'min:8'],
            'role'        => ['required', 'string', 'exists:roles,name'],
            'avatar_url'  => ['nullable', 'image', 'max:2048'],

            // Étudiant
            'matricule'      => ['nullable', 'string', 'max:100'],
            'date_naissance' => ['nullable', 'date'],
            'lieu_naissance' => ['nullable', 'string', 'max:150'],
            'genre'          => ['nullable', 'in:masculin,feminin'],

            // Tuteur
            'prenom_tuteur'    => ['nullable', 'string', 'max:100'],
            'nom_tuteur'       => ['nullable', 'string', 'max:100'],
            'telephone_tuteur' => ['nullable', 'string', 'max:30'],
            'password_tuteur'  => ['nullable', 'confirmed', 'min:8'],
            'relation'         => ['nullable', 'in:pere,mere,autre'],
        ]);

        // 📸 Upload avatar si nouveau
        if ($request->hasFile('avatar_url')) {
            $avatarPath = $request->file('avatar_url')->store('avatars', 'public');
            $user->avatar_url = $avatarPath;
        }

        // 📝 Update User
        $user->update([
            'prenom'      => $validated['prenom'],
            'nom'         => $validated['nom'],
            'telephone'   => $validated['telephone'],
            'identifiant' => $validated['identifiant'],
            'password'    => !empty($validated['password']) ? bcrypt($validated['password']) : $user->password,
            'avatar_url'  => $user->avatar_url,
        ]);

        $user->syncRoles([$validated['role']]);

        // 🔀 Cas Étudiant
        if ($validated['role'] === 'Etudiant') {
            $etudiant = $user->etudiant ?: new Etudiant(['user_id' => $user->id]);
            $etudiant->fill([
                'matricule'      => $validated['matricule']      ?? null,
                'date_naissance' => $validated['date_naissance'] ?? null,
                'lieu_naissance' => $validated['lieu_naissance'] ?? null,
                'genre'          => $validated['genre']          ?? null,
            ]);
            $etudiant->save();

            // 👨‍👩‍👦 Mise à jour ou création du Tuteur lié
            if (!empty($validated['prenom_tuteur']) && !empty($validated['nom_tuteur']) && !empty($validated['telephone_tuteur'])) {
                $userTuteur = $etudiant->tuteurs()->first()?->user;

                if (!$userTuteur) {
                    $userTuteur = User::create([
                        'prenom'      => $validated['prenom_tuteur'],
                        'nom'         => $validated['nom_tuteur'],
                        'telephone'   => $validated['telephone_tuteur'],
                        'identifiant' => $validated['telephone_tuteur'],
                        'password'    => bcrypt($validated['password_tuteur'] ?? 'password@123'),
                        'statut'      => 'active',
                    ]);
                    $userTuteur->assignRole('Tuteur');
                } else {
                    $userTuteur->update([
                        'prenom'    => $validated['prenom_tuteur'],
                        'nom'       => $validated['nom_tuteur'],
                        'telephone' => $validated['telephone_tuteur'],
                        'password'  => !empty($validated['password_tuteur']) ? bcrypt($validated['password_tuteur']) : $userTuteur->password,
                    ]);
                }

                $tuteur = $userTuteur->tuteur ?: new Tuteur(['user_id' => $userTuteur->id]);
                $tuteur->relation = $validated['relation'] ?? null;
                $tuteur->save();

                $etudiant->tuteurs()->syncWithoutDetaching([$tuteur->id]);
            }
        }

        // ✅ Notification
        Swal::toast([
            'icon' => 'success',
            'title' => 'Utilisateur mis à jour avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        // 🔀 Redirection
        $role = Role::where('name', $validated['role'])->first();
        return redirect()->route('users.indexUsersByRole', ['role' => $role->id]);
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

        return redirect()->back();
    }
}
