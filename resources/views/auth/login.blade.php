<x-guest>

    <x-slot:title>
        Se connecter - CampussPro
    </x-slot>

    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-xl transform transition-all duration-300 hover:shadow-2xl relative overflow-hidden">
            <!-- Effet de dégradé en arrière-plan -->
            <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-white opacity-50"></div>
            
            <!-- Cercle décoratif -->
            <div class="absolute -top-20 -right-20 w-40 h-40 bg-blue-100 rounded-full opacity-20"></div>
            <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-blue-100 rounded-full opacity-20"></div>

            <div class="relative">
                <div class="text-center">
                    <div class="mx-auto h-20 w-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mb-4 shadow-lg">
                        <i class="fas fa-graduation-cap text-white text-3xl"></i>
                    </div>
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">
                        CampussPro
                    </h2>
                    <p class="mt-2 text-sm text-gray-600 font-medium">
                        Votre plateforme d'éducation professionnelle
                    </p>
                </div>

                <form class="mt-8 space-y-6" action="{{ route('login.store') }}" method="POST">
                    @csrf

                    <div class="rounded-md space-y-5">
                        <div>
                            <label for="identifiant" class="block text-sm font-semibold text-gray-700 mb-1">Identifiant</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                                </div>
                                <input id="identifiant" name="identifiant" type="text" autocomplete="identifiant" required
                                    class="w-full px-3 py-2.5 pl-10 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/50 backdrop-blur-sm"
                                    placeholder="Votre identifiant">
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Mot de passe</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                                </div>
                                <input id="password" name="password" type="password" autocomplete="current-password"
                                    required
                                    class="w-full px-3 py-2.5 pl-10 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-white/50 backdrop-blur-sm"
                                    placeholder="••••••••">
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded transition-colors">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-700 font-medium">Se souvenir de moi</label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-semibold text-blue-600 hover:text-blue-500 transition-colors">
                                Mot de passe oublié ?
                            </a>
                        </div>
                    </div>

                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-lg text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-[1.02] shadow-lg hover:shadow-xl">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-sign-in-alt text-blue-300 group-hover:text-blue-200 transition-colors"></i>
                        </span>
                        Se connecter
                    </button>

                    <div class="text-center mt-6">
                        <p class="text-sm text-gray-600">
                            Besoin d'aide ? 
                            <a href="#" class="font-semibold text-blue-600 hover:text-blue-500 transition-colors">
                                Contactez le support
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-guest>
