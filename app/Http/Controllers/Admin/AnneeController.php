<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Annee;

class AnneeController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'libelle' => 'required|unique:annees',
            'active' => 'boolean',
        ]);

        // Désactive les autres années
        if ($request->active) {
            Annee::query()->update(['active' => false]);
        }

        Annee::create($validated);

        return back()->with('success', 'Année créée avec succès');
    }
}
