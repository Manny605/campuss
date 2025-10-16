<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;



class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [

            // 👑 ADMIN - GESTION SYSTÈME
            'users.view',
            'users.create',
            'users.update',
            'users.delete',
            'roles.manage',
            'assign.roles',
            'filieres.manage',
            'niveaux.manage',
            'classes.manage',
            'classes.assign',
            'stats.global',
            'system.settings',

            // 👨‍🏫 ENSEIGNANT
            'enseignant.classes.view',
            'enseignant.notes.store',
            'enseignant.presences.store',
            'enseignant.timetable.view',
            'enseignant.stats.view',

            // 🎓 ÉTUDIANT
            'etudiant.notes.view',
            'etudiant.presences.view',
            'etudiant.timetable.view',
            'etudiant.paiements.view',
            'etudiant.profile.update',

            // 👨‍👩‍👧 TUTEUR
            'tuteur.enfant.info',
            'tuteur.enfant.notes',
            'tuteur.enfant.presences',
            'tuteur.enfant.finances',
            'tuteur.notifications',

            // 💰 COMPTABLE
            'paiements.manage',
            'paiements.create',
            'paiements.factures.generate',
            'finances.view',
            'frais.manage',
            'finances.export',

            // 🧑‍🏫 RESPONSABLE PÉDAGOGIQUE
            'notes.validate',
            'stats.view',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        $this->command->info('✅ Permissions abrégées créées avec succès.');
    }
}
