<x-layout>
    <x-slot:title>Création d'un compte {{ $role->name }}</x-slot:title>
    <x-slot:header>Création d'un compte {{ $role->name }}</x-slot:header>

    <div class="p-6">
        <!-- Titre principal -->
        <h1 class="text-3xl font-bold mb-8 flex items-center gap-3 text-indigo-700">
            <i class="fas fa-user-plus"></i> Création d'un compte {{ $role->name }}
        </h1>

        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-id-card text-indigo-500"></i> Informations personnelles
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input icon="fas fa-id-badge" placeholder="Prénom" name="prenom" type="text"
                        value="{{ old('prenom') }}" required />
                    <x-input icon="fas fa-user" placeholder="Nom" name="nom" type="text"
                        value="{{ old('nom') }}" required />
                    <x-input icon="fas fa-phone" placeholder="Téléphone" name="telephone" type="text"
                        value="{{ old('telephone') }}" required />
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-user-circle text-indigo-500"></i> Identifiants de connexion
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input icon="fas fa-user-circle" placeholder="Identifiant" name="identifiant" type="text"
                        value="{{ old('identifiant') }}" required />
                    <x-input icon="fas fa-lock" placeholder="Mot de passe" name="password" type="password" required />
                    <x-input icon="fas fa-lock" placeholder="Confirmer le mot de passe" name="password_confirmation"
                        type="password" required />
                </div>
            </div>

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
                        <input type="file" name="avatar_url" accept="image/*"
                            class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md 
                                   file:border-0 file:text-sm file:font-semibold 
                                   file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer" />
                    </div>

                    <!-- Rôle -->
                    {{-- <div class="relative">
                        <select id="role-select" name="role"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                            <option value="">{{ '-- Selectionnez un role --' }}</option>
                            @foreach ($roles->where('name', '!=', 'Tuteur') as $role)
                                <option value="{{ $role->name }}" @selected(old('role') == $role->name)>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div> --}}

                    <div class="relative hidden">
                        <select id="role-select" name="role"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                            <option value="{{ $role->name }}" selected>{{ $role->name }}</option>
                        </select>
                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <div id="etudiant-fields" class="bg-white p-6 rounded-xl shadow-md hidden">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-user-graduate text-indigo-500"></i> Informations étudiant
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <x-input placeholder="Matricule" name="matricule" type="text" value="{{ old('matricule') }}" />
                    <x-input placeholder="Date de naissance" name="date_naissance" type="date"
                        value="{{ old('date_naissance') }}" />
                    <x-input placeholder="Lieu de naissance" name="lieu_naissance" type="text"
                        value="{{ old('lieu_naissance') }}" />
                    <div class="relative">
                        <select id="genre" name="genre"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                            <option value="">{{ '-- Type de genre --' }}</option>
                            <option value="masculin" @selected(old('genre') == 'masculin')>Masculin</option>
                            <option value="feminin" @selected(old('genre') == 'feminin')>Feminin</option>
                        </select>
                        @error('genre')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <h2 class="text-xl font-semibold text-gray-800 mt-6 mb-4 flex items-center gap-2">
                    <i class="fas fa-user-shield text-indigo-500"></i> Informations tuteur
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <x-input placeholder="Prénom du tuteur" name="prenom_tuteur" type="text"
                        value="{{ old('prenom_tuteur') }}" />
                    <x-input placeholder="Nom du tuteur" name="nom_tuteur" type="text"
                        value="{{ old('nom_tuteur') }}" />
                    <x-input placeholder="Téléphone du tuteur" name="telephone_tuteur" type="text"
                        value="{{ old('telephone_tuteur') }}" />
                    <x-input icon="fas fa-lock" placeholder="Mot de passe" name="password_tuteur" type="password" />
                    <x-input icon="fas fa-lock" placeholder="Confirmer le mot de passe" name="password_tuteur_confirmation" type="password"  />

                    <div class="relative">
                        <select id="relation" name="relation"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                            <option value="">{{ '-- Type de relation --' }}</option>
                            <option value="pere" @selected(old('relation') == 'pere')>Père</option>
                            <option value="mere" @selected(old('relation') == 'mere')>Mère</option>
                            <option value="autre" @selected(old('relation') == 'autre')>Autre</option>
                        </select>
                        @error('relation')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role-select');
            const etuFields = document.getElementById('etudiant-fields');

            function toggleSections(role) {
                etuFields.classList.toggle('hidden', role !== 'Etudiant');
            }

            toggleSections(roleSelect.value); // Init au chargement
            roleSelect.addEventListener('change', () => toggleSections(roleSelect.value));
        });
    </script>
</x-layout>
