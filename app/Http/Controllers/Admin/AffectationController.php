<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Filiere;
use App\Models\Matiere;
use App\Models\Niveau;
use App\Models\Periode;
use App\Models\Annee;
use App\Models\Filiere_Niveau;

class AffectationController extends Controller
{
    // Page pour afficher les niveaux d'une filière
    public function PageAffectNiveauxToFiliere($id) 
    {
        $filiere = Filiere::findOrFail($id);
        $matieres = Matiere::all();
        $niveaux = Niveau::all();
        $periodes = Periode::all();
        $filiereNiveaux = $filiere->niveaux()->pluck('niveaux.id')->toArray();
        // $filiereMatieres = $filiere->matieres()->pluck('matieres.id')->toArray();

        return view('pages.gestion_academique.filieres.AffectNiveauxToFiliere', compact('matieres', 'niveaux', 'filiere', 'periodes', 'filiereNiveaux'));
    }

    // Affecter des niveaux à une filière
    public function AffectNiveauxToFiliere(Request $request, $id)
    {
        $filiere = Filiere::findOrFail($id);
        $niveauIds = $request->input('niveaux', []);

        // Synchroniser directement les niveaux avec la filière
        $filiere->niveaux()->sync($niveauIds);

        // Vérifier qu’une année académique est active
        $annee = Annee::where('active', true)->first();
        if (!$annee) {
            return redirect()->back()->with('error', 'Aucune année académique active trouvée.');
        }

        // Toast de confirmation
        \SweetAlert2\Laravel\Swal::toast([
            'icon' => 'success',
            'title' => 'Les affectations ont été mises à jour avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->back();
    }


















    public function PageAffectMatieresToFiliereByPeriode($filiere_id, $periode_id)
    {
        $filiere = Filiere::findOrFail($filiere_id);
        $periode = Periode::findOrFail($periode_id);
        $matieres_associees = $filiere->matieres()->where('periode_id', $periode->id)->orderBy('created_at', 'desc')->get();
        return view('pages.gestion_academique.filieres.AffectMatieresToFiliereByPeriode', compact('filiere', 'periode', 'matieres_associees'));
    }


    public function AffectMatieresToFiliereByPeriode(Request $request)
    {
        // Validation des données
        $request->validate([
            'filiere_id' => 'required|exists:filieres,id',
            'matieres' => 'required|array|min:1',
            'matieres.*.code' => 'required|unique:matieres,code|max:10',
            'matieres.*.nom' => 'required|max:255',
            'matieres.*.coefficient' => 'required|numeric|between:0,10',
            'periode_id' => 'required|exists:periodes,id',
        ]);

        $filiere = Filiere::findOrFail($request->filiere_id);
        $periodeId = $request->periode_id;
        $matieresData = $request->matieres;

        try {
            // Créer les matières et les associer directement
            foreach ($matieresData as $matiere) {
                $created = Matiere::create([
                    'code'        => $matiere['code'],
                    'nom'         => $matiere['nom'],
                    'coefficient' => $matiere['coefficient'],
                    'periode_id' => $periodeId,
                ]);

                // Associer via la relation belongsToMany()
                $filiere->matieres()->attach($created->id);
            }

            // Toast succès
            \SweetAlert2\Laravel\Swal::toast([
                'icon' => 'success',
                'title' => 'Matière(s) ajoutée(s) avec succès.',
                'position' => 'top-end',
                'timer' => 3000,
                'showConfirmButton' => false,
            ]);

            return redirect()->back();

        } catch (\Exception $e) {
            \SweetAlert2\Laravel\Swal::toast([
                'icon' => 'error',
                'title' => 'Erreur lors de l\'ajout.',
                'text' => $e->getMessage(),
                'position' => 'top-end',
                'showConfirmButton' => true,
            ]);

            return redirect()->back()->withInput();
        }
    }





}
