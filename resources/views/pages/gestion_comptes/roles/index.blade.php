<x-layout>

    <x-slot:title>
        Gestion des roles & permissions
    </x-slot:title>

    <x-slot:header>
        Gestion des roles & permissions
    </x-slot:header>

    <div class="container mx-auto px-4 py-8">
        <!-- Header avec bouton d'ajout -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Les roles</h2>
                <p class="text-sm text-gray-500 mt-1">Gérez les roles des comptes</p>
            </div>
            <button onclick="openModal('addModal')"
                class="flex items-center cursor-pointer
                 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg shadow transition-colors duration-200">
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

        <!-- Tableau des roles -->
        <div class="bg-white rounded-lg shadow overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="rolesTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Role</th>
                            <th scope="col"
                                class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($roles as $role)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $role->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('roles.PageAffectPermissionsToRole', $role->id) }}"
                                            class="text-green-600 cursor-pointer hover:text-green-900 p-1.5 rounded-full hover:bg-green-50 transition-colors duration-200"
                                            title="Associer">
                                            <i class="fas fa-link mr-2"></i>
                                        </a>
                                        <button
                                            onclick="document.getElementById('editModal-{{ $role->id }}').value = {{ $role->id }}; openModal('editModal-{{ $role->id }}')"
                                            class="cursor-pointer text-blue-600 hover:text-blue-900 p-1.5 rounded-full hover:bg-blue-50 transition-colors duration-200"
                                            title="Modifier">
                                            <i class="fas fa-edit w-4 h-4"></i>
                                        </button>
                                        <button
                                            onclick="document.getElementById('deleteModal-{{ $role->id }}').value = {{ $role->id }}; openModal('deleteModal-{{ $role->id }}')"
                                            class="cursor-pointer text-red-600 hover:text-red-900 p-1.5 rounded-full hover:bg-red-50 transition-colors duration-200"
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

            <!-- Pagination -->
            @if ($roles->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $roles->links() }}
                </div>
            @endif
        </div>
    </div>


    <!-- Modal d'ajout -->
    <x-modal id="addModal" title="Ajouter un role" maxWidth="lg" type="default">
        <form id="addForm" action="{{ route('roles.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <x-input type="text" name="name" id="name" value="{{ old('name') }}"
                    placeholder="Ex: Admin" />
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

    <!-- Modals de modification -->

    @foreach ($roles as $role)
        <!-- Modal Édition -->
        <x-modal id="editModal-{{ $role->id }}" title="Modifier un role" maxWidth="lg" type="edit">
            <form id="editForm" method="POST" action="{{ route('roles.update', $role->id) }}">
                @csrf
                @method('PUT')

                {{-- Role --}}
                <div>
                    <x-input type="text" name="name" id="name" value="{{ $role->name }}" required
                        placeholder="Ex: Admin" />
                </div>

                {{-- Boutons d'action --}}
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('editModal-{{ $role->id }}')"
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



        <!-- Modal Suppression -->
        <x-modal id="deleteModal-{{ $role->id }}" title="Confirmer la suppression" type="delete" maxWidth="md">
            <p class="text-sm text-gray-500 mb-4">
                Êtes-vous sûr de vouloir supprimer ce role {{ $role->name }} ? Cette action est
                irréversible.
            </p>
            <form method="POST" action="{{ route('roles.destroy', $role->id) }}">
                @csrf @method('DELETE')
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('deleteModal-{{ $role->id }}')"
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

        function filterTable() {
            const input = document.getElementById("searchInput").value.toLowerCase();
            const rows = document.querySelectorAll("#rolesTable tbody tr");

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        }
    </script>

</x-layout>
