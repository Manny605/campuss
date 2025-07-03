<x-layout>
    <x-slot:title>
        Affectation des niveaux aux filières - Admin
    </x-slot:title>

    <x-slot:header>
        <div class="flex items-center">
            <i class="fas fa-link text-blue-500 mr-2"></i>
            Affectation des niveaux aux filières
        </div>
    </x-slot:header>

    <div class="container mx-auto px-4 py-8">
        <!-- Header avec bouton d'ajout -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-project-diagram text-blue-500 mr-3"></i>
                    Lier des niveaux à la filière
                </h2>
                <p class="text-gray-600 mt-2">Sélectionnez les niveaux à associer à une filière</p>
            </div>
        </div>

        <!-- Carte principale -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <form method="POST" action="">
                @csrf
                @method('PUT')

                <!-- En-tête de la carte -->
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4 border-b">
                    <div class="flex items-center">
                        <i class="fas fa-graduation-cap text-blue-500 mr-3 text-xl"></i>
                        <h3 class="text-lg font-semibold text-gray-800">Configuration des niveaux</h3>
                    </div>
                </div>

                <!-- Corps de la carte -->
                <div class="p-6">
                    <!-- Filière (lecture seule) -->
                    <div class="mb-8">
                        <label class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <i class="fas fa-university mr-2 text-blue-500"></i>
                            Filière sélectionnée
                        </label>
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-200">
                            <i class="fas fa-tag text-gray-400 mr-3"></i>
                            <span class="font-medium text-gray-800">{{ $filiere->nom }}</span>
                            <span class="ml-auto bg-blue-100 text-blue-800 text-xs px-2.5 py-0.5 rounded-full">
                                {{ $filiere->niveaux->count() }} niveaux associées
                            </span>
                        </div>
                    </div>

                    <!-- Liste des niveaux -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-book-open mr-2 text-blue-500"></i>
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
                                            <i class="fas fa-book text-blue-400 mr-3"></i>
                                            <div>
                                                <div class="font-medium text-gray-800">{{ $niveau->nom }}</div>
                                            </div>
                                        </div>
                                        <div class="text-xs px-2 py-1 rounded-full 
                                            {{ in_array($niveau->id, $filiereNiveaux) ? 
                                               'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ in_array($niveau->id, $filiereNiveaux) ? 'Associée' : 'Non associée' }}
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Bouton de soumission -->
                    <div class="mt-8 pt-6 border-t flex justify-end">
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

        <!-- Information supplémentaire -->
        <div class="mt-6 text-center text-sm text-gray-500">
            <i class="fas fa-info-circle mr-1"></i>
            Sélectionnez ou désélectionnez les matières puis cliquez sur "Enregistrer"
        </div>
    </div>

    <!-- Style personnalisé -->
    <style>
        input:checked + label 
        {
            border-color: #3B82F6;
            background-color: #EFF6FF;
        }
        input:checked + label div:last-child 
        {
            background-color: #DBEAFE;
            color: #1E40AF;
        }
    </style>
</x-layout>