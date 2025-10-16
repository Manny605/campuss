<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\FiliereNiveau;
use App\Models\Niveau;
use App\Models\Annee;
use SweetAlert2\Laravel\Swal;
use Illuminate\Http\Request;

class ClasseController extends Controller
{

    public function index() 
    {
        $annee = Annee::where('active', true)->first();
        $filieres_niveaux = FiliereNiveau::with('filiere', 'niveau')->get();
        $classes = Classe::with('anneeAcademique', 'filiereNiveau.filiere', 'filiereNiveau.niveau')->get();
        return view('pages.gestion_academique.classes.index', compact('classes', 'filieres_niveaux', 'annee'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'annee_id' => ['required', 'exists:annees,id'],
            'classes' => ['required', 'array', 'min:1'],
            'classes.*.filiere_niveau_id' => ['required', 'exists:filiere_niveau,id'],
            'classes.*.nom' => ['required', 'string', 'max:255'],
            'classes.*.capacite' => ['required', 'integer', 'min:1'],
        ]);

        foreach ($request->classes as $classData) {
            Classe::create([
                'annee_id' => $request->annee_id,
                'filiere_niveau_id' => $classData['filiere_niveau_id'],
                'nom' => $classData['nom'],
                'capacite' => $classData['capacite'],
            ]);
        }
        
        Swal::toast([
            'icon' => 'success',
            'title' => 'Classes ajoutées avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'filiere_niveau_id' => ['required', 'exists:filiere_niveau,id'],
            'capacite' => ['required', 'integer', 'min:1'],
        ]);

        $classe = Classe::findOrFail($id);
        $classe->update([
            'nom' => $request->nom,
            'filiere_niveau_id' => $request->filiere_niveau_id,
            'capacite' => $request->capacite,
        ]);

        Swal::toast([
            'icon' => 'success',
            'title' => 'Classe mise à jour avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();
    }


    public function destroy($id)
    {
        $classe = Classe::findOrFail($id);
        $classe->delete();
        Swal::toast([
            'icon' => 'success',
            'title' => 'Classe supprimée avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();
    }

}
