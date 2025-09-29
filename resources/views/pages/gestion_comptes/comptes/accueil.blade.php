<x-layout>
    <x-slot:title>Gestion des Comptes</x-slot:title>
    <x-slot:header>Gestion des Comptes</x-slot:header>

    <div class="p-6">
        <!-- Titre principal -->
        <h1 class="text-3xl font-bold mb-8 flex items-center gap-3 text-indigo-700">
            <i class="fas fa-users-cog"></i> Gestion des Comptes
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($roles as $role)
                <div class="bg-white shadow-md rounded-xl p-6 hover:shadow-xl transition">
                    <a href="{{ route('users.indexUsersByRole', $role->id) }}" class="flex items-center gap-4">
                        <div class="p-4 bg-indigo-100 rounded-full">
                            <i class="fas fa-user-tag text-indigo-600 text-2xl"></i>
                        </div>

                        <div>
                            <h2 class="text-lg font-semibold text-gray-800">{{ $role->name }}</h2>
                            <p class="text-2xl font-bold text-gray-900">{{ $role->users_count }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</x-layout>
