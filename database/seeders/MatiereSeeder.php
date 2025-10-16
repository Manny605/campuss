<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Matiere;
use App\Models\Niveau;
use App\Models\Periode;

class MatiereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prefixes = [
            'MAT' => 'Mathematics',
            'PHY' => 'Physics',
            'CHEM' => 'Chemistry',
            'BIO' => 'Biology',
            'CS' => 'Computer Science',
            'ENG' => 'English Literature',
            'HIST' => 'History',
            'ART' => 'Art History',
            'ECON' => 'Economics',
            'PSY' => 'Psychology',
            'SOC' => 'Sociology',
            'PHIL' => 'Philosophy',
            'GEO' => 'Geography',
            'STAT' => 'Statistics',
            'BIOCHEM' => 'Biochemistry',
            'ASTRO' => 'Astronomy',
            'ENV' => 'Environmental Science',
        ];

        $periodes = Periode::all(); // Fetch all Periode objects
        $niveau = Niveau::inRandomOrder()->first()->nom;
        $coefs = [1, 2, 3, 4, 5]; // coefficients aléatoires possibles

        foreach ($prefixes as $codePrefix => $nom) {
            foreach ($periodes as $periode) {
                Matiere::create([
                    'code' => $codePrefix . '-' . strtoupper($niveau) . '-' . $periode->id,
                    'nom' => $this->randomNom($nom),
                    'coefficient' => $coefs[array_rand($coefs)],
                    'periode_id' => $periode->id,
                ]);
            }
        }
    }

    /**
     * Génère un nom plus aléatoire pour éviter la monotonie.
     */
    private function randomNom(string $baseNom): string
    {
        $suffixes = [
            '', ' - Fundamentals', ' - Advanced', ' - Applied', ' - Principles', ' - Introduction', ' - Techniques'
        ];

        return $baseNom . $suffixes[array_rand($suffixes)];
    }
}
