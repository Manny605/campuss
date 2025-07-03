@props(['edit' => false, 'data' => null, 'filieres' => [], 'niveaux' => [], 'annees' => []])


<div class="mb-4">
    <label for="filiere_id" class="block text-sm font-medium text-gray-700">Filiere</label>
    <select name="filiere_id" id="filiere_id"
        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <option value="" disabled {{ !$edit || !$data ? 'selected' : '' }}>Selectionnez une filiere</option>
        @foreach ($filieres as $filiere)
            <option value="{{ $filiere->id }}"
                {{ $edit && $data && $data->filiere_id == $filiere->id ? 'selected' : '' }}>
                {{ $filiere->nom }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label for="niveau_id" class="block text-sm font-medium text-gray-700">Niveau</label>
    <select name="niveau_id" id="niveau_id"
        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <option value="" disabled {{ !$edit || !$data ? 'selected' : '' }}>Selectionnez un niveau</option>
        @foreach ($niveaux as $niveau)
            <option value="{{ $niveau->id }}"
                {{ $edit && $data && $data->niveau_id == $niveau->id ? 'selected' : '' }}>
                {{ $niveau->nom }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label for="annee_id" class="block text-sm font-medium text-gray-700">Annee</label>
    <select name="annee_id" id="annee_id"
        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <option value="" disabled {{ !$edit || !$data ? 'selected' : '' }}>Selectionnez une annee</option>
        @foreach ($annees as $annee)
            <option value="{{ $annee->id }}"
                {{ $edit && $data && $data->annee_id == $annee->id ? 'selected' : '' }}>
                {{ $annee->libelle }}
            </option>
        @endforeach
    </select>
</div>