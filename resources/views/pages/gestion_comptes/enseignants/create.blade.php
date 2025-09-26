<x-layout>
    <x-slot:title>Création d'enseignant - Admin</x-slot>
    <x-slot:header>Création d'enseignant</x-slot>

    <div class="p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Créer un nouvel enseignant</h2>

        <form action="{{ route('enseignants.store') }}" method="POST" class="space-y-6">
            @method('POST')
            @csrf

            <x-forms.enseignant-informations-personnelles />

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white rounded-lg hover:from-indigo-700 hover:to-indigo-800 transition-all duration-200 transform hover:scale-[1.02] font-medium">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</x-layout>
