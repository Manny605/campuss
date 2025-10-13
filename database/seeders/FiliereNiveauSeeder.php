<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Filiere;
use App\Models\Niveau;
use App\Models\FiliereNiveau;
use App\Models\Annee;
use App\Models\Classe;

class FiliereNiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filieres = Filiere::pluck('id')->toArray();
        $niveaux = Niveau::pluck('id')->toArray();
        $annee = Annee::where('active', true)->first();

        if (!$annee) {
            // Optionally, you can throw an exception or log a warning here
            return;
        }

        foreach ($filieres as $filiere_id) {
            // Pick 2 or 3 random niveaux for each filiere
            $randomNiveaux = collect($niveaux)->random(rand(2, 3));
            foreach ($randomNiveaux as $niveau_id) {
                $filiereNiveau = FiliereNiveau::create([
                    'filiere_id' => $filiere_id,
                    'niveau_id' => $niveau_id,
                ]);

                Classe::create([
                    'annee_id' => $annee->id,
                    'filiere_niveau_id' => $filiereNiveau->id,
                    'nom' => strtoupper(Filiere::find($filiere_id)->code . Niveau::find($niveau_id)->nom),
                    'capacite' => rand(30, 60),
                ]);
            }
        }
    }
}
