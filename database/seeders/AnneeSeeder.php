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
            'code' => '2024-2025',
            'date_debut' => '2024-09-01',
            'date_fin' => '2025-06-30',
            'active' => true,
        ]);

        \App\Models\Annee::create([
            'code' => '2023-2024',
            'date_debut' => '2023-09-01',
            'date_fin' => '2024-06-30',
            'active' => false,
        ]);

        \App\Models\Annee::create([
            'code' => '2022-2023',
            'date_debut' => '2022-09-01',
            'date_fin' => '2023-06-30',
            'active' => false,
        ]);
        
        \App\Models\Annee::create([
            'code' => '2021-2022',
            'date_debut' => '2021-09-01',
            'date_fin' => '2022-06-30',
            'active' => false,
        ]);
        
        \App\Models\Annee::create([
            'code' => '2020-2021',
            'date_debut' => '2020-09-01',
            'date_fin' => '2021-06-30',
            'active' => false,
        ]);
        \App\Models\Annee::create([
            'code' => '2019-2020',
            'date_debut' => '2019-09-01',
            'date_fin' => '2020-06-30',
            'active' => false,
        ]);
        \App\Models\Annee::create([
            'code' => '2018-2019',
            'active' => false,
        ]);
        \App\Models\Annee::create([
            'code' => '2017-2018',
            'date_debut' => '2017-09-01',
            'date_fin' => '2018-06-30',
            'active' => false,
        ]);
    }
}
