<x-layout>
    <x-slot:title>Mise à jour de l'étudiant - Admin</x-slot:title>
    <x-slot:header>Mise à jour de l'étudiant</x-slot:header>

    <div class="p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Détails de l'étudiant</h2>

        <form action="{{ route('etudiants.update', $etudiant) }}" method="POST" class="space-y-6">
            @method('PUT')
            @csrf

            <x-forms.informations-personnelles :data="$etudiant"/>
            <x-forms.informations-academiques :classes="$classes" />
            <x-forms.informations-tuteur :data="$tuteur" />

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-lg hover:from-indigo-700 hover:to-indigo-800 transition-all duration-200 transform hover:scale-[1.02] font-medium">
                    <i class="fas fa-plus mr-2"></i>Créer l'étudiant
                </button>
            </div>
        </form>
    </div>
</x-layout>



{{-- @section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialisation des sélecteurs
            const selectClasses = document.getElementById('classe_id');
            const selectTuteurs = document.getElementById('tuteur_id');

            // Fonction pour mettre à jour les options de tuteur en fonction de la classe sélectionnée
            function updateTuteursOptions() {
                const classeId = selectClasses.value;
                fetch(`/tuteurs/${classeId}`)
                    .then(response => response.json())
                    .then(data => {
                        selectTuteurs.innerHTML = '';
                        data.forEach(tuteur => {
                            const option = document.createElement('option');
                            option.value = tuteur.id;
                            option.textContent = `${tuteur.nom} ${tuteur.prenom}`;
                            selectTuteurs.appendChild(option);
                        });
                    });
            }

            // Événement de changement sur le sélecteur de classe
            selectClasses.addEventListener('change', updateTuteursOptions);

            // Initialiser les options de tuteur au chargement
            updateTuteursOptions();
        });
    </script> --}}