<x-layout>
    <x-slot:title>Modification d'un compte - {{ $role->name }}</x-slot:title>
    <x-slot:header>Modification d'un compte - {{ $role->name }}</x-slot:header>

    <div class="p-6">
        <h1 class="text-3xl font-bold mb-8 flex items-center gap-3 text-indigo-700">
            <i class="fas fa-edit"></i> Modification du compte ({{ $role->name }})
        </h1>

        <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Informations personnelles -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-id-card text-indigo-500"></i> Informations personnelles
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input icon="fas fa-id-badge" placeholder="Prénom" name="prenom" type="text"
                        value="{{ old('prenom', $user->prenom) }}" required />
                    <x-input icon="fas fa-user" placeholder="Nom" name="nom" type="text"
                        value="{{ old('nom', $user->nom) }}" required />
                    <x-input icon="fas fa-phone" placeholder="Téléphone" name="telephone" type="text"
                        value="{{ old('telephone', $user->telephone) }}" required />
                </div>
            </div>

            <!-- Identifiants -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-user-circle text-indigo-500"></i> Identifiants de connexion
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input icon="fas fa-user-circle" placeholder="Identifiant" name="identifiant" type="text"
                        value="{{ old('identifiant', $user->identifiant) }}" required />
                    <x-input icon="fas fa-lock" placeholder="Nouveau mot de passe (optionnel)" name="password"
                        type="password" />
                    <x-input icon="fas fa-lock" placeholder="Confirmer le mot de passe" name="password_confirmation"
                        type="password" />
                </div>
            </div>

            <!-- Paramètres -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-user-cog text-indigo-500"></i> Paramètres du compte
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Avatar -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-image mr-2 text-indigo-500"></i>Avatar
                        </label>
                        @if ($user->avatar_url)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $user->avatar_url) }}"
                                    class="h-16 w-16 rounded-full object-cover border">
                            </div>
                        @endif
                        <input type="file" name="avatar_url" accept="image/*"
                            class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md 
                                   file:border-0 file:text-sm file:font-semibold 
                                   file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer" />
                    </div>

                    <!-- Rôle -->
                    <div class="relative hidden">
                        <select id="role-select" name="role"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                            <option value="">{{ '-- Selectionnez un rôle --' }}</option>
                            <option value="{{ $role->name }}" @selected(old('role', $user->roles->first()->name ?? '') == $role->name)>
                                {{ ucfirst($role->name) }}
                            </option>
                        </select>
                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Étudiant -->
            <div id="etudiant-fields" class="bg-white p-6 rounded-xl shadow-md hidden">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-user-graduate text-indigo-500"></i> Informations étudiant
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <x-input placeholder="Matricule" name="matricule" type="text"
                        value="{{ old('matricule', $user->etudiant->matricule ?? '') }}" />
                    <x-input placeholder="Date de naissance" name="date_naissance" type="date"
                        value="{{ old('date_naissance', $user->etudiant->date_naissance ?? '') }}" />
                    <x-input placeholder="Lieu de naissance" name="lieu_naissance" type="text"
                        value="{{ old('lieu_naissance', $user->etudiant->lieu_naissance ?? '') }}" />
                    <div class="relative">
                        <select id="genre" name="genre"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                            <option value="">{{ '-- Type de genre --' }}</option>
                            <option value="masculin" @selected(old('genre', $user->etudiant->genre ?? '') == 'masculin')>Masculin</option>
                            <option value="feminin" @selected(old('genre', $user->etudiant->genre ?? '') == 'feminin')>Féminin</option>
                        </select>
                        @error('genre')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Gestion des tuteurs associés -->
                <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-4 flex items-center gap-2">
                    <i class="fas fa-user-shield text-indigo-500"></i> Tuteur associé
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-input placeholder="Prénom du tuteur" name="prenom_tuteur" type="text"
                        value="{{ old('prenom_tuteur', $tuteur->user->prenom ?? '') }}" />
                    <x-input placeholder="Nom du tuteur" name="nom_tuteur" type="text"
                        value="{{ old('nom_tuteur', $tuteur->user->nom ?? '') }}" />
                    <x-input placeholder="Téléphone du tuteur" name="telephone_tuteur" type="text"
                        value="{{ old('telephone_tuteur', $tuteur->user->telephone ?? '') }}" />
                    <x-input icon="fas fa-lock" placeholder="Nouveau mot de passe (optionnel)" name="password_tuteur"
                        type="password" />
                    <x-input icon="fas fa-lock" placeholder="Confirmer le mot de passe"
                        name="password_tuteur_confirmation" type="password" />
                    <div class="relative">
                        <select id="relation" name="relation"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg 
               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                            <option value="">{{ __('-- Relation avec l\'étudiant --') }}</option>
                            <option value="pere" @selected(old('relation', $tuteur->relation ?? '') === 'pere')>Père</option>
                            <option value="mere" @selected(old('relation', $tuteur->relation ?? '') === 'mere')>Mère</option>
                            <option value="autre" @selected(old('relation', $tuteur->relation ?? '') === 'autre')>Autre</option>
                        </select>

                        @error('relation')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>
    </div>

    <!-- Boutons -->
    <div class="flex gap-4 mt-8">
        <button type="submit"
            class="inline-flex items-center gap-2 px-8 py-3 bg-indigo-600 hover:bg-indigo-700 
                           text-white font-semibold rounded-xl shadow-md transition">
            <i class="fas fa-check"></i> Enregistrer
        </button>
        <a href="{{ route('users.indexUsersByRole', $role) }}"
            class="inline-flex items-center gap-2 px-8 py-3 border border-gray-300 
                           text-gray-700 rounded-xl hover:bg-gray-100 transition">
            <i class="fas fa-arrow-left"></i> Retour
        </a>
    </div>
    </form>
    </div>

    <!-- JS pour afficher les champs selon le rôle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role-select');
            const etuFields = document.getElementById('etudiant-fields');

            function toggleSections(role) {
                etuFields.classList.toggle('hidden', role !== 'etudiant');
            }

            toggleSections(roleSelect.value.toLowerCase());
            roleSelect.addEventListener('change', () => toggleSections(roleSelect.value.toLowerCase()));
        });
    </script>
</x-layout>
