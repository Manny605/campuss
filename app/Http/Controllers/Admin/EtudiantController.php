<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Tuteur;
use App\Models\User;
use App\Models\Classe;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use SweetAlert2\Laravel\Swal;


class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = \App\Models\Etudiant::paginate(10);
        
        return view('pages.admin.etudiants.index', compact('etudiants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $matricule = 'ETU-' . date('Ymd') . '-' . strtoupper(Str::random(4));
        $classes = \App\Models\Classe::with(['filiereNiveau.filiere', 'filiereNiveau.niveau', 'annee'])->get();

        return view('pages.admin.etudiants.create', [
            'classes' => $classes,
            'matricule' => $matricule,
            'edit' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // 1. Validation
        $request->validate([
            'etudiant_prenom' => 'required|string|max:255',
            'etudiant_nom' => 'required|string|max:255',
            'etudiant_password' => 'required|string|min:8|confirmed',
            'etudiant_telephone' => 'required|string|max:20',
            'date_naissance' => 'required|date',
            'etudiant_role' => 'required|string',
            'classe_id' => 'required|exists:classes,id',

            'tuteur_prenom' => 'required|string|max:255',
            'tuteur_nom' => 'required|string|max:255',
            'tuteur_telephone_identifiant' => 'required|string|max:20|unique:users,identifiant',
            'tuteur_password' => 'required|string|min:8|confirmed',
            'tuteur_role' => 'required|string',
        ]);

        // 2. Générer le matricule qui servira d'identifiant
        $classeId = $request->get('classe_id');
        $classe = Classe::with('filiereNiveau.niveau', 'filiereNiveau.filiere')->findOrFail($classeId);

        $niveau = $classe->filiereNiveau->niveau;
        $filiere = $classe->filiereNiveau->filiere;

        $codeNiveau = strtoupper(substr($niveau->nom, 0, 3));
        $codeFiliere = strtoupper(substr($filiere->nom, 0, 3));

        $lastEtudiant = Etudiant::whereHas('classe.filiereNiveau', function ($query) use ($niveau, $filiere) {
            $query->where('niveau_id', $niveau->id)
              ->where('filiere_id', $filiere->id);
        })->orderBy('id', 'desc')->first();

        if ($lastEtudiant && preg_match('/' . $codeNiveau . $codeFiliere . '-(\d+)/', $lastEtudiant->user->identifiant ?? '', $matches)) {
            $numero = (int)$matches[1] + 1;
        } else {
            $numero = 1001;
        }

        $matricule = $codeNiveau . $codeFiliere . '-' . $numero;

        // 3. Créer le compte utilisateur de l'étudiant
        $etudiantUser = User::create([
            'identifiant' => $matricule,
            'password' => Hash::make($request->etudiant_password),
            'role' => $request->etudiant_role,
        ]);

        // 3.1. Créer l'étudiant
        $etudiant = Etudiant::create([
            'user_id' => $etudiantUser->id,
            'prenom' => $request->etudiant_prenom,
            'nom' => $request->etudiant_nom,
            'telephone' => $request->etudiant_telephone,
            'date_naissance' => $request->date_naissance,
            'classe_id' => $request->classe_id,
        ]);

        // 4. Créer le compte utilisateur du tuteur
        $tuteurUser = User::create([
            'identifiant' => $request->tuteur_telephone_identifiant,
            'password' => Hash::make($request->tuteur_password),
            'role' => $request->tuteur_role,
        ]);
                
        // 4.1. Créer le tuteur
        $tuteur = Tuteur::create([
            'user_id' => $tuteurUser->id,
            'prenom' => $request->tuteur_prenom,
            'nom' => $request->tuteur_nom,
            'telephone' => $request->tuteur_telephone_identifiant,
        ]);


        // 7. Lier le tuteur à l'étudiant dans la table pivot
        $etudiant->tuteurs()->attach($tuteur->id);

        // 8. Redirection avec succès
        Swal::toast([
            'icon' => 'success',
            'title' => 'Étudiant(e) créé(e) avec succès',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);       
        
        return redirect()->back();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $tuteur = $etudiant->tuteurs()->first();
        $classes = \App\Models\Classe::with(['filiereNiveau.filiere', 'filiereNiveau.niveau', 'annee'])->get();
        return view('pages.admin.etudiants.edit', compact('etudiant', 'tuteur', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 1. Validation
        $request->validate([
            'etudiant_prenom' => 'required|string|max:255',
            'etudiant_nom' => 'required|string|max:255',
            'etudiant_password' => 'required|string|min:8|confirmed',
            'etudiant_telephone' => 'required|string|max:20',
            'date_naissance' => 'required|date',
            'etudiant_role' => 'required|string',
            'classe_id' => 'required|exists:classes,id',

            'tuteur_prenom' => 'required|string|max:255',
            'tuteur_nom' => 'required|string|max:255',
            'tuteur_telephone_identifiant' => 'required|string|max:20|unique:users,identifiant',
            'tuteur_password' => 'required|string|min:8|confirmed',
            'tuteur_role' => 'required|string',
        ]);

        // 2. Trouver l'étudiant et son utilisateur
        $etudiant = Etudiant::findOrFail($id);
        $etudiantUser = $etudiant->user_id;

        $tuteur = $etudiant->tuteurs()->first();
        $tuteurUser = $tuteur->user_id;
        
        // 3. Mettre à jour l'utilisateur de l'étudiant
        $etudiantUser->update([
            'identifiant' => $etudiantUser->identifiant,
            'password' => Hash::make($request->etudiant_password),
            'role' => $request->etudiant_role,
        ]);

        // 4. Mettre à jour l'étudiant
        $etudiant->update([
            'prenom' => $request->etudiant_prenom,
            'nom' => $request->etudiant_nom,
            'telephone' => $request->etudiant_telephone,
            'date_naissance' => $request->date_naissance,
            'classe_id' => $request->classe_id,
        ]);

        // 5. Mettre à jour l'utilisateur du tuteur
        $tuteurUser->update([
            'identifiant' => $request->tuteur_telephone_identifiant,
            'password' => Hash::make($request->tuteur_password),
            'role' => $request->tuteur_role,
        ]);

        // 6. Mettre à jour le tuteur
        $tuteur->update([
            'prenom' => $request->tuteur_prenom,
            'nom' => $request->tuteur_nom,
            'telephone' => $request->tuteur_telephone_identifiant,
        ]);

        // 7. Redirection avec succès
        Swal::toast([
            'icon' => 'success',
            'title' => 'Étudiant(e) et tuteur mis à jour avec succès',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $etudiant = Etudiant::findOrFail($id);
        $tuteur = $etudiant->tuteurs()->first();

        // Supprimer l'étudiant et son utilisateur
        $etudiant->user->delete();
        $etudiant->delete();

        // Supprimer le tuteur et son utilisateur
        if ($tuteur) {
            $tuteur->user->delete();
            $tuteur->delete();
        }

        // 8. Redirection avec succès
        Swal::toast([
            'icon' => 'success',
            'title' => 'Étudiant(e) supprimé(e) avec succès',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->back();
    }
}
