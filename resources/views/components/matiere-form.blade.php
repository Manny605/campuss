@props(['edit' => false, 'data' => null])

<div class="mb-4">
    <label for="{{ $edit ? 'edit_code' : 'code' }}" class="block text-sm font-medium text-gray-700">Code</label>
    <input type="text" name="code" id="{{ $edit ? 'edit_code' : 'code' }}" 
           value="{{ $edit && $data ? $data->code : '' }}" 
           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
</div>
<div class="mb-4">
    <label for="{{ $edit ? 'edit_nom' : 'nom' }}" class="block text-sm font-medium text-gray-700">Nom</label>
    <input type="text" name="nom" id="{{ $edit ? 'edit_nom' : 'nom' }}" 
           value="{{ $edit && $data ? $data->nom : '' }}" 
           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
</div>
<div class="mb-4">
    <label for="{{ $edit ? 'edit_coefficient' : 'coefficient' }}" class="block text-sm font-medium text-gray-700">Coefficient</label>
    <input type="text" name="coefficient" id="{{ $edit ? 'edit_coefficient' : 'coefficient' }}" 
           value="{{ $edit && $data ? $data->coefficient : '' }}" 
           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
</div>
<div class="mb-4 hidden">
    <label for="{{ $edit ? 'edit_semestre_id' : 'semestre_id' }}" class="block text-sm font-medium text-gray-700">Coefficient</label>
    <input type="text" name="semestre_id" id="{{ $edit ? 'edit_semestre_id' : 'semestre_id' }}" 
           value="{{ $edit && $data ? $data->semestre_id : '' }}" 
           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
</div>