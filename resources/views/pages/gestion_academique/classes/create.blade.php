<x-layout>
    <x-slot:title>
        Gestion Académique - Création d'une classe
    </x-slot:title>
    <x-slot:header>
        Gestion Académique - Création d'une classe
    </x-slot:header>

    <div class="p-6">
        <!-- Titre principal -->
        <h1 class="text-3xl font-bold mb-8 flex items-center gap-3 text-indigo-700">
            <i class="fas fa-user-plus"></i> Création d'une classe
        </h1>

        <form action="{{ route('classes.store') }}" method="POST" class="space-y-8">
            @csrf

            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-id-card text-indigo-500"></i> Informations personnelles
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <x-input icon="fas fa-id-badge" placeholder="Nom de la classe" name="nom" type="text"
                        value="{{ old('nom') }}" required />

                    <div class="relative">
                        <select id="filiere_id" name="filiere_id"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                            <option value="">{{ '-- Selectionnez une filiere --' }}</option>
                            @foreach ($filieres as $filiere)
                                <option value="{{ $filiere->id }}" @selected(old('filiere') == $filiere->nom)>
                                    {{ $filiere->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative">
                        <select id="niveau_id" name="niveau_id"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                            <option value="">{{ '-- Selectionnez un niveau --' }}</option>
                            @foreach ($niveaux as $niveau)
                                <option value="{{ $niveau->id }}" @selected(old('niveau') == $niveau->nom)>
                                    {{ $niveau->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="relative">
                        <select id="annee_academique_id" name="annee_academique_id"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg 
                                   focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                            <option value="">{{ '-- Selectionnez une année académique --' }}</option>
                            @foreach ($anneesAcademiques as $anneeAcademique)
                                <option value="{{ $anneeAcademique->id }}"
                                    @selected(old('annee_academique') == $anneeAcademique->nom)>
                                    {{ $anneeAcademique->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <x-input icon="fas fa-id-badge" placeholder="Capacite" name="capacite" type="text"
                        value="{{ old('capacite') }}" required />


                </div>


            </div>

            <div class="flex gap-4 mt-8">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-8 py-3 bg-indigo-600 hover:bg-indigo-700 
                           text-white font-semibold rounded-xl shadow-md transition">
                    <i class="fas fa-check"></i> Enregistrer
                </button>

                <a href="{{ route('classes.index') }}"
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
