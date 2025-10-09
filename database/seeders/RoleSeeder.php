<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        \Spatie\Permission\Models\Role::create(['name' => 'admin']);
        \Spatie\Permission\Models\Role::create(['name' => 'enseignant']);
        \Spatie\Permission\Models\Role::create(['name' => 'etudiant']);
        \Spatie\Permission\Models\Role::create(['name' => 'tuteur']);
        \Spatie\Permission\Models\Role::create(['name' => 'comptable']);

        //Exxemple des roles qui pourraient être ajoutés plus tard (non limites)
        // \Spatie\Permission\Models\Role::create(['name' => 'responsable_pedagogique']);

    }
}
