<x-layout>
    <x-slot:title>Création d'étudiant - Admin</x-slot>
    <x-slot:header>Création d'étudiant</x-slot>

    <div class="p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Créer un nouvel étudiant</h2>

        <form action="{{ route('etudiants.store') }}" method="POST" class="space-y-6">
            @method('POST')
            @csrf

            <x-forms.informations-personnelles />
            <x-forms.informations-academiques :classes="$classes" />
            <x-forms.informations-tuteur />

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-lg hover:from-indigo-700 hover:to-indigo-800 transition-all duration-200 transform hover:scale-[1.02] font-medium">
                    <i class="fas fa-plus mr-2"></i>Créer l'étudiant
                </button>
            </div>
        </form>
    </div>
</x-layout>
