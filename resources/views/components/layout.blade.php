<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'CampussPro' }}</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('sweetalert2::index')

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex flex-col" x-data="appData()" @resize.window.debounce="handleResize()">
    <!-- Sidebar Backdrop (mobile only) -->
    <div x-show="sidebarOpen && !isDesktop()" x-transition:enter="transition-opacity ease-linear duration-200"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click="sidebarOpen = false" class="fixed inset-0 z-20 bg-black/50 md:hidden"
        x-cloak>
    </div>

    @include('components.sidebar')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col md:pl-64 transition-all duration-200">
        <!-- Header -->
        <header class="sticky top-0 z-20 bg-white shadow-sm">
            <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                <!-- Mobile menu button -->
                <button @click="toggleSidebar" class="md:hidden text-gray-500 hover:text-gray-600 focus:outline-none"
                    aria-label="Toggle sidebar">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <!-- Page title -->
                <h1 class="text-lg font-semibold text-gray-800 truncate">
                    {{ $header ?? '' }}
                </h1>

                <!-- User dropdown -->
                <div class="relative ml-4">
                    <button @click="profileMenuOpen = !profileMenuOpen"
                        class="flex items-center max-w-xs rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                        aria-haspopup="true" :aria-expanded="profileMenuOpen">
                        <img class="h-8 w-8 rounded-full object-cover"
                            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->prenom) }}&background=3B82F6&color=fff"
                            alt="{{ Auth::user()->prenom }}">
                        <span
                            class="hidden md:inline-flex ml-2 text-sm font-medium text-gray-700">{{ Auth::user()->prenom }}</span>
                        <i class="fas fa-chevron-down ml-1 text-gray-400 text-xs transition-transform duration-200"
                            :class="{ 'rotate-180': profileMenuOpen }"></i>
                    </button>

                    <!-- Dropdown menu -->
                    <div x-show="profileMenuOpen" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95" @click.away="profileMenuOpen = false"
                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                        x-cloak>
                        <div class="py-1">
                            <div class="px-4 py-2 text-xs text-gray-500 border-b">
                                Connecté en tant que<br>
                                <span class="font-medium text-gray-900">{{ strtoupper(Auth::user()->role) }}</span>
                            </div>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mon
                                profil</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Paramètres</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main class="flex-1">
            <div class="py-6 px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-lg shadow-sm ring-1 ring-gray-200/50 p-6">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>




    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>

        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        
        function removeRow(button) {
            const list = document.getElementById('classe-list');
            if (list.children.length > 1) {
                button.closest('.classe-row').remove();
            }
        }


        function appData() {
            return {
                sidebarOpen: window.innerWidth >= 768,
                profileMenuOpen: false,

                isDesktop() {
                    return window.innerWidth >= 768;
                },

                toggleSidebar() {
                    this.sidebarOpen = !this.sidebarOpen;
                },

                handleResize() {
                    this.sidebarOpen = this.isDesktop();
                }
            }
        }
    </script>
</body>

</html>
