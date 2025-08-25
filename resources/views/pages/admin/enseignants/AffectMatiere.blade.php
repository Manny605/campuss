<x-layout>

    <x-slot:title>
        Association Matières - Admin
    </x-slot:title>

    <x-slot:header>
        Associer des matières à l’enseignant
    </x-slot:header>

    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-project-diagram text-blue-500 mr-3"></i>
                    {{ $enseignant->prenom }} {{ $enseignant->nom }}
                </h1>
                {{-- <div class="flex items-center gap-4 mt-2 text-sm text-gray-600">
                    <span>
                        <i class="fas fa-book-open mr-1 text-green-500"></i>
                        {{ $filiere->matieres->count() }} matière{{ $filiere->matieres->count() > 1 ? 's' : '' }}
                    </span>
                </div> --}}
            </div>
            <div class="flex gap-2">
                <a href="{{ route('programmes.indexFiliere') }}"
                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors text-sm font-medium">
                    <i class="fas fa-arrow-left mr-2"></i> Retour
                </a>
                {{-- <a href="{{ route('programmes.createMatieresToFiliere', $filiere->id) }}"
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors text-sm font-medium">
                    <i class="fas fa-link mr-2"></i> Associer des matières
                </a> --}}
            </div>
        </div>

        <!-- Main Configuration Card -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
            <form method="POST" action="">
                @csrf
                @method('PUT')

                <!-- Card Header -->
                <div class="bg-blue-50 px-6 py-4 border-b flex items-center">
                    <i class="fas fa-cogs text-blue-500 mr-3"></i>
                    <h2 class="text-lg font-semibold">Configuration des associations</h2>
                </div>

                <!-- Card Body -->
                <div class="p-6 space-y-8">

                    <!-- Niveaux Section -->
                    <div class="space-y-4">
                        <h3 class="text-md font-medium text-gray-700 flex items-center">
                            <i class="fas fa-layer-group text-blue-500 mr-2"></i>
                            Sélection des filières
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($classes as $classe)
                                <div class="relative">
                                    {{-- Checkbox caché --}}
                                    <input type="checkbox" name="classes[]" value="{{ $classe->id }}"
                                        id="classe_{{ $classe->id }}" class="hidden peer"
                                        @checked($enseignant->classes->contains($classe->id))>

                                    {{-- Label stylisé qui sert de bouton --}}
                                    <label for="classe_{{ $classe->id }}"
                                        class="flex flex-col gap-2 p-4 border rounded-lg cursor-pointer transition hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50">

                                        {{-- Filière --}}
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-graduation-cap text-blue-500"></i>
                                            <span class="font-medium">{{ $classe->filiereNiveau->filiere->nom }}</span>
                                        </div>

                                        {{-- Niveau --}}
                                        <div class="flex items-center gap-2">
                                            <i class="fas fa-layer-group text-gray-400"></i>
                                            <span class="text-sm">{{ $classe->filiereNiveau->niveau->nom }}</span>
                                        </div>

                                        {{-- Badge d’association --}}
                                        <span
                                            class="text-xs px-2 py-1 rounded-full self-start
                    {{ $enseignant->classes->contains($classe->id)
                        ? 'bg-blue-100 text-blue-800'
                        : 'bg-gray-100 text-gray-800' }}">
                                            {{ $enseignant->classes->contains($classe->id) ? 'Associé' : 'Non associé' }}
                                        </span>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                    </div>

                    <!-- Form Actions -->
                    <div class="pt-6 border-t flex justify-end">
                        <button type="submit"
                            class="cursor-pointer border border-blue-500 bg-blue-50 text-blue-700 hover:bg-blue-100 px-4 py-2 rounded-lg flex items-center">
                            <i class="fas fa-save mr-2"></i>
                            Enregistrer les modifications
                        </button>
                    </div>
                </div>
            </form>

            <!-- Filieres associees -->
            {{-- <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Filières associées</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Filière
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Niveau
                                </th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($classes->isEmpty())
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">
                                        Aucune filière n'est associée à cet enseignant.
                                    </td>
                                </tr>
                            @else
                                @foreach ($classes as $classe)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <i class="fas fa-graduation-cap text-blue-500 mr-3"></i>
                                                <span
                                                    class="text-sm font-medium text-gray-900">{{ $classe->filiereNiveau->filiere->nom }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <i class="fas fa-calendar-alt text-blue-500 mr-3"></i>
                                                <span
                                                    class="text-sm font-medium text-gray-900">{{ $classe->filiereNiveau->niveau->nom }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="" class="btn btn-sm btn-blue">
                                                <i class="fas fa-link mr-2"></i> Associer des matières
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div> --}}

        </div>


    </div>

    <!-- Styles -->
    <style>
        .btn {
            @apply inline-flex items-center px-4 py-2 border rounded-md font-medium text-sm transition-colors;
        }

        .btn-sm {
            @apply px-3 py-1 text-xs;
        }

        .btn-blue {
            @apply bg-blue-600 text-white hover:bg-blue-700 border-blue-600;
        }

        .btn-green {
            @apply bg-green-600 text-white hover:bg-green-700 border-green-600;
        }

        .btn-gray {
            @apply bg-gray-100 text-gray-700 hover:bg-gray-200 border-gray-300;
        }

        input:checked+label {
            @apply border-blue-500 bg-blue-50;
        }
    </style>

</x-layout>
