@props(['edit' => false, 'data' => null, 'annees' => []])

<div class="mb-4">
    <label for="{{ $edit ? 'edit_annee_id' : 'annee_id' }}" class="block text-sm font-medium text-gray-700">Annee</label>
    <select name="annee_id" id="{{ $edit ? 'edit_annee_id' : 'annee_id' }}" 
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <option value="" disabled {{ !$edit || !$data ? 'selected' : '' }}>Selectionnez une annee</option>
        @foreach ($annees as $annee)
            <option value="{{ $annee->id }}" {{ $edit && $data && $data->annee_id == $annee->id ? 'selected' : '' }}>
                {{ $annee->libelle }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-4">
    <label for="{{ $edit ? 'edit_code' : 'code' }}" class="block text-sm font-medium text-gray-700">Code</label>
    <input type="text" name="code" id="{{ $edit ? 'edit_code' : 'code' }}" 
           value="{{ $edit && $data ? $data->code : '' }}" 
           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
</div>