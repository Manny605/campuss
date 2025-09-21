<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MatiereController extends Controller
{
    public function update(Request $request, $id) 
    {
        $request->validate([
            'code' => 'required|unique:matieres,code,' . $id . '|max:10',
            'nom' => 'required|max:255',
            'coefficient' => 'required|numeric|between:0,10',
        ]);

        $matiere = \App\Models\Matiere::findOrFail($id);
        $matiere->update($request->only('code', 'nom', 'coefficient'));

        \SweetAlert2\Laravel\Swal::toast([
            'icon' => 'success',
            'title' => 'Matière mise à jour avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->back();

    }

    public function destroy($id) 
    {
        $matiere = \App\Models\Matiere::findOrFail($id);
        $matiere->delete();

        \SweetAlert2\Laravel\Swal::toast([
            'icon' => 'success',
            'title' => 'Matière supprimée avec succès.',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);

        return redirect()->back();
    }
}
