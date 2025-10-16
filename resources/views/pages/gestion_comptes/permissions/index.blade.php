<x-layout>

    <x-slot:title>
        Gestion des perimissions
    </x-slot>

    <x-slot:header>
        Gestion des perimissions
    </x-slot>

    <div class="container mx-auto px-4 py-8">
        <!-- Header avec bouton d'ajout -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Gestion des permissions</h2>
                <p class="text-sm text-gray-500 mt-1">Gérez les permissions</p>
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
                <table class="min-w-full divide-y divide-gray-200" id="permissionsTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Permission
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($permissions as $permission)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $permission->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <button
                                            onclick="document.getElementById('editModal-{{ $permission->id }}').value = {{ $permission->id }}; openModal('editModal-{{ $permission->id }}')"
                                            class="text-blue-600 cursor-pointer hover:text-blue-900 p-1.5 rounded-full hover:bg-blue-50 transition-colors duration-200"
                                            title="Modifier">
                                            <i class="fas fa-edit w-4 h-4"></i>
                                        </button>
                                        <button
                                            onclick="document.getElementById('deleteModal-{{ $permission->id }}').value = {{ $permission->id }}; openModal('deleteModal-{{ $permission->id }}')"
                                            class="text-red-600 cursor-pointer hover:text-red-900 p-1.5 rounded-full hover:bg-red-50 transition-colors duration-200"
                                            title="Supprimer">
                                            <i class="fas fa-trash w-4 h-4"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Aucune permission trouvée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($permissions->hasPages())
                <div class="bg-gray-100 px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $permissions->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Modals -->

    <!-- Modal Ajout -->
    <x-modal id="addModal" title="Ajouter une permission" maxWidth="lg" type="default">
        <form id="addForm" action="{{ route('permissions.store') }}" method="POST" class="space-y-6">
            @csrf
            {{-- permission --}}
            <div>
                <x-input type="text" name="name" id="name" required placeholder="Ex: annes.manage" />
            </div>

            {{-- Boutons d'action --}}
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


    @foreach ($permissions as $permission)
        <!-- Modal Édition -->
        <x-modal id="editModal-{{ $permission->id }}" title="Modifier la permission" maxWidth="lg" type="edit">
            <form id="editForm" method="POST" action="{{ route('permissions.update', $permission->id) }}">
                @csrf
                @method('PUT')
                
                {{-- permission --}}
                <div>
                    <x-input type="text" name="name" id="name" value="{{ $permission->name }}" required placeholder="Ex: annes.manage" />
                </div>

                {{-- Boutons d'action --}}
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('editModal-{{ $permission->id }}')"
                        class="px-4 py-2 cursor-pointer border border-gray-300 rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Annuler
                    </button>
                    <button type="submit"
                        class="px-4 py-2 cursor-pointer border border-transparent rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </x-modal>
    @endforeach

    @foreach ($permissions as $permission)
        <!-- Modal Suppression -->
        <x-modal id="deleteModal-{{ $permission->id }}" title="Confirmer la suppression" maxWidth="md" type="delete">
            <p class="text-sm text-gray-500 ">Êtes-vous sûr de vouloir supprimer cette permission ? Cette action est irréversible.</p>
            <form method="POST" action="{{ route('permissions.destroy', $permission->id) }}" class="mt-4">
                @csrf @method('DELETE')
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('deleteModal-{{ $permission->id }}')"
                        class="px-4 py-2 border cursor-pointer border-gray-400 rounded-lg bg-white text-gray-700 hover:bg-gray-50">Annuler</button>
                    <button type="submit"
                        class="px-4 py-2 rounded-lg cursor-pointer text-white bg-red-600 hover:bg-red-700">Supprimer</button>
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
            const rows = document.querySelectorAll("#permissionsTable tbody tr");

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        }
    </script>

</x-layout>
