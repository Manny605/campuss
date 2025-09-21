<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Periode::create([
            'nom' => 'S1',
        ]);

        \App\Models\Periode::create([
            'nom' => 'S2',
        ]);

        \App\Models\Periode::create([
            'nom' => 'S3',
        ]);
    }
}
