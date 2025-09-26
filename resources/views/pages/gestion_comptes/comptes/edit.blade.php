<x-layout>
    <x-slot:title>Création d'un compte</x-slot:title>
    <x-slot:header>
        Création d'un compte
    </x-slot:header>

    <!-- Full width container -->
    <div class="w-full max-w-6xl mx-auto p-10 bg-white rounded-2xl shadow-xl mt-8">
        <h1 class="text-3xl font-bold mb-8 flex items-center gap-3 text-gray-800">
            <i class="fas fa-pencil-alt text-yellow-500"></i>
            Modifier un Utilisateur
        </h1>

        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Prénom -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-id-badge mr-2 text-indigo-500"></i>Prénom
                    </label>
                    <input type="text" name="prenom"
                        value="{{ old('prenom', $user->prenom) }}"
                        required
                        class="w-full px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition" />
                </div>

                <!-- Nom -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-user mr-2 text-indigo-500"></i>Nom
                    </label>
                    <input type="text" name="nom"
                        value="{{ old('nom', $user->nom) }}"
                        required
                        class="w-full px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition" />
                </div>

                <!-- Téléphone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-phone mr-2 text-indigo-500"></i>Téléphone
                    </label>
                    <input type="text" name="telephone"
                        value="{{ old('telephone', $user->telephone) }}"
                        required
                        class="w-full px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition" />
                </div>

                <!-- Identifiant -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-user-circle mr-2 text-indigo-500"></i>Identifiant
                    </label>
                    <input type="text" name="identifiant"
                        value="{{ old('identifiant', $user->identifiant) }}"
                        required
                        class="w-full px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition" />
                </div>

                <!-- Mot de passe -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-lock mr-2 text-indigo-500"></i>Mot de passe
                        <span class="text-xs text-gray-400">(laisser vide si inchangé)</span>
                    </label>
                    <input type="password" name="password"
                        class="w-full px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition" />
                </div>

                <!-- Statut -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-toggle-on mr-2 text-indigo-500"></i>Statut
                    </label>
                    <select name="status"
                        class="w-full px-4 py-2 border rounded-xl bg-white shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
                        <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>Actif</option>
                        <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>
            </div>

            <!-- Avatar -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-image mr-2 text-indigo-500"></i>Avatar
                </label>
                @if ($user->avatar_url)
                    <div class="mb-3 flex items-center gap-4">
                        <img src="{{ asset('storage/' . $user->avatar_url) }}" alt="Avatar"
                            class="w-20 h-20 rounded-full object-cover border shadow" />
                        <span class="text-sm text-gray-600">Actuel</span>
                    </div>
                @endif

                <input type="file" name="avatar_url" accept="image/*"
                    class="w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4
                           file:rounded-md file:border-0
                           file:text-sm file:font-semibold
                           file:bg-indigo-50 file:text-indigo-700
                           hover:file:bg-indigo-100 cursor-pointer" />
            </div>

            <!-- Rôle -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    <i class="fas fa-user-tag mr-2 text-indigo-500"></i>Rôle
                </label>
                <select name="role" id="role-select"
                    class="w-full px-4 py-2 border rounded-xl bg-white shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="enseignant" {{ old('role', $user->role) == 'enseignant' ? 'selected' : '' }}>Enseignant</option>
                    <option value="etudiant" {{ old('role', $user->role) == 'etudiant' ? 'selected' : '' }}>Etudiant</option>
                    <option value="tuteur" {{ old('role', $user->role) == 'tuteur' ? 'selected' : '' }}>Tuteur</option>
                </select>
            </div>

            <!-- Champs spécifiques -->
            <div id="etudiant-fields" style="{{ old('role', $user->role) == 'etudiant' ? '' : 'display:none;' }}">
                <h2 class="text-lg font-medium mt-4 mb-2 text-gray-700">Informations étudiant</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Matricule</label>
                        <input type="text" name="matricule"
                            value="{{ old('matricule', optional($user->tuteur)->matricule) }}"
                            class="w-full px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Date de naissance</label>
                        <input type="date" name="date_naissance"
                            value="{{ old('date_naissance', optional($user->tuteur)->date_naissance) }}"
                            class="w-full px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition" />
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lieu de naissance</label>
                        <input type="text" name="lieu_naissance"
                            value="{{ old('lieu_naissance', optional($user->tuteur)->lieu_naissance) }}"
                            class="w-full px-4 py-2 border rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition" />
                    </div>
                </div>
            </div>

            <!-- Relation si Tuteur -->
            <div id="tuteur-fields" style="{{ old('role', $user->role) == 'tuteur' ? '' : 'display:none;' }}">
                <h2 class="text-lg font-medium mt-4 mb-2 text-gray-700">Informations Tuteur</h2>
                <label class="block text-sm font-medium text-gray-700 mb-1">Relation</label>
                <select name="relation"
                    class="w-full px-4 py-2 border rounded-xl bg-white shadow-sm focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
                    <option value="pere" {{ old('relation', optional($user->relation)) == 'pere' ? 'selected' : '' }}>Père</option>
                    <option value="mere" {{ old('relation', optional($user->relation)) == 'mere' ? 'selected' : '' }}>Mère</option>
                    <option value="tuteur" {{ old('relation', optional($user->relation)) == 'tuteur' ? 'selected' : '' }}>Autre Tuteur</option>
                </select>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const roleSelect = document.getElementById('role-select');
                    const etuFields = document.getElementById('etudiant-fields');
                    const tutFields = document.getElementById('tuteur-fields');

                    roleSelect.addEventListener('change', function () {
                        etuFields.style.display = this.value === 'etudiant' ? 'block' : 'none';
                        tutFields.style.display = this.value === 'tuteur' ? 'block' : 'none';
                    });
                });
            </script>

            <!-- Actions -->
            <div class="flex gap-4 mt-8">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl shadow-md hover:opacity-90 transition">
                    <i class="fas fa-check"></i> Mettre à jour
                </button>

                <a href="{{ route('users.index') }}"
                    class="inline-flex items-center gap-2 px-8 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-100 transition">
                    <i class="fas fa-arrow-left"></i> Retour
                </a>
            </div>
        </form>
    </div>
</x-layout>
