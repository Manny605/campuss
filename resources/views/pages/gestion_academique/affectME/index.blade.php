<x-layout>

    <x-slot:title>
        Gestion des Années Académiques - Admin
    </x-slot>

    <x-slot:header>
        Gestion des Années Académiques
    </x-slot>
        
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800">Années Académiques</h2>
                <button onclick="openModal('addModal')" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white px-6 py-3 rounded-lg shadow-md transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    <i class="fas fa-plus mr-2"></i>Ajouter
                </button>
            </div>

            <!-- Table des Programmes -->
            <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 mb-6 transition-all duration-300 hover:shadow-xl">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <div class="relative w-full sm:w-64">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" id="searchInput" placeholder="Rechercher..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300">
                    </div>
                </div>

                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hover:text-gray-700 transition-colors duration-200">
                                    <div class="flex items-center">
                                        <span>#</span>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hover:text-gray-700 transition-colors duration-200">
                                    <div class="flex items-center">
                                        <span>Libelle</span>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hover:text-gray-700 transition-colors duration-200">
                                    <div class="flex items-center">
                                        <span>Date Debut</span>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hover:text-gray-700 transition-colors duration-200">
                                    <div class="flex items-center">
                                        <span>Date Fin</span>
                                    </div>
                                </th>
                                <th scope="col" class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($annees as $annee)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $loop->iteration }}</div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $annee->libelle }}</div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $annee->date_debut }}</div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $annee->date_fin }}</div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-3">
                                            <button onclick="openModal('editModal', {{ $annee }})" class="text-blue-600 hover:text-blue-900 transition-colors duration-200" title="Modifier">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button onclick="openModal('deleteModal', {{ $annee->id }})" class="text-red-600 hover:text-red-900 transition-colors duration-200" title="Supprimer">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="addModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-bold mb-4">Ajouter une Année Académique</h3>
            <form action="{{ route('admin.programmes.storeAnnee') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="libelle" class="block text-sm font-medium text-gray-700">Libelle</label>
                    <input type="text" name="libelle" id="libelle" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="date_debut" class="block text-sm font-medium text-gray-700">Date Debut</label>
                    <input type="date" name="date_debut" id="date_debut" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="date_fin" class="block text-sm font-medium text-gray-700">Date Fin</label>
                    <input type="date" name="date_fin" id="date_fin" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal('addModal')" class="px-4 py-2 bg-gray-300 rounded-lg">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Ajouter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-bold mb-4">Modifier une Année Académique</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="edit_libelle" class="block text-sm font-medium text-gray-700">Libelle</label>
                    <input type="text" name="libelle" id="edit_libelle" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="edit_date_debut" class="block text-sm font-medium text-gray-700">Date Debut</label>
                    <input type="date" name="date_debut" id="edit_date_debut" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label for="edit_date_fin" class="block text-sm font-medium text-gray-700">Date Fin</label>
                    <input type="date" name="date_fin" id="edit_date_fin" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal('editModal')" class="px-4 py-2 bg-gray-300 rounded-lg">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Modifier</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-bold mb-4">Supprimer une Année Académique</h3>
            <p class="mb-4">Êtes-vous sûr de vouloir supprimer cette année académique ?</p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal('deleteModal')" class="px-4 py-2 bg-gray-300 rounded-lg">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">Supprimer</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(modalId, data = null) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('hidden');

            if (modalId === 'editModal' && data) {
                document.getElementById('editForm').action = `/programmes/annees/${data.id}`;
                document.getElementById('edit_libelle').value = data.libelle;
                document.getElementById('edit_date_debut').value = data.date_debut;
                document.getElementById('edit_date_fin').value = data.date_fin;
            }

            if (modalId === 'deleteModal' && data) {
                document.getElementById('deleteForm').action = `/programmes/annees/${data}`;
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('hidden');
        }
    </script>

</x-layout>