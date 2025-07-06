<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;

use App\Models\Classe;
use App\Models\Niveau;
use App\Models\Filiere;
use App\Models\Annee;
use App\Models\Semestre;
use App\Models\Matiere;
use App\Models\Enseignant;
use App\Models\Filiere_Niveau;


class ProgrammeController extends Controller
{

    // Index methods
    public function indexAnnee() 
    {
        $annees = Annee::orderBy('created_at', 'desc')->get();
        return view('pages.admin.programmes.annees.index', compact('annees'));
    }

    public function indexFiliere() 
    {
        $filieres = Filiere::all();
        return view('pages.admin.programmes.filieres.index', compact('filieres'));
    }

    public function indexSemestre() 
    {
        $semestres = Semestre::all();
        $annees = Annee::all();
        return view('pages.admin.programmes.semestres.index', compact('semestres', 'annees'));
    }

    public function indexMatiere() 
    {
        $matieres = Matiere::all();
        return view('pages.admin.programmes.matieres.index', compact('matieres'));
    }

    public function indexNiveau() 
    {
        $niveaux = Niveau::all();
        return view('pages.admin.programmes.niveaux.index', compact('niveaux'));
    }

    public function indexClasse($id) 
    {
        $filiere = Filiere::findOrFail($id);
        $niveaux = Niveau::all();
        $filiereNiveaux = $filiere->niveaux()->pluck('id')->toArray();

        return view('pages.admin.programmes.classes.index', compact('niveaux', 'filiere', 'filiereNiveaux'));
    }

    public function indexMatiereToFiliere($id) 
    {
        $filiere = Filiere::findOrFail($id);
        $matieres = Matiere::all();
        $niveaux = Niveau::all();
        $filiereMatieres = $filiere->matieres()->pluck('matieres.id')->toArray();
        $filiereNiveaux = $filiere->niveaux()->pluck('niveaux.id')->toArray();

        return view('pages.admin.programmes.affectMF.index', compact('matieres', 'niveaux', 'filiere', 'filiereMatieres', 'filiereNiveaux'));
    }

    public function indexMatiereToEnseignant() 
    {
        $matieres = Matiere::all();
        $enseignants = Enseignant::all();
        return view('pages.admin.programmes.affectME.index', compact('matieres', 'enseignants'));
    }







    // Create methods
    public function createClasse(Request $request)
    {
        $filieres = Filiere::all();
        $niveaux = Niveau::all();
        return view('pages.admin.programmes.classes.create', compact('filieres', 'niveaux'));
    }







    // Show methods
    public function showFiliere($id)
    {
        $filiere = Filiere::findOrFail($id);
        return view('pages.admin.programmes.filieres.show', compact('filiere'));
    }











    
    // Store methods
    public function storeAnnee(Request $request)
    {
        $request->validate([
            'libelle' => 'required',
            'active' => 'boolean',
        ]);

        Annee::create($request->all());

        Swal::toast([
            'icon' => 'success',
            'title' => 'Année scolaire ajoutée avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();
    }

    public function storeFiliere(Request $request)
    {
        $request->validate([
            'code' => 'required', 
            'nom' => 'required'
        ]);
        Filiere::create($request->all());

        Swal::toast([
            'icon' => 'success',
            'title' => 'Filière ajoutée avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();
    }

    public function storeSemestre(Request $request)
    {
        $request->validate([
            'annee_id' => 'required|exists:annees,id',
            'code' => 'required|unique:semestres,code',
        ]);

        Semestre::create($request->all());

        Swal::toast([
            'icon' => 'success',
            'title' => 'Semestre ajouté avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();
    }

    public function storeMatiere(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:matieres,code',
            'nom' => 'required',
        ]);
        Matiere::create($request->all());

        Swal::toast([
            'icon' => 'success',
            'title' => 'Matière ajoutée avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();
    }

    public function storeNiveau(Request $request)
    { 
        $request->validate(['nom' => 'required']);

        Niveau::create($request->all());

        Swal::toast([
            'icon' => 'success',
            'title' => 'Niveau ajouté avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();
    }

    public function storeClasse(Request $request)
    {
        $request->validate([
            'filiere_niveau_id' => 'required|exists:filiere_niveau,id',
            'annee_id' => 'required|exists:annees,id',
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

    public function updateFiliere(Request $request, $id)
    {
        $request->validate([
            'code' => 'required', 
            'nom' => 'required'
        ]);

        $filiere = Filiere::findOrFail($id);
        $filiere->update($request->all());

        Swal::toast([
            'icon' => 'success',
            'title' => 'Filière mise à jour avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();
    }

    public function updateSemestre(Request $request, $id)
    {
        $request->validate([
            'annee_id' => 'required|exists:annees,id',
            'code' => 'required|unique:semestres,code,' . $id,
        ]);

        $semestre = Semestre::findOrFail($id);
        $semestre->update($request->all());

        Swal::toast([
            'icon' => 'success',
            'title' => 'Semestre mis à jour avec succès.',
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

    public function updateNiveau(Request $request, $id)
    {
        $request->validate(['nom' => 'required']);

        $niveau = Niveau::findOrFail($id);
        $niveau->update($request->all());

        Swal::toast([
            'icon' => 'success',
            'title' => 'Niveau mis à jour avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();    
    }

    public function updateClasse(Request $request, $id)
    {
        $request->validate([
            'filiere_niveau_id' => 'required|exists:filieres,id',
            'annee_id' => 'required|exists:annees,id',
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

    public function updateAffectToFiliere(Request $request, $id)
    {
        $filiere = Filiere::findOrFail($id);
        $matiereIds = $request->input('matieres', []);
        $niveauIds = $request->input('niveaux', []);

        // Synchroniser les matières et niveaux
        $filiere->matieres()->sync($matiereIds);
        $filiere->niveaux()->sync($niveauIds);

        // Obtenir l'année active ou en cours
        $annee = Annee::where('active', true)->first();
        if (!$annee) {
            return redirect()->back()->with('error', 'Aucune année académique active trouvée.');
        }

        // Pour chaque niveau sélectionné, créer un Filiere_Niveau si non existant
        foreach ($niveauIds as $niveauId) {
            $filiereNiveau = Filiere_Niveau::firstOrCreate([
                'filiere_id' => $filiere->id,
                'niveau_id' => $niveauId,
            ]);

            // Créer la classe si elle n'existe pas déjà pour cette combinaison
            Classe::firstOrCreate([
                'filiere_niveau_id' => $filiereNiveau->id,
                'annee_id' => $annee->id,
            ]);
        }

        Swal::toast([
            'icon' => 'success',
            'title' => 'Les affectations ont été mises à jour avec succès.',
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

    public function destroyFiliere($id)
    {
        $filiere = Filiere::findOrFail($id);
        $filiere->delete();
        Swal::toast([
            'icon' => 'success',
            'title' => 'Filière supprimée avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();    
    }

    public function destroySemestre($id)
    {
        $semestre = Semestre::findOrFail($id);
        $semestre->delete();
        Swal::toast([
            'icon' => 'success',
            'title' => 'Semestre supprimé avec succès.',
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

    public function destroyNiveau($id)
    {
        $niveau = Niveau::findOrFail($id);
        $niveau->delete();
        Swal::toast([
            'icon' => 'success',
            'title' => 'Niveau supprimé avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();
    }

    public function destroyClasse($id)
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
