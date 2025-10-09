<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Filiere;
use App\Models\Niveau;
use App\Models\Annee;
use Illuminate\Http\Request;

class ClasseController extends Controller
{

    public function index() 
    {
        $filieres = Filiere::all();
        $niveaux = Niveau::all();
        $annees = Annee::all();
        return view('pages.gestion_academique.classes.index', compact('filieres', 'niveaux', 'annees'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'annee_id' => 'required|exists:annees,id',
            'filiere_id' => 'required|exists:filieres,id',
            'niveau_id' => 'required|exists:niveaux,id',
            'nom' => 'required|string|max:255',
            'capacite' => 'nullable|integer|min:1',
        ]);

        Classe::create($request->all());

        Swal::toast([
            'icon' => 'success',
            'title' => 'Classe ajoutée avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'annee_id' => 'required|exists:annees,id',
            'filiere_id' => 'required|exists:filieres,id',
            'niveau_id' => 'required|exists:niveaux,id',
            'nom' => 'required|string|max:255',
            'capacite' => 'nullable|integer|min:1',
        ]);

        $classe = Classe::findOrFail($id);
        $classe->update($request->all());

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
