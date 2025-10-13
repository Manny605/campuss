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
            <i class="fas fa-chalkboard-teacher"></i> Gestion des classes
        </h1>

        <div class="min-h-screen">
            <div class="container mx-auto px-4 py-8">

                <!-- Section Ajout -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Ajouter une classe</h2>
                            {{-- <div class="mt-2 flex items-center">
                            <span class="px-3 py-1 mx-2 bg-blue-100 text-blue-800 rounded-full font-medium">
                                ........
                            </span>
                            <span class="px-3 py-1 mx-2 bg-blue-100 text-blue-800 rounded-full font-medium">
                                ........
                            </span>
                        </div> --}}
                        </div>
                        {{-- <a href="{{ url()->previous() }}"
                        class="mt-4 md:mt-0 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Retour
                    </a> --}}
                    </div>

                    <!-- Formulaire Ajout -->
                    <div class="border-t border-gray-200 pt-6">
                        <form method="POST" action="{{ route('classes.store') }}" class="space-y-8">
                            @csrf

                            <!-- ID Année académique -->
                            <input type="hidden" name="annee_id" value="{{ $annee->id ?? '' }}">

                            <!-- Titre principal -->
                            <div class="flex items-center justify-between border-b pb-4 mb-6">
                                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                                    <i class="fas fa-layer-group text-indigo-600"></i>
                                    Création des classes
                                </h2>
                                <button type="button" onclick="addClasseRow()"
                                    class="flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow transition">
                                    <i class="fas fa-plus mr-2"></i> Ajouter une classe
                                </button>
                            </div>

                            <!-- Tableau d’en-têtes -->
                            <div
                                class="hidden md:grid grid-cols-12 gap-4 px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-600 font-semibold">
                                <div class="col-span-4">Nom de la classe</div>
                                <div class="col-span-5">Filière & Niveau</div>
                                <div class="col-span-2">Capacité</div>
                                <div class="col-span-1 text-center">Action</div>
                            </div>

                            <!-- Conteneur dynamique -->
                            <div id="classe-list" class="space-y-4">
                                <div
                                    class="classe-row bg-white border border-gray-200 rounded-xl shadow-sm p-4 hover:shadow-md transition">
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4">

                                        <!-- Nom -->
                                        <div class="md:col-span-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-1 md:hidden">
                                                <i class="fas fa-chalkboard text-indigo-500 mr-1"></i> Nom de la classe
                                            </label>
                                            <input type="text" name="classes[0][nom]"
                                                placeholder="Ex: Licence 1 Informatique" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        </div>

                                        <!-- Filière & Niveau -->
                                        <div class="md:col-span-5">
                                            <label class="block text-sm font-medium text-gray-700 mb-1 md:hidden">
                                                <i class="fas fa-graduation-cap text-indigo-500 mr-1"></i> Filière &
                                                Niveau
                                            </label>
                                            <select name="classes[0][filiere_niveau_id]" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                                <option value="">-- Sélectionnez une filière & un niveau --
                                                </option>
                                                @foreach ($filieres_niveaux as $filiere_niveau)
                                                    <option value="{{ $filiere_niveau->id }}">
                                                        {{ $filiere_niveau->filiere->nom }} —
                                                        {{ $filiere_niveau->niveau->nom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Capacité -->
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 mb-1 md:hidden">
                                                <i class="fas fa-users text-indigo-500 mr-1"></i> Capacité
                                            </label>
                                            <input type="number" name="classes[0][capacite]" placeholder="Ex: 30"
                                                min="1" required
                                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        </div>

                                        <!-- Action -->
                                        <div class="md:col-span-1 flex items-center justify-end md:justify-center">
                                            <button type="button" onclick="removeRow(this)"
                                                class="text-red-500 hover:text-red-700 p-2 rounded-full hover:bg-red-100 transition">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Boutons de validation -->
                            <div class="pt-6 border-t mt-6 flex flex-col sm:flex-row justify-end gap-4">
                                <button type="reset"
                                    class="flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition">
                                    <i class="fas fa-undo mr-2"></i> Réinitialiser
                                </button>

                                <button type="submit"
                                    class="flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow transition">
                                    <i class="fas fa-save mr-2"></i> Enregistrer les classes
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Niveau</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Filiere</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Capacite</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($classes as $classe)
                                <tr>
                                    <td class="px-6 py-4">{{ $classe->nom }}</td>
                                    <td class="px-6 py-4">{{ $classe->filiereNiveau->niveau->nom }}</td>
                                    <td class="px-6 py-4">{{ $classe->filiereNiveau->filiere->nom }}</td>
                                    <td class="px-6 py-4">{{ $classe->capacite }}</td>
                                    <td class="px-6 py-4 flex space-x-3">
                                        <button onclick="openModal('editModal-{{ $classe->id }}')"
                                            class="text-indigo-600 hover:text-indigo-900">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openModal('deleteModal-{{ $classe->id }}')"
                                            class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                        Aucune matière associée à cette filière.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Section Modals -->
                {{-- @foreach ($classes_associees as $classe)
                <!-- Modal Édition -->
                <x-modal id="editModal-{{ $classe->id }}" title="Modifier une matière" maxWidth="lg">
                    <form method="POST" action="{{ route('classes.update', $classe) }}">
                        @csrf @method('PUT')
                        <x-classe-form edit :data="$classe" />
                        <div class="mt-6 flex justify-end space-x-3">
                            <button type="button" onclick="closeModal('editModal-{{ $classe->id }}')"
                                class="px-4 py-2 border rounded-lg text-gray-700 bg-white hover:bg-gray-50">Annuler</button>
                            <button type="submit"
                                class="px-4 py-2 rounded-lg text-white bg-blue-600 hover:bg-blue-700">Mettre à jour</button>
                        </div>
                    </form>
                </x-modal>

                <!-- Modal Suppression -->
                <x-modal id="deleteModal-{{ $classe->id }}" title="Confirmer la suppression" maxWidth="md">
                    <p class="text-sm text-gray-500 mb-4">Êtes-vous sûr de vouloir supprimer cette matière ?</p>
                    <form method="POST" action="{{ route('classes.destroy', $classe->id) }}">
                        @csrf @method('DELETE')
                        <div class="flex justify-end space-x-3">
                            <button type="button" onclick="closeModal('deleteModal-{{ $classe->id }}')"
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



        <!-- Scripts -->
        <script>
            let classeIndex = 1;

            function addClasseRow() {
                const list = document.getElementById('classe-list');
                const row = document.querySelector('.classe-row').cloneNode(true);
                row.querySelectorAll('input, select').forEach(el => {
                    const name = el.getAttribute('name');
                    el.setAttribute('name', name.replace(/\[\d+\]/, `[${classeIndex}]`));
                    el.value = '';
                });
                list.appendChild(row);
                classeIndex++;
            }

            function removeRow(button) {
                const list = document.getElementById('classe-list');
                if (list.children.length > 1) {
                    button.closest('.classe-row').remove();
                }
            }
        </script>



        <script>
            let index = 1;

            function addMatiereRow() {
                const container = document.getElementById('classe-list');
                const row = document.createElement('div');
                row.className = 'classe-row bg-gray-50 rounded-lg border border-gray-200 p-4';
                row.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-2">
                        <input type="text" name="classes[${index}][code]" placeholder="Code" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-3">
                        <input type="text" name="classes[${index}][nom]" placeholder="Nom matière" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="md:col-span-2">
                        <input type="number" name="classes[${index}][coefficient]" placeholder="Coefficient" step="0.1"
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
                button.closest('.classe-row').remove();
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
