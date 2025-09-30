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

        <!-- Formulaire principal -->
        <form id="classeForm" action="{{ route('classes.store') }}" method="POST" class="space-y-8">
            @csrf

            <!-- Section champs -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-id-card text-indigo-500"></i> Informations de la classe
                </h2>

                <div id="classe-fields" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nom -->
                    <x-input icon="fas fa-id-badge" placeholder="Nom de la classe" name="nom[]" type="text"
                        required />

                    <!-- Filière -->
                    <div class="relative">
                        <select name="filiere_id[]"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                            <option value="">-- Sélectionnez une filière --</option>
                            @foreach ($filieres as $filiere)
                                <option value="{{ $filiere->id }}">{{ $filiere->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Niveau -->
                    <div class="relative">
                        <select name="niveau_id[]"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                            <option value="">-- Sélectionnez un niveau --</option>
                            @foreach ($niveaux as $niveau)
                                <option value="{{ $niveau->id }}">{{ $niveau->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Année académique -->
                    <div class="relative">
                        <select name="annee_academique_id[]"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200">
                            <option value="">-- Sélectionnez une année académique --</option>
                            @foreach ($annees as $annee)
                                <option value="{{ $annee->id }}" @selected(old('annee_academique_id') == $annee->id || $annee->active)>
                                    {{ $annee->code }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Capacité -->
                    <x-input icon="fas fa-users" placeholder="Capacité" name="capacite[]" type="number" min="1"
                        required />
                </div>

                <!-- Bouton Ajouter -->
                <div class="mt-6">
                    <button type="button" id="addRow"
                        class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-md">
                        <i class="fas fa-plus"></i> Ajouter une autre classe
                    </button>
                </div>
            </div>

            <!-- Section tableau -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-table text-indigo-500"></i> Liste des classes à créer
                </h2>
                <table id="classeTable" class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 text-left">
                        <tr>
                            <th class="px-4 py-2">Nom</th>
                            <th class="px-4 py-2">Filière</th>
                            <th class="px-4 py-2">Niveau</th>
                            <th class="px-4 py-2">Année académique</th>
                            <th class="px-4 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm"></tbody>
                </table>
            </div>

            <!-- Boutons -->
            <div class="flex gap-4 mt-8">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-8 py-3 bg-indigo-600 hover:bg-indigo-700 
                           text-white font-semibold rounded-xl shadow-md transition">
                    <i class="fas fa-check"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>

    <!-- Script pour gestion dynamique -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addRowBtn = document.getElementById("addRow");
            const tableBody = document.querySelector("#classeTable tbody");
            const form = document.getElementById("classeForm");

            addRowBtn.addEventListener("click", function() {
                const fields = document.querySelectorAll("#classe-fields [name]");
                const row = document.createElement("tr");

                fields.forEach(field => {
                    const td = document.createElement("td");
                    td.classList.add("px-4", "py-2");

                    if (field.tagName === "SELECT") {
                        td.textContent = field.options[field.selectedIndex].text;
                    } else {
                        td.textContent = field.value;
                    }
                    row.appendChild(td);
                });

                // Ajout colonne Action
                const actionTd = document.createElement("td");
                actionTd.classList.add("px-4", "py-2");
                actionTd.innerHTML = `<button type="button" class="text-red-500 hover:underline removeRow">Supprimer</button>`;
                row.appendChild(actionTd);

                tableBody.appendChild(row);

                // reset les champs
                fields.forEach(field => field.value = "");
            });

            // Suppression de ligne
            tableBody.addEventListener("click", function(e) {
                if (e.target.classList.contains("removeRow")) {
                    e.target.closest("tr").remove();
                }
            });
        });
    </script>
</x-layout>
