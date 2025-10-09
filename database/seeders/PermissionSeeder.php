<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Spatie\Permission\Models\Permission::create(['name' => 'gestion.utilisateurs']);
        \Spatie\Permission\Models\Permission::create(['name' => 'gestion.roles']);
        \Spatie\Permission\Models\Permission::create(['name' => 'gestion.permissions']);
        \Spatie\Permission\Models\Permission::create(['name' => 'gestion.cours']);
        \Spatie\Permission\Models\Permission::create(['name' => 'gestion.evaluations']);
        \Spatie\Permission\Models\Permission::create(['name' => 'gestion.notes']);
        \Spatie\Permission\Models\Permission::create(['name' => 'gestion.absences']);
        \Spatie\Permission\Models\Permission::create(['name' => 'gestion.factures']);
        \Spatie\Permission\Models\Permission::create(['name' => 'gestion.paiements']);
        \Spatie\Permission\Models\Permission::create(['name' => 'gestion.emplois_du_temps']);
    }
}
