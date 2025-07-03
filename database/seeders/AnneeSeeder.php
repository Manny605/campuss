<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnneeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Annee::create([
            'libelle' => '2024-2025',
            'active' => true, // Indique que c'est l'année académique active
        ]);

        \App\Models\Annee::create([
            'libelle' => '2023-2024',
            'active' => false,
        ]);

        \App\Models\Annee::create([
            'libelle' => '2022-2023',
            'active' => false,
        ]);
        
        \App\Models\Annee::create([
            'libelle' => '2021-2022',
            'active' => false,
        ]);
        
        \App\Models\Annee::create([
            'libelle' => '2020-2021',
            'active' => false,
        ]);
        \App\Models\Annee::create([
            'libelle' => '2019-2020',
            'active' => false,
        ]);
        \App\Models\Annee::create([
            'libelle' => '2018-2019',
            'active' => false,
        ]);
        \App\Models\Annee::create([
            'libelle' => '2017-2018',
            'active' => false,
        ]);
    }
}
