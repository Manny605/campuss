<x-layout>

    <x-slot:title>
        Gestion des Filières - Admin
    </x-slot:title>

    <x-slot:header>
        Détail de la Filière
    </x-slot:header>

    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-4">{{ $filiere->nom }}</h2>
        <div class="mb-6">
            <p class="text-gray-800">{{ $filiere->code }}</p>
        </div>

        <div>
            <h3 class="text-xl font-semibold mb-2">Matières (toutes)</h3>
            @if($filiere->matieres->count())
                <ul class="list-disc list-inside space-y-1">
                    @foreach($filiere->matieres as $matiere)
                        <li>{{ $matiere->nom }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">Aucune matière associée.</p>
            @endif
        </div>
    </div>

</x-layout>