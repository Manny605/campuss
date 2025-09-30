<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\Classe;
use App\Models\Niveau;
use App\Models\Filiere;
use App\Models\Annee;
use App\Models\Periode;
use App\Models\Matiere;
use App\Models\Enseignant;
use App\Models\Filiere_Niveau;
use App\Models\Filiere_Matiere;


class ProgrammeController extends Controller
{

    // Index methods
    public function indexAnnee() 
    {
        $annees = Annee::orderBy('created_at', 'desc')->get();
        return view('pages.admin.programmes.annees.index', compact('annees'));
    }

    

    public function indexMatiere() 
    {
        $matieres = Matiere::all();
        return view('pages.admin.programmes.matieres.index', compact('matieres'));
    }






    public function indexMatiereToEnseignant() 
    {
        $matieres = Matiere::all();
        $enseignants = Enseignant::all();
        return view('pages.admin.programmes.affectME.index', compact('matieres', 'enseignants'));
    }




























    
    // Store methods
    public function storeAnnee(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:annees,code', 
            'date_debut' => 'required|date', 
            'date_fin' => 'required|date|after:date_debut', 
            'active' => 'sometimes|boolean',
        ]);


        Annee::create($validated->all());

        Swal::toast([
            'icon' => 'success',
            'title' => 'Année scolaire ajoutée avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        
        return redirect()->back();
    }







    public function storeMatiereToFiliere(Request $request)
    {
        $request->validate([
            'matiere_id' => 'required',
            'enseignant_id' => 'required'
        ]);

        $matiere = Matiere::findOrFail($request->matiere_id);
        $matiere->enseignant_id = $request->enseignant_id;
        $matiere->save();

        return redirect()->back()->with('success', 'Matiere affecté à la matière.');
    }

    public function storeMatiereToEnseignant(Request $request)
    {
        $request->validate([
            'matiere_id' => 'required',
            'enseignant_id' => 'required'
        ]);

        $matiere = Matiere::findOrFail($request->matiere_id);
        $matiere->enseignant_id = $request->enseignant_id;
        $matiere->save();

        return redirect()->back()->with('success', 'Matiere affecté à la matière.');
    }










    // Update methods
    public function updateAnnee(Request $request, $id)
    {
        $request->validate([
            'libelle' => 'required',
            'active' => 'boolean',
        ]);

        $annee = Annee::findOrFail($id);
        $annee->update($request->all());

        Swal::toast([
            'icon' => 'success',
            'title' => 'Année scolaire mise à jour avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();
    }



    public function updateMatiere(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|unique:matieres,code,' . $id,
            'nom' => 'required',
            'coefficient' => 'required|numeric|between:0,10',
        ]);

        $matiere = Matiere::findOrFail($id);
        $matiere->update($request->all());

        Swal::toast([
            'icon' => 'success',
            'title' => 'Matière mise à jour avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();
    }















    // Delete methods
    public function destroyAnnee($id)
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





    public function destroyMatiere($id)
    {
        $matiere = Matiere::findOrFail($id);
        $matiere->delete();
        Swal::toast([
            'icon' => 'success',
            'title' => 'Matière supprimée avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();
    }



    public function destroyMatiereToFiliere($id)
    {
        $matiere = Matiere::findOrFail($id);
        $matiere->enseignant_id = null;
        $matiere->save();

        Swal::toast([
            'icon' => 'success',
            'title' => 'Affectation supprimée avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();
    }

    public function destroyMatiereToEnseignant($id)
    {
        $matiere = Matiere::findOrFail($id);
        $matiere->enseignant_id = null;
        $matiere->save();

        Swal::toast([
            'icon' => 'success',
            'title' => 'Affectation supprimée avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();
    }



}
