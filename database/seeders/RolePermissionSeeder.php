<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $rolePermissions = [

            // ADMIN
            'admin' => [
                'users.view', 'users.create', 'users.update', 'users.delete',
                'roles.manage', 'assign.roles', 'filieres.manage',
                'niveaux.manage', 'classes.manage', 'classes.assign',
                'stats.global', 'system.settings',
            ],

            /// ENSEIGNANT
            'enseignant' => [
                'enseignant.classes.view',
                'enseignant.notes.store',
                'enseignant.presences.store',
                'enseignant.timetable.view',
                'enseignant.stats.view',
            ],

            // ÉTUDIANT
            'etudiant' => [
                'etudiant.notes.view',
                'etudiant.presences.view',
                'etudiant.timetable.view',
                'etudiant.paiements.view',
                'etudiant.profile.update',
            ],

            // / TUTEUR
            'tuteur' => [
                'tuteur.enfant.info',
                'tuteur.enfant.notes',
                'tuteur.enfant.presences',
                'tuteur.enfant.finances',
                'tuteur.notifications',
            ],

            // COMPTABLE
            'comptable' => [
                'paiements.manage',
                'paiements.create',
                'paiements.factures.generate',
                'finances.view',
                'frais.manage',
                'finances.export',
            ],

            // RESPONSABLE PÉDAGOGIQUE
            // 'responsable_pedagogique' => [
            //     'filieres.manage',
            //     'niveaux.manage',
            //     'classes.manage',
            //     'classes.assign',
            //     'notes.validate',
            //     'stats.view',
            // ],

            // SUPER ADMIN
            // 'super_admin' => ['*'],
        ];

        foreach ($rolePermissions as $roleName => $permissions) {
            $role = Role::where('name', $roleName)->first();

            if (!$role) {
                $this->command->warn("⚠️ Rôle '$roleName' non trouvé, ignoré.");
                continue;
            }

            if (in_array('*', $permissions)) {
                $role->syncPermissions(Permission::all());
                $this->command->info("✅ Rôle '$roleName' → toutes les permissions attribuées.");
            } else {
                // Vérifie ou crée les permissions manquantes
                foreach ($permissions as $perm) {
                    Permission::firstOrCreate(['name' => $perm]);
                }

                $role->syncPermissions($permissions);
                $this->command->info("✅ Rôle '$roleName' → " . count($permissions) . " permissions attribuées.");
            }
        }

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }  

}
