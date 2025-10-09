<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = \Spatie\Permission\Models\Role::where('name', 'admin')->first();
        $enseignantRole = \Spatie\Permission\Models\Role::where('name', 'enseignant')->first();
        $etudiantRole = \Spatie\Permission\Models\Role::where('name', 'etudiant')->first();
        $tuteurRole = \Spatie\Permission\Models\Role::where('name', 'tuteur')->first();
        $comptableRole = \Spatie\Permission\Models\Role::where('name', 'comptable')->first();

        $permissions = \Spatie\Permission\Models\Permission::all();

        // association des permissions au role...flemme de faire...    

    }
}
