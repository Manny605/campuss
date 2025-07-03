<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FiliereMatiereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filieres = \App\Models\Filiere::pluck('id')->toArray();
        $matieres = \App\Models\Matiere::pluck('id')->toArray();

        // Seed 10 random filiere-matiere associations
        for ($i = 0; $i < 50; $i++) {
            // Select a random filiere
            $filiereId = $filieres[array_rand($filieres)];

            // Select 2 to 4 random matieres for this filiere
            $matiereIds = array_rand($matieres, rand(9, 15));
            if (!is_array($matiereIds)) {
                $matiereIds = [$matiereIds];
            }

            foreach ($matiereIds as $matiereKey) {
                \App\Models\Filiere_Matiere::create([
                    'filiere_id' => $filiereId,
                    'matiere_id' => $matieres[$matiereKey],
                    'coefficient' => rand(1, 5),
                ]);
            }
        }
    }
}
