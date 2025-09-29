<x-layout>

    <x-slot:title>Affecter des permissions au rôle {{ $role->name }}</x-slot:title>
    <x-slot:header>Affecter des permissions au rôle {{ $role->name }}</x-slot:header>

    <div class="p-6">
        <div class="flex items-center justify-between border-b pb-4 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fas fa-user-shield text-indigo-600"></i>
                Affecter des permissions au rôle <span class="text-indigo-600">“{{ $role->name }}”</span>
            </h2>
        </div>

        <form action="{{ route('roles.AffectPermissionsToRole', $role->id) }}" method="POST" class="space-y-8">
            @csrf

            <!-- Liste de permissions en checkboxes -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-4">
                    <i class="fas fa-key mr-2 text-indigo-500"></i>
                    Sélectionner les permissions à affecter :
                </label>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($permissions as $permission)
                        <label
                            class="flex items-center gap-3 p-3 border rounded-xl shadow-sm cursor-pointer hover:bg-gray-50 transition">
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                            <span class="text-gray-800">{{ ucfirst($permission->name) }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Boutons -->
            <div class="flex gap-4">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-md hover:opacity-90 transition">
                    <i class="fas fa-check"></i> Enregistrer
                </button>
                <a href="{{ route('roles.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-100 transition">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </form>
    </div>
</x-layout>



{{-- {{ route('roles.permissions.attach', $role->id) }} --}}
