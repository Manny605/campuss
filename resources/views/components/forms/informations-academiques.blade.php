@props(['classes', 'edit' => false, 'data' => null])

<div class="bg-white rounded-xl shadow-lg p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
        <i class="fas fa-graduation-cap text-indigo-600 mr-2"></i>
        Informations académiques
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-layer-group text-gray-400"></i>
            </div>

            <select name="classe_id" id="classe_id"
                class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                <option value="">Choisir une classe</option>
                @foreach ($classes->sortBy([
                    fn($a, $b) => strcmp($a->filiereNiveau->niveau->nom, $b->filiereNiveau->niveau->nom),
                    fn($a, $b) => strcmp($a->filiereNiveau->filiere->nom, $b->filiereNiveau->filiere->nom)
                ]) as $classe)
                    <option value="{{ $classe->id }}"
                        @selected(old('classe_id', $data?->classe_id ?? '') == $classe->id)>
                        ({{ $classe->filiereNiveau->niveau->nom }}) - {{ $classe->filiereNiveau->filiere->nom }}
                    </option>
                @endforeach
            </select>

            @error('classe_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
