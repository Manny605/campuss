@props(['edit' => false, 'data' => null])

<div class="bg-white rounded-xl shadow-lg p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
        <i class="fas fa-user text-indigo-600 mr-2"></i>
        Informations tuteur
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <x-input name="tuteur_prenom" icon="fas fa-user" type="text" placeholder="Prénom" :value="old('tuteur_prenom', $data?->prenom)" />
        <x-input name="tuteur_nom" icon="fas fa-user" type="text" placeholder="Nom" :value="old('tuteur_nom', $data?->nom)" />
        <x-input name="tuteur_telephone_identifiant" type="text" icon="fas fa-mobile-alt" placeholder="Téléphone/Identifiant" :value="old('tuteur_telephone_identifiant', $data?->telephone)" />
        
        @unless($edit)
            <x-input name="tuteur_password" type="password" icon="fas fa-lock" placeholder="Mot de passe" />
            <x-input name="tuteur_password_confirmation" type="password" icon="fas fa-lock" placeholder="Mot de passe" />
        @endunless

        <div class="relative hidden">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-layer-group text-gray-400"></i>
            </div>
            <select name="tuteur_role" id="tuteur_role"
                class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                <option value="tuteur" {{ old('tuteur_role', $data?->role) == 'tuteur' ? 'selected' : '' }}>Tuteur</option>
            </select>
            @error('tuteur_role')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
