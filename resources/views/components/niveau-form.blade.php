@props(['edit' => false, 'data' => null])

<div class="mb-4">
    <x-input type="text" name="nom" id="{{ $edit ? 'edit_nom' : 'nom' }}" 
           value="{{ $edit && $data ? $data->nom : '' }}" placeholder="Nom du niveau" required
           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"/>
</div>
