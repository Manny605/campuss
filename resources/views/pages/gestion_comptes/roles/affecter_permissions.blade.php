<x-layout>

    <x-slot:title>Affecter des permissions au rôle {{ ucfirst($role->name) }}</x-slot:title>
    <x-slot:header>Affecter des permissions au rôle {{ ucfirst($role->name) }}</x-slot:header>

    <div class="p-6 space-y-10">
        <!-- Titre principal -->
        <div class="flex items-center justify-between border-b pb-4">
            <h2 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                <i class="fas fa-user-shield text-indigo-600"></i>
                Gestion des permissions du rôle
                <span class="text-indigo-600">“{{ ucfirst($role->name) }}”</span>
            </h2>
        </div>

        <!-- Formulaire -->
        <form action="{{ route('roles.AffectPermissionsToRole', $role->id) }}" method="POST" class="space-y-8">
            @csrf

            <!-- SECTION : Permissions groupées -->
            @php
                $groupedPermissions = [
                    'Utilisateurs & Rôles' => ['users.', 'roles.', 'assign.'],
                    'Académique' => ['filieres.', 'niveaux.', 'classes.', 'notes.', 'enseignant.', 'etudiant.'],
                    'Tuteur' => ['tuteur.'],
                    'Comptabilité' => ['paiements.', 'finances.', 'frais.'],
                    'Statistiques & Système' => ['stats.', 'system.'],
                ];
            @endphp

            @foreach ($groupedPermissions as $groupName => $prefixes)
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-folder-open text-indigo-500"></i> {{ $groupName }}
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach ($permissions as $permission)
                            @php
                                $matches = false;
                                foreach ($prefixes as $prefix) {
                                    if (str_starts_with($permission->name, $prefix)) {
                                        $matches = true;
                                        break;
                                    }
                                }
                            @endphp

                            @if ($matches)
                                <label
                                    class="flex items-center gap-3 p-3 border rounded-xl hover:bg-gray-50 cursor-pointer transition shadow-sm">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                        class="rounded text-indigo-600 focus:ring-indigo-500"
                                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                    <span class="text-gray-800 text-sm font-medium">
                                        {{ str_replace(['.', '_'], [' › ', ' '], ucfirst($permission->name)) }}
                                    </span>
                                </label>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach

            <!-- SECTION : Autres permissions -->
            @php
                $otherPermissions = $permissions->filter(function ($p) use ($groupedPermissions) {
                    foreach ($groupedPermissions as $prefixes) {
                        foreach ($prefixes as $prefix) {
                            if (str_starts_with($p->name, $prefix)) {
                                return false;
                            }
                        }
                    }
                    return true;
                });
            @endphp

            @if ($otherPermissions->isNotEmpty())
                <div class="bg-white p-6 rounded-2xl shadow-md border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-ellipsis-h text-indigo-500"></i> Autres permissions
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                        @foreach ($otherPermissions as $permission)
                            <label
                                class="flex items-center gap-3 p-3 border rounded-xl hover:bg-gray-50 cursor-pointer transition shadow-sm">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                    class="rounded text-indigo-600 focus:ring-indigo-500"
                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                <span class="text-gray-800 text-sm font-medium">
                                    {{ str_replace(['.', '_'], [' › ', ' '], ucfirst($permission->name)) }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Boutons -->
            <div class="flex justify-end gap-4 pt-6 border-t">
                <a href="{{ route('roles.index') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-100 transition">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-md transition">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </div>
        </form>
    </div>

</x-layout>
