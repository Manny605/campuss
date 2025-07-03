@props(['edit' => false, 'data' => null])

<div class="mb-4">
    <label for="{{ $edit ? 'edit_libelle' : 'libelle' }}" class="block text-sm font-medium text-gray-700">Libelle</label>
    <input type="text" name="libelle" id="{{ $edit ? 'edit_libelle' : 'libelle' }}" 
           value="{{ $edit && $data ? $data->libelle : '' }}" 
           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
</div>
<div class="mb-4">
    <label for="{{ $edit ? 'edit_active' : 'active' }}" class="block text-sm font-medium text-gray-700">Active</label>
    <select name="active" id="{{ $edit ? 'edit_active' : 'active' }}"
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        <option value="1" {{ ($edit && $data && $data->active) ? 'selected' : '' }}>Active</option>
        <option value="0" {{ ($edit && $data && !$data->active) ? 'selected' : '' }}>Inactive</option>
    </select>
</div>