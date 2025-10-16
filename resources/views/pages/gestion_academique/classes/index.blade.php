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

        <!-- Formulaire Ajout -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <!-- En-tête -->
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

            <form method="POST" action="{{ route('classes.store') }}">
                @csrf
                <input type="hidden" name="annee_id" value="{{ $annee->id ?? '' }}">

                <!-- Tableau entêtes -->
                <div
                    class="hidden md:grid grid-cols-12 gap-4 px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-gray-600 font-semibold">
                    <div class="col-span-4">Nom de la classe</div>
                    <div class="col-span-5">Filière & Niveau</div>
                    <div class="col-span-2">Capacité</div>
                    <div class="col-span-1 text-center">Action</div>
                </div>

                <!-- Conteneur dynamique -->
                <div id="classe-list" class="space-y-4 py-4">
                    <div
                        class="classe-row bg-white border border-gray-200 rounded-xl shadow-sm p-4 hover:shadow-md transition">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                            <!-- Nom -->
                            <div class="md:col-span-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1 md:hidden">
                                    Nom de la classe
                                </label>
                                <x-input placeholder="Ex: Licence 1 Informatique" name="classes[0][nom]"
                                    type="text" />
                            </div>

                            <!-- Filière & Niveau -->
                            <div x-data="filiereNiveauDropdown({{ $filieres_niveaux }}, 0)" class="md:col-span-5 relative">
                                <input type="text" x-model="search" @focus="open = true" @click.away="open = false"
                                    placeholder="Recherchez une filière ou un niveau..."
                                    class="w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <input type="hidden" x-model="selectedId" name="classes[0][filiere_niveau_id]">
                                <ul x-show="open"
                                    class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg mt-1 max-h-48 overflow-y-auto">
                                    <template x-for="item in filtered" :key="item.id">
                                        <li @click="select(item)" class="px-3 py-2 hover:bg-indigo-100 cursor-pointer"
                                            x-text="item.label"></li>
                                    </template>
                                    <li x-show="filtered.length === 0" class="px-3 py-2 text-gray-500">Aucun résultat
                                    </li>
                                </ul>
                            </div>

                            <!-- Capacité -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1 md:hidden">
                                    Capacité
                                </label>
                                <x-input placeholder="Ex: 30" name="classes[0][capacite]" type="number" />
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

                <!-- Boutons -->
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
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
                                        class="text-indigo-600 cursor-pointer hover:text-indigo-900">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="openModal('deleteModal-{{ $classe->id }}')"
                                        class="text-red-600 cursor-pointer hover:text-red-900">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    Aucune classe créée pour l'année académique sélectionnée.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section Modals -->
        @foreach ($classes as $classe)
            <!-- Modal Édition -->
            <x-modal id="editModal-{{ $classe->id }}" title="Modifier la classe" type="edit" maxWidth="lg">
                <form method="POST" action="{{ route('classes.update', $classe) }}">
                    @csrf @method('PUT')
                    <div class="flex flex-col md:grid md:grid-cols-12 gap-4">
                        <div class="md:col-span-4">
                            <x-input type="text" name="nom" value="{{ $classe->nom }}" placeholder="Nom"
                                required />
                        </div>
                        <div class="md:col-span-5">
                            <select name="filiere_niveau_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @foreach ($filieres_niveaux as $filiere_niveau)
                                    <option value="{{ $filiere_niveau->id }}"
                                        {{ $classe->filiere_niveau_id == $filiere_niveau->id ? 'selected' : '' }}>
                                        {{ $filiere_niveau->filiere->nom }} — {{ $filiere_niveau->niveau->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-2">
                            <x-input type="number" name="capacite" value="{{ $classe->capacite }}" required />
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" onclick="closeModal('editModal-{{ $classe->id }}')"
                            class="px-4 py-2 cursor-pointer border rounded-lg text-gray-700 bg-white hover:bg-gray-50">Annuler</button>
                        <button type="submit"
                            class="px-4 py-2 cursor-pointer rounded-lg text-white bg-blue-600 hover:bg-blue-700">Mettre
                            à jour</button>
                    </div>
                </form>
            </x-modal>

            <!-- Modal Suppression -->
            <x-modal id="deleteModal-{{ $classe->id }}" title="Confirmer la suppression" type="delete"
                maxWidth="md">
                <p class="text-sm text-gray-500 mb-4">
                    Êtes-vous sûr de vouloir supprimer la classe <strong>{{ $classe->nom }}</strong> ?
                </p>
                <form method="POST" action="{{ route('classes.destroy', $classe->id) }}">
                    @csrf @method('DELETE')
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeModal('deleteModal-{{ $classe->id }}')"
                            class="px-4 py-2 cursor-pointer border rounded-lg bg-white text-gray-700 hover:bg-gray-50">Annuler</button>
                        <button type="submit"
                            class="px-4 py-2 cursor-pointer rounded-lg text-white bg-red-600 hover:bg-red-700">Supprimer</button>
                    </div>
                </form>
            </x-modal>
        @endforeach
    </div>

    <!-- Scripts -->
    <script>
        let classeIndex = 1;

        function addClasseRow() {
            const list = document.getElementById('classe-list');
            const firstRow = document.querySelector('.classe-row');
            const newRow = firstRow.cloneNode(true);

            newRow.querySelectorAll('input').forEach(input => {
                if (input.type !== 'hidden') input.value = '';
                const oldName = input.getAttribute('name');
                if (oldName) input.setAttribute('name', oldName.replace(/\[\d+\]/, `[${classeIndex}]`));
            });

            // réinitialiser dropdown Alpine
            newRow.querySelector('[x-data]').setAttribute('x-data',
                `filiereNiveauDropdown(@json($filieres_niveaux), ${classeIndex})`
            );

            list.appendChild(newRow);
            classeIndex++;
            Alpine.initTree(newRow);
        }



        function filiereNiveauDropdown(items, index) {
            return {
                open: false,
                search: '',
                selectedId: null,
                items: items.map(i => ({
                    id: i.id,
                    label: i.niveau.nom + ' — ' + i.filiere.nom
                })),
                get filtered() {
                    return this.items.filter(i => i.label.toLowerCase().includes(this.search.toLowerCase()));
                },
                select(item) {
                    this.search = item.label;
                    this.selectedId = item.id;
                    this.open = false;
                }
            };
        }
    </script>
</x-layout>
