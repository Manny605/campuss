<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SweetAlert2\Laravel\Swal;
use App\Models\Periode;


class PeriodeController extends Controller
{
    public function index() 
    {
        $periodes = Periode::all();
        return view('pages.gestion_academique.periodes.index', compact('periodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|unique:periodes,nom',
        ]);

        Periode::create($request->all());

        Swal::toast([
            'icon' => 'success',
            'title' => 'Periode ajouté avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->back();
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|unique:periodes,nom,' . $id,
        ]);

        $periode = Periode::findOrFail($id);
        $periode->update($request->all());

        Swal::toast([
            'icon' => 'success',
            'title' => 'Periode mis à jour avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();
    }


    public function destroy($id)
    {
        $periode = Periode::findOrFail($id);
        $periode->delete();
        Swal::toast([
            'icon' => 'success',
            'title' => 'Periode supprimée avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);
        return redirect()->back();
    }
}
