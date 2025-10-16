<x-layout>
    <x-slot:title>Profil utilisateur</x-slot:title>
    <x-slot:header>Profil utilisateur</x-slot:header>

    <div class="relative min-h-screen py-12 px-6 md:px-12">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">

            @csrf
            @method('PUT')


            <div class="flex rounded-xl flex-col md:flex-row items-center justify-between gap-6 px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-indigo-600 to-blue-500 text-white">
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <img src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?background=4f46e5&color=fff&name=' . urlencode(Auth::user()->prenom . ' ' . Auth::user()->nom) }}"
                            alt="Avatar"
                            class="w-28 h-28 rounded-full border-4 border-white/70 shadow-lg object-cover transition-transform duration-300 hover:scale-105">
                        <button type="button"
                            class="absolute bottom-1 right-1 bg-white/90 hover:bg-white text-indigo-600 p-2 rounded-full shadow-md transition">
                            <i class="fas fa-camera text-sm"></i>
                        </button>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</h1>
                        <p class="text-indigo-100 text-sm mt-1">{{ Auth::user()->roles->pluck('name')->join(', ') }}</p>
                    </div>
                </div>
            </div>

            <!-- Contenu -->
            <div class="py-8 space-y-10">


                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="p-6 bg-white/60 rounded-xl border border-gray-200 shadow-inner">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-user text-indigo-500"></i> Informations personnelles
                        </h2>
                        <div class="space-y-3 text-gray-700">
                            <p><i class="fas fa-phone-alt text-indigo-500 mr-2"></i><strong>Téléphone:</strong>
                                {{ Auth::user()->telephone }}</p>
                            <p><i class="fas fa-id-badge text-indigo-500 mr-2"></i><strong>Identifiant:</strong>
                                {{ Auth::user()->identifiant }}</p>
                            <p><i class="fas fa-check-circle text-indigo-500 mr-2"></i><strong>Statut:</strong>
                                <span
                                    class="px-2 py-1 rounded-md text-sm 
                                    {{ Auth::user()->statut === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst(Auth::user()->statut) }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- Carte Sécurité -->
                    <div class="p-6 bg-white/60 rounded-xl border border-gray-200 shadow-inner">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fas fa-lock text-indigo-500"></i> Sécurité du compte
                        </h2>
                        <p class="text-gray-600 text-sm mb-4">Mettez à jour votre mot de passe pour renforcer la
                            sécurité de votre compte.</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <x-input placehoder="Nouveau mot de passe" name="password" type="password" icon="fas fa-key"
                                placeholder="********" />
                            <x-input placehoder="Confirmer le mot de passe" name="password_confirmation" type="password"
                                icon="fas fa-key" />
                        </div>
                    </div>
                </div>

                <div class="bg-white/60 rounded-xl p-6 border border-gray-200 shadow-inner">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-edit text-indigo-500"></i> Modifier mes informations
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-input placehoder="Prénom" name="prenom" value="{{ old('prenom', Auth::user()->prenom) }}"
                            icon="fas fa-user" required />
                        <x-input placehoder="Nom" name="nom" value="{{ old('nom', Auth::user()->nom) }}"
                            icon="fas fa-user" required />
                        <x-input placehoder="Téléphone" name="telephone"
                            value="{{ old('telephone', Auth::user()->telephone) }}" icon="fas fa-phone" />
                        <x-input placehoder="Identifiant" name="identifiant"
                            value="{{ old('identifiant', Auth::user()->identifiant) }}" icon="fas fa-id-badge" />
                    </div>
                </div>

                <!-- Boutons -->
                <div class="flex justify-end gap-3 pt-4">
                    <button type="submit"
                        class="px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-blue-600 hover:from-indigo-700 hover:to-blue-700 text-white rounded-lg shadow-lg transition transform hover:scale-105">
                        <i class="fas fa-save mr-2"></i> Mettre à jour
                    </button>
                </div>
            </div>
        </form>

    </div>
</x-layout>
