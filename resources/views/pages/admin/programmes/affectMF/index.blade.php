<x-layout>
    <x-slot:title>
        Configuration des Filières - Admin
    </x-slot:title>

    <x-slot:header>
        <div class="flex items-center">
            <i class="fas fa-cogs text-blue-500 mr-2"></i>
            Configuration des Filières
        </div>
    </x-slot:header>

    <div class="container mx-auto px-4 py-8">
        <!-- En-tête -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-project-diagram text-blue-500 mr-3"></i>
                    Lier des Niveaux & Matières à une Filière
                </h2>
                <p class="text-gray-600 mt-2">Configuration pour la filière : <strong>{{ $filiere->nom }}</strong></p>
            </div>
        </div>

        <!-- Carte de configuration -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <form method="POST" action="{{ route('programmes.updateAffectToFiliere', $filiere->id) }}">
                @csrf
                @method('PUT')

                <!-- Titre de la carte -->
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4 border-b">
                    <div class="flex items-center">
                        <i class="fas fa-sliders-h text-blue-500 mr-3 text-xl"></i>
                        <h3 class="text-lg font-semibold text-gray-800">Configurer les associations</h3>
                    </div>
                </div>

                <div class="p-6 space-y-10">
                    <!-- Filière sélectionnée -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-university mr-2 text-blue-500"></i>
                            Filière sélectionnée
                        </label>
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <i class="fas fa-tag text-gray-400 mr-3"></i>
                            <span class="font-medium text-gray-800">{{ $filiere->nom }}</span>
                            <span class="ml-auto bg-blue-100 text-blue-800 text-xs px-2.5 py-0.5 rounded-full">
                                {{ $filiere->matieres->count() }} matières / {{ $filiereNiveaux ? count($filiereNiveaux) : 0 }} niveaux
                            </span>
                        </div>
                    </div>

                    <!-- Section Niveaux -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-layer-group mr-2 text-blue-500"></i>
                            Niveaux disponibles
                        </label>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($niveaux as $niveau)
                                <div class="relative">
                                    <input type="checkbox" name="niveaux[]" value="{{ $niveau->id }}"
                                           id="niveau_{{ $niveau->id }}" 
                                           class="hidden peer"
                                           {{ in_array($niveau->id, $filiereNiveaux) ? 'checked' : '' }}>
                                    <label for="niveau_{{ $niveau->id }}" 
                                           class="inline-flex items-center justify-between w-full p-4 border rounded-lg cursor-pointer 
                                           peer-checked:border-blue-500 peer-checked:bg-blue-50 
                                           hover:bg-gray-50 transition-colors">
                                        <div class="flex items-center">
                                            <i class="fas fa-school text-blue-400 mr-3"></i>
                                            <div class="font-medium text-gray-800">{{ $niveau->nom }}</div>
                                        </div>
                                        <div class="text-xs px-2 py-1 rounded-full 
                                            {{ in_array($niveau->id, $filiereNiveaux) ? 
                                               'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ in_array($niveau->id, $filiereNiveaux) ? 'Associé' : 'Non associé' }}
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Séparation visuelle -->
                    <hr class="my-6 border-gray-200">

                    <!-- Section Matières -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-book mr-2 text-blue-500"></i>
                            Matières disponibles
                        </label>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($matieres as $matiere)
                                <div class="relative">
                                    <input type="checkbox" name="matieres[]" value="{{ $matiere->id }}"
                                           id="matiere_{{ $matiere->id }}" 
                                           class="hidden peer"
                                           {{ in_array($matiere->id, $filiereMatieres) ? 'checked' : '' }}>
                                    <label for="matiere_{{ $matiere->id }}" 
                                           class="inline-flex items-center justify-between w-full p-4 border rounded-lg cursor-pointer 
                                           peer-checked:border-blue-500 peer-checked:bg-blue-50 
                                           hover:bg-gray-50 transition-colors">
                                        <div class="flex items-center">
                                            <i class="fas fa-book text-blue-400 mr-3"></i>
                                            <div>
                                                <div class="font-medium text-gray-800">{{ $matiere->nom }}</div>
                                                <div class="text-sm text-gray-500">{{ $matiere->code }}</div>
                                            </div>
                                        </div>
                                        <div class="text-xs px-2 py-1 rounded-full 
                                            {{ in_array($matiere->id, $filiereMatieres) ? 
                                               'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ in_array($matiere->id, $filiereMatieres) ? 'Associée' : 'Non associée' }}
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="pt-6 border-t flex justify-end">
                        <button type="submit" 
                                class="flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-md transition-all
                                       hover:shadow-lg transform hover:-translate-y-0.5">
                            <i class="fas fa-save mr-2"></i>
                            Enregistrer
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Informations -->
        <div class="mt-6 text-center text-sm text-gray-500">
            <i class="fas fa-info-circle mr-1"></i>
            Cochez ou décochez les niveaux et matières à associer, puis cliquez sur "Enregistrer".
        </div>
    </div>

    <!-- Styles personnalisés -->
    <style>
        input:checked + label {
            border-color: #3B82F6;
            background-color: #EFF6FF;
        }
        input:checked + label div:last-child {
            background-color: #DBEAFE;
            color: #1E40AF;
        }
    </style>
</x-layout>
