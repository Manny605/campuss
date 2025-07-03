<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Tuteur;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        $classes = \App\Models\Classe::with(['filiereNiveau.filiere', 'filiereNiveau.niveau', 'annee'])->get();
        return view('pages.admin.etudiants.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // 1. Validation
        $request->validate([
            'etudiant_nom' => 'required|string|max:255',
            'etudiant_prenom' => 'required|string|max:255',
            'etudiant_password' => 'required|string|min:8|confirmed',
            'etudiant_telephone' => 'required|string|max:20',
            'date_naissance' => 'required|date',
            'etudiant_role' => 'required|string',
            'classe_id' => 'required|exists:classes,id',

            'tuteur_nom' => 'required|string|max:255',
            'tuteur_prenom' => 'required|string|max:255',
            'tuteur_telephone_identifiant' => 'required|string|max:20|unique:users,identifiant',
            'tuteur_password' => 'required|string|min:8|confirmed',
            'tuteur_role' => 'required|string',
        ]);

        // 2. Générer le matricule qui servira d'identifiant
        $matricule = 'ETU-' . strtoupper(uniqid());

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
        return redirect()->back()->with('success', 'Étudiant et tuteur créés avec succès.');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
