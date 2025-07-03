<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Semestre::create([
            'annee_id' => 1, // Assuming you have an Annee with ID 1
            'code' => 'S1',
        ]);

        \App\Models\Semestre::create([
            'annee_id' => 1, // Assuming you have an Annee with ID 1
            'code' => 'S2',
        ]);

        \App\Models\Semestre::create([
            'annee_id' => 1, // Assuming you have an Annee with ID 2
            'code' => 'S3',
        ]);
    }
}
