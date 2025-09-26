<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;

use App\Models\Enseignant;
use App\Models\Matiere;
use App\Models\Filiere;



class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enseignants = Enseignant::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.gestion_rh.enseignants.index', compact('enseignants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.gestion_rh.enseignants.create', [
            'users' => \App\Models\User::all(),
            'classes' => \App\Models\Classe::all(),
            'matieres' => \App\Models\Matiere::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'identifiant' => 'required|string|max:255|unique:users,identifiant',
            'password' => 'required|string|min:8|confirmed',

            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:15',
            'date_embauche' => 'required|date',
            'specialite' => 'nullable|string|max:255',
            'grade' => 'nullable|string|max:255',
        ]);

        // Create the user first
        $user = \App\Models\User::create([
            'identifiant' => $validatedData['identifiant'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'enseignant', 
        ]);

        // Create the enseignant
        $enseignant = Enseignant::create([
            'user_id' => $user->id,
            'prenom' => $validatedData['prenom'],
            'nom' => $validatedData['nom'],
            'telephone' => $validatedData['telephone'],
            'date_embauche' => $validatedData['date_embauche'],
            'specialite' => $validatedData['specialite'],
            'grade' => $validatedData['grade'],
            'classe_id' => null,
        ]);
        
        Swal::toast([
            'icon' => 'success',
            'title' => 'Enseignant(e) créé(e) avec succès',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);       
        
        return redirect()->back();
    }


    public function pageAffectMatieres(string $id)
    {
        $filieres = Filiere::with('matieres')->get();
        $niveaux = \App\Models\Niveau::all();
        $enseignant = \App\Models\Enseignant::findOrFail($id);
        return view('pages.gestion_rh.enseignants.AffectMatiere', compact('enseignant', 'filieres', 'niveaux'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $enseignant = \App\Models\Enseignant::findOrFail($id);
        $classes = \App\Models\Classe::all();
        $matieres = \App\Models\Matiere::all();
        return view('pages.gestion_rh.enseignants.edit', compact('enseignant', 'classes', 'matieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:15', // Assuming telephone is a string, adjust as necessary
            'date_embauche' => 'required|date',
            'specialite' => 'nullable|string|max:255',
            'grade' => 'nullable|string|max:255',
            'classe_id' => 'nullable|exists:classes,id',
        ]);

        $enseignant = \App\Models\Enseignant::findOrFail($id);
        $enseignant->update($validatedData);

        if ($request->has('matieres')) {
            $enseignant->matieres()->sync($request->input('matieres'));
        }

        Swal::toast([
            'icon' => 'success',
            'title' => 'Enseignant(e) mis(e) à jour avec succès',
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
        $enseignant = \App\Models\Enseignant::findOrFail($id);
        $enseignant->delete();

        Swal::toast([
            'icon' => 'success',
            'title' => 'Enseignant(e) supprimé(e) avec succès',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);       
        
        return redirect()->back();
    }
}
