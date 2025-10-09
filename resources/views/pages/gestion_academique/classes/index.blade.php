<x-layout>
    <x-slot:title>
        Gestion Académique - Création de classes
    </x-slot:title>
    <x-slot:header>
        Gestion Académique - Création de classes
    </x-slot:header>

    <div class="p-6">
        <!-- Titre principal -->
        <h1 class="text-3xl font-bold mb-8 flex items-center gap-3 text-indigo-700">
            <i class="fas fa-layer-group"></i> Création de classes
        </h1>

    <div class="min-h-screen">
        <div class="container mx-auto px-4 py-8">

            <!-- Section Ajout -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Ajouter des matières</h2>
                        <div class="mt-2 flex items-center">
                            <span class="px-3 py-1 mx-2 bg-blue-100 text-blue-800 rounded-full font-medium">
                                ........
                            </span>
                            <span class="px-3 py-1 mx-2 bg-blue-100 text-blue-800 rounded-full font-medium">
                                ........
                            </span>
                        </div>
                    </div>
                    <a href=""
                        class="mt-4 md:mt-0 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Retour
                    </a>
                </div>

                <!-- Formulaire Ajout -->
                <div class="border-t border-gray-200 pt-6">
                    <form method="POST" action="">
                        @csrf
                        <input type="hidden" name="filiere_id" value="........">
                        <input type="hidden" name="periode_id" value="........">

                        <!-- En-têtes -->
                        <div class="hidden md:grid grid-cols-12 gap-4 mb-4 px-2 text-gray-600 font-medium">
                            <div class="col-span-2">Code</div>
                            <div class="col-span-3">Nom matière</div>
                            <div class="col-span-2">Coefficient</div>
                            <div class="col-span-1">Actions</div>
                        </div>

                        <!-- Lignes dynamiques -->
                        <div id="matiere-list" class="space-y-4">
                            <div class="matiere-row bg-gray-50 rounded-lg border border-gray-200 p-4">
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1 md:hidden">Code</label>
                                        <input type="text" name="matieres[0][code]" placeholder="Code" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div class="md:col-span-3">
                                        <label class="block text-sm font-medium text-gray-700 mb-1 md:hidden">Nom matière</label>
                                        <input type="text" name="matieres[0][nom]" placeholder="Nom matière" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1 md:hidden">Coefficient</label>
                                        <input type="number" name="matieres[0][coefficient]" placeholder="Coefficient" step="0.1"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div class="md:col-span-1 flex items-center justify-end md:justify-center">
                                        <button type="button" onclick="removeRow(this)"
                                            class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-100 transition">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons -->
                        <div class="mt-8 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                            <button type="button" onclick="addMatiereRow()"
                                class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition flex items-center justify-center">
                                <i class="fas fa-plus mr-2"></i> Ajouter une matière
                            </button>

                            <button type="submit"
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition flex items-center justify-center">
                                <i class="fas fa-save mr-2"></i> Enregistrer toutes les matières
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Section Liste -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Matières associées</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Code</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Matière</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Coefficient</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            {{-- @forelse ($matieres_associees as $matiere)
                                <tr>
                                    <td class="px-6 py-4">{{ $matiere->code }}</td>
                                    <td class="px-6 py-4">{{ $matiere->nom }}</td>
                                    <td class="px-6 py-4">{{ $matiere->coefficient }}</td>
                                    <td class="px-6 py-4 flex space-x-3">
                                        <button onclick="openModal('editModal-{{ $matiere->id }}')"
                                            class="text-indigo-600 hover:text-indigo-900">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openModal('deleteModal-{{ $matiere->id }}')"
                                            class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty --}}
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        Aucune matière associée à cette filière.
                                    </td>
                                </tr>
                            {{-- @endforelse --}}
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Section Modals -->
            {{-- @foreach ($matieres_associees as $matiere)
                <!-- Modal Édition -->
                <x-modal id="editModal-{{ $matiere->id }}" title="Modifier une matière" maxWidth="lg">
                    <form method="POST" action="{{ route('matieres.update', $matiere) }}">
                        @csrf @method('PUT')
                        <x-matiere-form edit :data="$matiere" />
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" onclick="closeModal('editModal-{{ $matiere->id }}')"
                                class="px-4 py-2 border rounded-lg text-gray-700 bg-white hover:bg-gray-50">Annuler</button>
                            <button type="submit"
                                class="px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700">Mettre à jour</button>
                        </div>
                    </form>
                </x-modal>

                <!-- Modal Suppression -->
                <x-modal id="deleteModal-{{ $matiere->id }}" title="Confirmer la suppression" maxWidth="md">
                    <p class="text-sm text-gray-500 mb-4">Êtes-vous sûr de vouloir supprimer cette matière ?</p>
                    <form method="POST" action="{{ route('matieres.destroy', $matiere->id) }}">
                        @csrf @method('DELETE')
                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="closeModal('deleteModal-{{ $matiere->id }}')"
                                class="px-4 py-2 border rounded-lg bg-white text-gray-700 hover:bg-gray-50">Annuler</button>
                            <button type="submit"
                                class="px-4 py-2 rounded-lg text-white bg-red-600 hover:bg-red-700">Supprimer</button>
                        </div>
                    </form>
                </x-modal>
            @endforeach --}}
        </div>
    </div>

    <!-- Scripts -->
    <script>
        let index = 1;

        function addMatiereRow() {
            const container = document.getElementById('matiere-list');
            const row = document.createElement('div');
            row.className = 'matiere-row bg-gray-50 rounded-lg border border-gray-200 p-4';
            row.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-2">
                        <input type="text" name="matieres[${index}][code]" placeholder="Code" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-3">
                        <input type="text" name="matieres[${index}][nom]" placeholder="Nom matière" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-2">
                        <input type="number" name="matieres[${index}][coefficient]" placeholder="Coefficient" step="0.1"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-1 flex items-center justify-end md:justify-center">
                        <button type="button" onclick="removeRow(this)"
                            class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-100 transition">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>`;
            container.appendChild(row);
            index++;
        }

        function removeRow(button) {
            button.closest('.matiere-row').remove();
        }

        function openModal(id) {
            document.getElementById(id).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
</x-layout>
