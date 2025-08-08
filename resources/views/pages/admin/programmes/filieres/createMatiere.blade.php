<x-layout>

    <x-slot:title>
        Gestion des Filières - Admin
    </x-slot:title>

    <x-slot:header>
        Configuration des filières
    </x-slot:header>

    <div class="min-h-screen">

        <div class="container mx-auto px-4 py-8">
            <!-- Titre principal -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Ajouter les matières</h2>
                        <div class="mt-2 flex items-center">
                            <span class="px-3 py-1 mx-2 bg-blue-100 text-blue-800 rounded-full font-medium">{{ $filiere->nom }}</span>
                            <span class="px-3 py-1 mx-2 bg-blue-100 text-blue-800 rounded-full font-medium">{{ $semestre->code }}</span>
                        </div>
                    </div>
                    <a href="{{ route('programmes.indexNiveauxFiliere', $filiere->id) }}"
                        class="mt-4 md:mt-0 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Retour
                    </a>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <form method="POST" action="{{ route('programmes.AffectMatieresToFiliere') }}">
                        @csrf
                        <!-- Entêtes des colonnes -->
                        <div class="hidden md:grid grid-cols-12 gap-4 mb-4 px-2 text-gray-600 font-medium">
                            <div class="col-span-2">Code</div>
                            <div class="col-span-3">Nom matière</div>
                            <div class="col-span-2">Coefficient</div>
                            <div class="col-span-1">Actions</div>
                        </div>

                        <!-- Liste des matières -->
                        <div id="matiere-list" class="space-y-4">
                            <!-- Ligne de matière -->
                            <div class="matiere-row bg-gray-50 rounded-lg border border-gray-200 p-4">
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                    <input type="text" name="filiere_id" value="{{ $filiere->id }}" hidden>
                                    <input type="text" name="semestre_id" value="{{ $semestre->id }}" hidden>
                                    <div class="md:col-span-2">
                                        <label
                                            class="block text-sm font-medium text-gray-700 mb-1 md:hidden">Code</label>
                                        <input type="text" name="matieres[0][code]" placeholder="Code" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div class="md:col-span-3">
                                        <label class="block text-sm font-medium text-gray-700 mb-1 md:hidden">Nom
                                            matière</label>
                                        <input type="text" name="matieres[0][nom]" placeholder="Nom matière" required
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label
                                            class="block text-sm font-medium text-gray-700 mb-1 md:hidden">Coefficient</label>
                                        <input type="number" name="matieres[0][coefficient]" placeholder="Coefficient"
                                            step="0.1"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
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

                        <!-- Boutons d'action -->
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

            <!-- Les matieres associees -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Les matieres associees</h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Code</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Matiere</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Coefficient</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($matieres_associees as $matiere)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $matiere->code }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $matiere->nom }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $matiere->coefficient }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button
                                            onclick="document.getElementById('edit_id').value = {{ $matiere->id }}; openModal('editModal-{{ $matiere->id }}')"
                                            class="text-indigo-600 hover:text-indigo-900 mr-3 cursor-pointer">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button
                                            onclick="document.getElementById('delete_id').value = {{ $matiere->id }}; openModal('deleteModal-{{ $matiere->id }}')"
                                            class="text-red-600 hover:text-red-900 cursor-pointer">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>


        </div>
    </div>


    @foreach ($matieres_associees as $matiere)
        <!-- Modal Édition -->
        <x-modal id="editModal-{{ $matiere->id }}" title="Modifier un niveau" maxWidth="lg">
            <form id="editForm" method="POST" action="{{ route('programmes.updateMatiere', $matiere) }}">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_id">
                <x-matiere-form edit :data="$matiere" />

                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="closeModal('editModal-{{ $matiere->id }}')"
                        class="cursor-pointer px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Annuler
                    </button>
                    <button type="submit"
                        class="cursor-pointer px-4 py-2 border border-transparent rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </x-modal>
    @endforeach

    @foreach ($matieres_associees as $matiere)
        <!-- Modal Suppression -->
        <x-modal id="deleteModal-{{ $matiere->id }}" title="Confirmer la suppression" maxWidth="md">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div
                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="cursor-pointer text-lg leading-6 font-medium text-gray-900">
                            Supprimer la matiere
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Êtes-vous sûr de vouloir supprimer cette matiere ? Cette action est
                                irréversible.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <form id="deleteForm" method="POST" action="{{ route('programmes.destroyMatiere', $matiere->id) }}/">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" id="delete_id">
                    <button type="submit"
                        class="cursor-pointer w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                        Supprimer
                    </button>
                </form>
                <button type="button" onclick="closeModal('deleteModal-{{ $matiere->id }}')"
                    class="cursor-pointer mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm transition-colors duration-200">
                    Annuler
                </button>
            </div>
        </x-modal>
    @endforeach

    {{-- <script>
        
        }

        function removeRow(button) {
            const row = button.closest('.matiere-row');
            if (row) {
                row.remove();
            }
        }
    </script> --}}

    <script>
        let index = 1;

        function addMatiereRow() {
            const container = document.getElementById('matiere-list');
            const row = document.createElement('div');
            row.className = 'matiere-row bg-gray-50 rounded-lg border border-gray-200 p-4';

            row.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1 md:hidden">Code</label>
                        <input type="text" name="matieres[${index}][code]" placeholder="Code" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1 md:hidden">Nom matière</label>
                        <input type="text" name="matieres[${index}][nom]" placeholder="Nom matière" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1 md:hidden">Coefficient</label>
                        <input type="number" name="matieres[${index}][coefficient]" placeholder="Coefficient" step="0.1"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-1 flex items-center justify-end md:justify-center">
                        <button type="button" onclick="removeRow(this)"
                            class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-100 transition">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            `;

            container.appendChild(row);
            index++;
        }


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

            // // Fonctions pour les modals
            // function openDeleteModal(url) {
            //     const deleteForm = document.getElementById('deleteForm');
            //     deleteForm.action = url;
            //     const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            //     modal.show();
            // }

            // function openEditModal(url, code, nom, coefficient) {
            //     const editForm = document.getElementById('editForm');
            //     editForm.action = url;
            //     document.getElementById('edit_code').value = code;
            //     document.getElementById('edit_nom').value = nom;
            //     document.getElementById('edit_coefficient').value = coefficient;

            //     const modal = new bootstrap.Modal(document.getElementById('editModal'));
            //     modal.show();
            // }

            // Initialisation des tooltips (optionnel)
            document.addEventListener('DOMContentLoaded', function() {
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });
    </script>

</x-layout>
