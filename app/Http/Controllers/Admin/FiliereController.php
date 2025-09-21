<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Filiere;
use SweetAlert2\Laravel\Swal;


class FiliereController extends Controller
{

    public function index()
    {
        $filieres = Filiere::orderBy('created_at', 'desc')->get();
        return view('pages.gestion_academique.filieres.index', [
            'filieres' => $filieres
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255|unique:filieres,code',
            'nom' => 'required|string|max:255|unique:filieres,nom',
        ]); 

        Filiere::create($validated);

        Swal::toast([
            'icon' => 'success',
            'title' => 'Filière ajoutée avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'code' => 'required|string',
            'nom'  => 'required|string',
        ]);

        $filiere = Filiere::findOrFail($id);

        $filiere->update($validated);

        Swal::toast([
            'icon' => 'success',
            'title' => 'Filière mise à jour avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->back();
    }



    public function destroy($id)
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
}
