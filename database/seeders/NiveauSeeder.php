<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Niveau::create([
            'nom' => 'BT',
        ]);

        \App\Models\Niveau::create([
            'nom' => 'BTS',
        ]);

        \App\Models\Niveau::create([
            'nom' => 'Licence',
        ]);

        \App\Models\Niveau::create([
            'nom' => 'Master 1',
        ]);

        \App\Models\Niveau::create([
            'nom' => 'Master 2',
        ]);
    }
}
