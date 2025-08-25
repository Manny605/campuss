<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Enseignant;
use SweetAlert2\Laravel\Swal;

class EnseignantController extends Controller
{


            // $table->id();
            // $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // $table->string('prenom');
            // $table->string('nom');
            // $table->date('date_embauche');
            // $table->string('specialite');
            // $table->string('grade');
            // $table->foreignId('classe_id')->constrained()->onDelete('cascade');
            // $table->timestamps();


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enseignants = Enseignant::orderBy('created_at', 'desc')->paginate(10);
        return view('pages.admin.enseignants.index', compact('enseignants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.enseignants.create', [
            'users' => \App\Models\User::all(),
            'classes' => \App\Models\Classe::all(),
            'matieres' => \App\Models\Matiere::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'identifiant' => 'required|string|max:255|unique:users,identifiant',
            'password' => 'required|string|min:8|confirmed',

            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:15',
            'date_embauche' => 'required|date',
            'specialite' => 'nullable|string|max:255',
            'grade' => 'nullable|string|max:255',
        ]);

        // Create the user first
        $user = \App\Models\User::create([
            'identifiant' => $validatedData['identifiant'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'enseignant', 
        ]);

        // Create the enseignant
        $enseignant = Enseignant::create([
            'user_id' => $user->id,
            'prenom' => $validatedData['prenom'],
            'nom' => $validatedData['nom'],
            'telephone' => $validatedData['telephone'],
            'date_embauche' => $validatedData['date_embauche'],
            'specialite' => $validatedData['specialite'],
            'grade' => $validatedData['grade'],
            'classe_id' => null,
        ]);
        
        Swal::toast([
            'icon' => 'success',
            'title' => 'Enseignant(e) créé(e) avec succès',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);       
        
        return redirect()->back();
    }


    public function pageAffectMatieres(string $id)
    {
        $classes = \App\Models\Classe::all();
        $enseignant = \App\Models\Enseignant::findOrFail($id);
        return view('pages.admin.enseignants.AffectMatiere', compact('enseignant', 'classes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $enseignant = \App\Models\Enseignant::findOrFail($id);
        $classes = \App\Models\Classe::all();
        $matieres = \App\Models\Matiere::all();
        return view('pages.admin.enseignants.edit', compact('enseignant', 'classes', 'matieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'prenom' => 'required|string|max:255',
            'nom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:15', // Assuming telephone is a string, adjust as necessary
            'date_embauche' => 'required|date',
            'specialite' => 'nullable|string|max:255',
            'grade' => 'nullable|string|max:255',
            'classe_id' => 'nullable|exists:classes,id',
        ]);

        $enseignant = \App\Models\Enseignant::findOrFail($id);
        $enseignant->update($validatedData);

        if ($request->has('matieres')) {
            $enseignant->matieres()->sync($request->input('matieres'));
        }

        Swal::toast([
            'icon' => 'success',
            'title' => 'Enseignant(e) mis(e) à jour avec succès',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);       
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $enseignant = \App\Models\Enseignant::findOrFail($id);
        $enseignant->delete();

        Swal::toast([
            'icon' => 'success',
            'title' => 'Enseignant(e) supprimé(e) avec succès',
            'position' => 'top-end',
            'timer' => 3000,
            'showConfirmButton' => false,
        ]);       
        
        return redirect()->back();
    }
}
