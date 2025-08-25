@props(['edit' => false, 'data' => null])

<div class="bg-white rounded-xl shadow-lg p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
        <i class="fas fa-user text-indigo-600 mr-2"></i>
        Informations personnelles
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- User Credentials --}}
        <div>
            <label for="identifiant" class="block text-sm font-medium text-gray-700 mb-1">Identifiant</label>
            <x-input name="identifiant" type="text" icon="fas fa-id-card" placeholder="Identifiant" 
                :value="old('identifiant', $edit ? $data->user->identifiant ?? '' : '')"
                :required="!$edit" />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
            <x-input name="password" type="password" icon="fas fa-lock" placeholder="Mot de passe"
                :required="!$edit" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe</label>
            <x-input name="password_confirmation" type="password" icon="fas fa-lock"
                placeholder="Confirmer le mot de passe" :required="!$edit" />
        </div>

        {{-- Enseignant Information --}}
        <div>
            <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
            <x-input name="nom" type="text" icon="fas fa-user" placeholder="Nom" 
                :value="old('nom', $data->nom ?? '')" required />
        </div>

        <div>
            <label for="prenom" class="block text-sm font-medium text-gray-700 mb-1">Prénom</label>
            <x-input name="prenom" type="text" icon="fas fa-user" placeholder="Prénom" 
                :value="old('prenom', $data->prenom ?? '')" required />
        </div>

        <div>
            <label for="telephone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
            <x-input name="telephone" type="text" icon="fas fa-phone" placeholder="Téléphone"
                :value="old('telephone', $data->telephone ?? '')" />
        </div>

        <div>
            <label for="date_embauche" class="block text-sm font-medium text-gray-700 mb-1">Date d'embauche</label>
            <x-input name="date_embauche" type="date" icon="fas fa-calendar-alt" placeholder="Date d'embauche"
                :value="old('date_embauche', 
                    isset($data->date_embauche) ? \Carbon\Carbon::parse($data->date_embauche)->format('Y-m-d') : ''
                )" required />
        </div>

        <div>
            <label for="specialite" class="block text-sm font-medium text-gray-700 mb-1">Spécialité</label>
            <x-input name="specialite" type="text" icon="fas fa-graduation-cap" placeholder="Spécialité"
                :value="old('specialite', $data->specialite ?? '')" required />
        </div>

        <div>
            <label for="grade" class="block text-sm font-medium text-gray-700 mb-1">Grade</label>
            <x-input name="grade" type="text" icon="fas fa-medal" placeholder="Grade"
                :value="old('grade', $data->grade ?? '')" />
        </div>

        {{-- <div>
            <label for="classe_id" class="block text-sm font-medium text-gray-700 mb-1">Classe</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-chalkboard text-gray-400"></i>
                </div>
                <select name="classe_id" id="classe_id"
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white" required>
                    <option value="">Sélectionner une classe</option>
                    @foreach($classes ?? [] as $classe)
                        <option value="{{ $classe->id }}" 
                            {{ old('classe_id', $data->classe_id ?? '') == $classe->id ? 'selected' : '' }}>
                            {{ $classe->nom }}
                        </option>
                    @endforeach
                </select>
                @error('classe_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div> --}}

        <div class="relative hidden">
            <select name="role" id="role">
                <option value="enseignant" selected>Enseignant</option>
            </select>
        </div>
    </div>
</div>
