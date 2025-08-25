@props(['edit' => false, 'data' => null])

<div class="bg-white rounded-xl shadow-lg p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
        <i class="fas fa-user text-indigo-600 mr-2"></i>
        Informations personnelles
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="etudiant_identifiant" class="block text-sm font-medium text-gray-700 mb-1">Matricule</label>
            <x-input name="etudiant_identifiant" id="etudiant_identifiant" type="text" icon="fas fa-id-card" placeholder="Matricule" 
                :value="old('etudiant_identifiant', $edit ? $data->user->identifiant ?? '' : $matricule ?? '')"
                :required="!$edit" />
        </div>

        <div>
            <label for="etudiant_nom" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
            <x-input name="etudiant_nom" id="etudiant_nom" type="text" icon="fas fa-user" placeholder="Nom" 
                :value="old('etudiant_nom', $data->nom ?? '')" />
        </div>

        <div>
            <label for="etudiant_prenom" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
            <x-input name="etudiant_prenom" id="etudiant_prenom" type="text" icon="fas fa-user" placeholder="Prénom" 
                :value="old('etudiant_prenom', $data->prenom ?? '')" />
        </div>

        <div>
            <label for="etudiant_telephone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
            <x-input name="etudiant_telephone" id="etudiant_telephone" type="text" icon="fas fa-phone" placeholder="Téléphone"
                :value="old('etudiant_telephone', $data->telephone ?? '')" />
        </div>

        <div>
            <label for="date_naissance" class="block text-sm font-medium text-gray-700 mb-1">Date de naissance</label>
            <x-input name="date_naissance" id="date_naissance" type="date" icon="fas fa-calendar-alt" placeholder="Date de naissance"
                :value="old(
                    'date_naissance',
                    isset($data->date_naissance) ? \Carbon\Carbon::parse($data->date_naissance)->format('Y-m-d') : '',
                )" />
        </div>

        <div>
            <label for="etudiant_password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
            <x-input name="etudiant_password" id="etudiant_password" type="password" icon="fas fa-lock" placeholder="Mot de passe"
                :required="!$edit" />
        </div>

        <div>
            <label for="etudiant_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmation du mot de passe</label>
            <x-input name="etudiant_password_confirmation" id="etudiant_password_confirmation" type="password" icon="fas fa-lock"
                placeholder="Confirmer le mot de passe" :required="!$edit" />
        </div>

        <div class="relative hidden">
            <label for="etudiant_role" class="block text-sm font-medium text-gray-700 mb-1">Rôle</label>
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-layer-group text-gray-400"></i>
            </div>

            <select name="etudiant_role" id="etudiant_role"
                class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                <option value="etudiant"
                    {{ old('etudiant_role', $data->user->role ?? '') == 'etudiant' ? 'selected' : '' }}>Etudiant
                </option>
            </select>

            @error('etudiant_role')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
