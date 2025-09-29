<x-layout>

    <x-slot:title>
        Association Matières - Admin
    </x-slot:title>

    <x-slot:header>
        Associer des matières à l’enseignant
    </x-slot:header>

<div class="min-h-screen flex items-center justify-center bg-gray-100 py-8 px-4">
    <div class="w-full max-w-4xl bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-[#1b1b18] mb-6">Associer des Matières à un Enseignant</h2>

        <!-- Sélecteur de niveau -->
        <div class="mb-6 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-800">Sélectionner un Niveau</h3>
            <select id="niveauFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="all">Tous</option>
                <option value="master">Master</option>
                <option value="licence">Licence</option>
                <option value="bt">BT</option>
                <option value="bts">BTS</option>
            </select>
        </div>

        <!-- Regroupement par niveau -->
        <div id="matieresSection">
            <!-- Master -->
            <div class="niveau-section" data-niveau="master">
                <h4 class="text-xl font-semibold text-[#1b1b18] mb-4">Master</h4>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach ($niveaux->where('nom', 'master') as $niveau)
                        @foreach ($niveau->matieres as $matiere)
                            <div class="p-4 bg-gray-200 dark:bg-gray-700 rounded-lg">
                                <h5 class="font-semibold text-gray-700">{{ $matiere->nom }}</h5>
                                <p class="text-sm text-gray-500 dark:text-gray-300">Non associé</p>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>


            <!-- Licence -->
            <div class="niveau-section" data-niveau="licence">
                <h4 class="text-xl font-semibold text-[#1b1b18] mb-4">Licence</h4>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach ($niveaux->where('nom', 'licence') as $niveau)
                        @foreach ($niveau->matieres as $matiere)
                            <div class="p-4 bg-gray-200 dark:bg-gray-700 rounded-lg">
                                <h5 class="font-semibold text-gray-700">{{ $matiere->nom }}</h5>
                                <p class="text-sm text-gray-500 dark:text-gray-300">Non associé</p>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>


            <!-- BTS -->
            <div class="niveau-section" data-niveau="bts">
                <h4 class="text-xl font-semibold text-[#1b1b18] mb-4">BTS</h4>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach ($niveaux->where('nom', 'bts') as $niveau)
                        @foreach ($niveau->matieres as $matiere)
                            <div class="p-4 bg-gray-200 dark:bg-gray-700 rounded-lg">
                                <h5 class="font-semibold text-gray-700">{{ $matiere->nom }}</h5>
                                <p class="text-sm text-gray-500 dark:text-gray-300">Non associé</p>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>


            <!-- BT -->
            <div class="niveau-section" data-niveau="bt">
                <h4 class="text-xl font-semibold text-[#1b1b18] mb-4">BT</h4>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach ($niveaux->where('nom', 'bt') as $niveau)
                        @foreach ($niveau->matieres as $matiere)
                            <div class="p-4 bg-gray-200 dark:bg-gray-700 rounded-lg">
                                <h5 class="font-semibold text-gray-700">{{ $matiere->nom }}</h5>
                                <p class="text-sm text-gray-500 dark:text-gray-300">Non associé</p>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>

            
        </div>
    </div>
</div>

<script>
    // Script pour filtrer par niveau
    document.getElementById('niveauFilter').addEventListener('change', function() {
        let niveau = this.value;
        document.querySelectorAll('.niveau-section').forEach(function(section) {
            if (niveau === 'all' || section.getAttribute('data-niveau') === niveau) {
                section.classList.remove('hidden');
            } else {
                section.classList.add('hidden');
            }
        });
    });
</script>

</x-layout>
