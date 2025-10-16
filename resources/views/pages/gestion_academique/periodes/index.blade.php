<x-layout>

    <x-slot:title>
        Gestion des periodes - Admin
    </x-slot:title>

    <x-slot:header>
        Gestion des periodes
    </x-slot:header>

    <div class="container mx-auto px-4 py-8">
        <!-- Header avec bouton d'ajout -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Les periodes</h2>
                <p class="text-sm text-gray-500 mt-1">Gérez les periodes de votre établissement</p>
            </div>
            <button onclick="openModal('addModal')"
                class="flex items-center cursor-pointer bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg shadow transition-colors duration-200">
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
                <input type="text" id="searchInput" placeholder="Rechercher..." oninput="filterTable()"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <!-- Tableau des années -->
        <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="periodesTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nom</th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($periodes as $periode)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $periode->nom }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <button
                                            onclick="document.getElementById('editModal-{{ $periode->id }}').value = {{ $periode->id }}; openModal('editModal-{{ $periode->id }}')"
                                            class="text-blue-600 cursor-pointer hover:text-blue-900 p-1.5 rounded-full hover:bg-blue-50 transition-colors duration-200"
                                            title="Modifier">
                                            <i class="fas fa-edit w-4 h-4"></i>
                                        </button>
                                        <button
                                            onclick="document.getElementById('deleteModal-{{ $periode->id }}').value = {{ $periode->id }}; openModal('deleteModal-{{ $periode->id }}')"
                                            class="text-red-600 cursor-pointer hover:text-red-900 p-1.5 rounded-full hover:bg-red-50 transition-colors duration-200"
                                            title="Supprimer">
                                            <i class="fas fa-trash w-4 h-4"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
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
    <x-modal id="addModal" title="Ajouter un periode" maxWidth="lg" type="default">
        <form id="addForm" action="{{ route('periodes.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <x-input type="text" name="nom" id="nom" value="{{ old('nom') }}" placeholder="Nom" />
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('addModal')"
                    class="px-4 py-2 border cursor-pointer border-gray-300 rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    Annuler
                </button>
                <button type="submit"
                    class="px-4 py-2 border cursor-pointer border-transparent rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    Enregistrer
                </button>
            </div>
        </form>
    </x-modal>

    @foreach ($periodes as $periode)
        <!-- Modal Édition -->
        <x-modal id="editModal-{{ $periode->id }}" title="Modifier une periode" maxWidth="lg" type="edit">
            <form id="editForm" method="POST" action="{{ route('periodes.update', $periode) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_id">

                <div class="mb-4">
                    <x-input type="text" name="nom" id="nom" value="{{ $periode->nom }}" placeholder="Nom" />
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('editModal-{{ $periode->id }}')"
                        class="px-4 py-2 border cursor-pointer border-gray-300 rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-4 py-2 border cursor-pointer border-transparent rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </x-modal>
    @endforeach

    @foreach ($periodes as $periode)
        <!-- Modal Suppression -->
        <x-modal id="deleteModal-{{ $periode->id }}" title="Confirmer la suppression" maxWidth="md" type="delete">
            <form id="deleteForm" method="POST" action="{{ route('periodes.destroy', $periode) }}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" id="delete_id">

                <p class="text-gray-700">Êtes-vous sûr de vouloir supprimer la periode
                    <span class="font-semibold">{{ $periode->nom }}</span> ?
                </p>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('deleteModal-{{ $periode->id }}')"
                        class="px-4 py-2 border cursor-pointer border-gray-300 rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-4 py-2 border cursor-pointer border-transparent rounded-lg shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                        Supprimer
                    </button>
                </div>
            </form>
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
            const rows = document.querySelectorAll("#periodesTable tbody tr");

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        }
    </script>

</x-layout>
