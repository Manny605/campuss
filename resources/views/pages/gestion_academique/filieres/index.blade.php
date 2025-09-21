<x-layout>

    <x-slot:title>
        Gestion des Filières - Admin
    </x-slot:title>

    <x-slot:header>
        Gestion des Filières
    </x-slot:header>

    <div class="container mx-auto px-4 py-8">
        <!-- Header avec bouton d'ajout -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Les Filières</h2>
                <p class="text-sm text-gray-500 mt-1">Gérez les filières de votre établissement</p>
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
                <input type="text" id="searchInput" placeholder="Rechercher..." oninput="filterTable()"
                    class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <!-- Tableau des années -->
        <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="filieresTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Code</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nom</th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($filieres as $filiere)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $filiere->code }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $filiere->nom }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('affectations.PageAffectNiveauxToFiliere', $filiere->id) }}"
                                            class="text-green-600 hover:text-green-900 p-1.5 rounded-full hover:bg-green-50 transition-colors duration-200"
                                            title="Associer">
                                            <i class="fas fa-link mr-2"></i>
                                        </a>
                                        <button
                                            onclick="document.getElementById('editModal-{{ $filiere->id }}').value = {{ $filiere->id }}; openModal('editModal-{{ $filiere->id }}')"
                                            class="text-blue-600 hover:text-blue-900 p-1.5 rounded-full hover:bg-blue-50 transition-colors duration-200"
                                            title="Modifier">
                                            <i class="fas fa-edit w-4 h-4"></i>
                                        </button>
                                        <button
                                            onclick="document.getElementById('delete_id').value = {{ $filiere->id }}; openModal('deleteModal-{{ $filiere->id }}')"
                                            class="text-red-600 hover:text-red-900 p-1.5 rounded-full hover:bg-red-50 transition-colors duration-200"
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
    <x-modal id="addModal" title="Ajouter une filiere" maxWidth="lg">
        <form id="addForm" action="{{ route('filieres.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="code" class="block text-sm font-medium text-gray-700">Code</label>
                <input type="text" name="code" id="code" value="{{ old('code') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" value="{{ old('nom') }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>


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

    @foreach ($filieres as $filiere)
        <!-- Modal Édition -->
        <x-modal id="editModal-{{ $filiere->id }}" title="Modifier une filiere" maxWidth="lg">
            <form id="editForm" method="POST" action="{{ route('filieres.update', $filiere) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="code" class="block text-sm font-medium text-gray-700">Code</label>
                    <input type="text" name="code" id="code" value="{{ $filiere->code }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input type="text" name="nom" id="nom" value="{{ $filiere->nom }}"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('editModal-{{ $filiere->id }}')"
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

    @foreach ($filieres as $filiere)
        <!-- Modal Suppression -->
        <x-modal id="deleteModal-{{ $filiere->id }}" title="Confirmer la suppression" maxWidth="md">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div
                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Supprimer la filiere
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Êtes-vous sûr de vouloir supprimer cette filiere ? Cette action est
                                irréversible.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <form id="deleteForm" method="POST"
                    action="{{ route('filieres.destroy', $filiere->id) }}/">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" id="delete_id">
                    <button type="submit"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                        Supprimer
                    </button>
                </form>
                <button type="button" onclick="closeModal('deleteModal-{{ $filiere->id }}')"
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
            const rows = document.querySelectorAll("#filieresTable tbody tr");

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        }

        // function toggleDropdown(id) {
        //     document.querySelectorAll('[id^="dropdownMenu-"]').forEach(el => {
        //         if (el.id !== id) el.classList.add('hidden');
        //     });
        //     const menu = document.getElementById(id);
        //     menu.classList.toggle('hidden');
        // }

        // function closeDropdown(id) {
        //     document.getElementById(id).classList.add('hidden');
        // }
        // // Close dropdown on click outside
        // document.addEventListener('click', function(event) {
        //     document.querySelectorAll('[id^="dropdownMenu-"]').forEach(menu => {
        //         if (!menu.contains(event.target) && !document.getElementById('dropdownMenuButton-' + menu.id
        //                 .split('-')[1]).contains(event.target)) {
        //             menu.classList.add('hidden');
        //         }
        //     });
        // });
    </script>

</x-layout>
