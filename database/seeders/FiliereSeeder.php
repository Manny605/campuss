<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FiliereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Filiere::create([
            'code' => 'FIL101',
            'nom' => 'Informatique',
        ]);

        \App\Models\Filiere::create([
            'code' => 'FIL102',
            'nom' => 'Mathématiques',
        ]);

        \App\Models\Filiere::create([
            'code' => 'FIL103',
            'nom' => 'Physique',
        ]);

        \App\Models\Filiere::create([
            'code' => 'FIL104',
            'nom' => 'Chimie',
        ]);

        \App\Models\Filiere::create([
            'code' => 'FIL105',
            'nom' => 'Biologie',
        ]);
        \App\Models\Filiere::create([
            'code' => 'FIL107',
            'nom' => 'Sciences de l\'Ingénieur',
        ]);
        \App\Models\Filiere::create([
            'code' => 'FIL108',
            'nom' => 'Arts et Lettres',
        ]);
        \App\Models\Filiere::create([
            'code' => 'FIL109',
            'nom' => 'Economie et Gestion',
        ]);
        \App\Models\Filiere::create([
            'code' => 'FIL110',
            'nom' => 'Psychologie',
        ]);
        \App\Models\Filiere::create([
            'code' => 'FIL111',
            'nom' => 'Sociologie',
        ]);
        \App\Models\Filiere::create([
            'code' => 'FIL112',
            'nom' => 'Histoire et Géographie',
        ]);
        \App\Models\Filiere::create([
            'code' => 'FIL113',
            'nom' => 'Philosophie',
        ]);
        \App\Models\Filiere::create([
            'code' => 'FIL114',
            'nom' => 'Droit',
        ]);
    }
}
