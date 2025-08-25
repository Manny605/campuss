<div class="bg-white rounded-xl shadow-lg p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
        <i class="fas fa-user-lock text-indigo-600 mr-2"></i>
        Informations de connexion
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- <x-input name="etudiant_identifiant" type="text" icon="fas fa-id-card" placeholder="Matricule" :value="old('identifiant')" required /> --}}
        <x-input name="etudiant_password" type="password" icon="fas fa-lock" placeholder="Mot de passe" required />
        <x-input name="etudiant_password_confirmation" type="password" icon="fas fa-lock" placeholder="Confirmer le mot de passe" required />
        
        <div class="relative hidden">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class="fas fa-layer-group text-gray-400"></i>
            </div>

            <select name="etudiant_role" id="etudiant_role" class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                <option value="etudiant">Etudiant</option>
            </select>

            @error('etudiant_role')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
    
    </div>
</div>