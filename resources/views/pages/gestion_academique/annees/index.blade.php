<x-layout>

    <x-slot:title>
        Gestion des Années Académiques - Admin
    </x-slot>

    <x-slot:header>
        Gestion des Années Académiques
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <!-- Header avec bouton d'ajout -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Années Académiques</h2>
                <p class="text-sm text-gray-500 mt-1">Gérez les années académiques de votre établissement</p>
            </div>
            <button onclick="openModal('addModal')"
                class="flex items-center bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg shadow transition-colors duration-200">
                <i class="fas fa-plus mr-2"></i>
                <span>Ajouter</span>
            </button>
        </div>

        <!-- Barre de recherche -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" id="searchInput" placeholder="Rechercher une année..." oninput="filterTable()"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <!-- Tableau des années -->
        <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="anneesTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Code</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date Debut</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date Fin</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Statut</th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($annees as $annee)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">
                                    {{ $annee->code }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">
                                    {{ \Carbon\Carbon::parse($annee->date_debut)->format('d-m-Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">
                                    {{ \Carbon\Carbon::parse($annee->date_fin)->format('d-m-Y') }}
                                </td>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if ($annee->active)
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i> Active
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                            <i class="fas fa-times-circle mr-1"></i> Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <button
                                            onclick="document.getElementById('editModal-{{ $annee->id }}').value = {{ $annee->id }}; openModal('editModal-{{ $annee->id }}')"
                                            class="text-blue-600 hover:text-blue-900 p-1.5 rounded-full hover:bg-blue-50 transition-colors duration-200"
                                            title="Modifier cette année">
                                            <i class="fas fa-edit w-4 h-4"></i>
                                        </button>
                                        <button
                                            onclick="document.getElementById('delete_id').value = {{ $annee->id }}; openModal('deleteModal-{{ $annee->id }}')"
                                            class="text-red-600 hover:text-red-900 p-1.5 rounded-full hover:bg-red-50 transition-colors duration-200"
                                            title="Supprimer cette année">
                                            <i class="fas fa-trash w-4 h-4"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Aucune année académique trouvée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- <!-- Pagination -->
            @if ($annees->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $annees->links() }}
                </div>
            @endif --}}
        </div>
    </div>

    <!-- Modals -->
    <!-- Modal Ajout -->
    <x-modal id="addModal" title="Ajouter une année académique" maxWidth="lg">
        <form id="addForm" action="{{ route('annees.store') }}" method="POST" class="space-y-6">
            @csrf
            {{-- Code de l'année --}}
            <div>
                <label for="code" class="block text-sm font-medium text-gray-700">Code</label>
                <input type="text" name="code" id="code" required
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="Ex: 2025-2026">
            </div>

            {{-- Date de début --}}
            <div>
                <label for="date_debut" class="block text-sm font-medium text-gray-700">Date de début</label>
                <input type="date" name="date_debut" id="date_debut" required
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            {{-- Date de fin --}}
            <div>
                <label for="date_fin" class="block text-sm font-medium text-gray-700">Date de fin</label>
                <input type="date" name="date_fin" id="date_fin" required
                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            {{-- Statut (Active / Inactive) --}}
            <div class="flex items-center">
                <input type="checkbox" name="active" id="active" value="1"
                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label for="active" class="ml-2 block text-sm text-gray-700">Active</label>
            </div>

            {{-- Boutons d'action --}}
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('addModal')"
                    class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    Annuler
                </button>
                <button type="submit"
                    class="px-4 py-2 border border-transparent rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    Enregistrer
                </button>
            </div>
        </form>
    </x-modal>


    @foreach ($annees as $annee)
        <!-- Modal Édition -->
        <x-modal id="editModal-{{ $annee->id }}" title="Modifier une année académique" maxWidth="lg">
            <form id="editForm" method="POST" action="{{ route('annees.update', $annee) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{ $annee->id }}">
                
                {{-- Code de l'année --}}
                <div>
                    <label for="code-{{ $annee->id }}" class="block text-sm font-medium text-gray-700">Code</label>
                    <input type="text" name="code" id="code-{{ $annee->id }}" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        placeholder="Ex: 2025-2026" value="{{ old('code', strtoupper($annee->code)) }}">
                </div>

                {{-- Date de début --}}
                <div>
                    <label for="date_debut-{{ $annee->id }}" class="block text-sm font-medium text-gray-700">Date de début</label>
                    <input type="date" name="date_debut" id="date_debut-{{ $annee->id }}" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        value="{{ old('date_debut', $annee->date_debut) }}">
                </div>

                {{-- Date de fin --}}
                <div>
                    <label for="date_fin-{{ $annee->id }}" class="block text-sm font-medium text-gray-700">Date de fin</label>
                    <input type="date" name="date_fin" id="date_fin-{{ $annee->id }}" required
                        class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                        value="{{ old('date_fin', $annee->date_fin) }}">
                </div>

                {{-- Statut (Active / Inactive) --}}
                <input type="hidden" name="active" value="0">
                <div class="flex items-center">
                    <input type="checkbox" name="active" id="active-{{ $annee->id }}" value="1"
                        class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                        {{ old('active', $annee->active) ? 'checked' : '' }}>
                    <label for="active-{{ $annee->id }}" class="ml-2 block text-sm text-gray-700">Active</label>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('editModal-{{ $annee->id }}')"
                        class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-4 py-2 border border-transparent rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </x-modal>
    @endforeach

    @foreach ($annees as $annee)
        <!-- Modal Suppression -->
        <x-modal id="deleteModal-{{ $annee->id }}" title="Confirmer la suppression" maxWidth="md">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div
                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Supprimer l'année académique
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Êtes-vous sûr de vouloir supprimer cette année académique ? Cette action est
                                irréversible.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <form id="deleteForm" method="POST" action="{{ route('annees.destroy', $annee->id) }}/">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" id="delete_id">
                    <button type="submit"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                        Supprimer
                    </button>
                </form>
                <button type="button" onclick="closeModal('deleteModal-{{ $annee->id }}')"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                    Annuler
                </button>
            </div>
        </x-modal>
    @endforeach

    <!-- Scripts simplifiés -->
    <script>
        // Fonction pour ouvrir une modal
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        // Fonction pour fermer une modal
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Fonction de filtrage du tableau
        function filterTable() {
            const input = document.getElementById("searchInput").value.toLowerCase();
            const rows = document.querySelectorAll("#anneesTable tbody tr");

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        }
    </script>

</x-layout>
