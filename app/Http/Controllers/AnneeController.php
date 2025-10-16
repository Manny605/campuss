<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Annee;
use SweetAlert2\Laravel\Swal;


class AnneeController extends Controller
{

    public function index()
    {
        $annees = Annee::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.gestion_academique.annees.index', [
            'annees' => $annees
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:annees,code', 
            'date_debut' => 'required|date', 
            'date_fin' => 'required|date|after:date_debut', 
            'active' => 'sometimes|boolean',
        ]);


        Annee::create($validated);

        Swal::toast([
            'icon' => 'success',
            'title' => 'Année scolaire ajoutée avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'code' => 'required|unique:annees,code,'.$id.',id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'active' => 'sometimes|boolean',
        ]);

        $annee = Annee::findOrFail($id);
        $annee->update($validated);

        Swal::toast([
            'icon' => 'success',
            'title' => 'Année scolaire mise à jour avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $annee = Annee::findOrFail($id);
        $annee->delete();

        Swal::toast([
            'icon' => 'success',
            'title' => 'Année scolaire supprimée avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->back();    
    }
}
