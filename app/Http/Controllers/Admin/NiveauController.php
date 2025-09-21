<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SweetAlert2\Laravel\Swal;
use App\Models\Niveau;

class NiveauController extends Controller
{
    public function index() 
    {
        $niveaux = Niveau::all();
        return view('pages.gestion_academique.niveaux.index', compact('niveaux'));
    }


    public function store(Request $request)
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


    public function update(Request $request, $id)
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


    public function destroy($id)
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
}
