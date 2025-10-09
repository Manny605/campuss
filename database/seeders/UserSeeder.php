<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'prenom' => 'Admin',
            'nom' => 'Admin',
            'telephone' => '0000000000',
            'identifiant' => 'admin',
            'password' => Hash::make('admin'),
            'statut' => 'active',
            'avatar_url' => null,
        ]);

        $admin = User::where('identifiant', 'admin')->first();
        $admin->assignRole('admin');
    }
}
