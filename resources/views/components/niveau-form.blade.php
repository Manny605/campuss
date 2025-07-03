@props(['edit' => false, 'data' => null])

<div class="mb-4">
    <label for="{{ $edit ? 'edit_nom' : 'nom' }}" class="block text-sm font-medium text-gray-700">Nom</label>
    <input type="text" name="nom" id="{{ $edit ? 'edit_nom' : 'nom' }}" 
           value="{{ $edit && $data ? $data->nom : '' }}" 
           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
</div>
