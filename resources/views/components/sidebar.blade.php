<!-- Sidebar -->
<aside class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-800 text-white transition-all duration-200 ease-in-out transform"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'" x-cloak>
    <div class="flex flex-col h-full">


        <!-- Logo -->
        <div class="flex items-center space-x-2 px-4 py-6 border-b border-blue-700/50">
            <i class="fas fa-graduation-cap text-2xl text-blue-200"></i>
            <span class="text-xl font-bold text-white">CampussPro</span>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto py-4 px-2 space-y-1">

            <!-- Tableau de bord -->
            <x-dashboard-nav-link href="{{ route('admin.dashboard') }}" icon="fas fa-chart-line" text="Tableau de bord"
                :active="request()->routeIs('admin.dashboard')" />

            <!-- Utilisateurs -->
            <x-dashboard-nav-link href="{{ route('users.index') }}" icon="fas fa-users" text="Utilisateurs"
                :active="request()->routeIs('users.index')" />

            <!-- Rôles & Permissions -->
            <x-nav-dropdown icon="fas fa-user-shield" text="Rôles & Permissions" :active="request()->is('roles_permissions*')">
                <x-dropdown-item icon="fas fa-user-tag" text="Rôles" href="{{ route('roles.index') }}"
                    :active="request()->routeIs('roles.index')" />
                <x-dropdown-item icon="fas fa-lock" text="Permissions" href="{{ route('permissions.index') }}"
                    :active="request()->routeIs('permissions.index')" />
            </x-nav-dropdown>

            <!-- Académique -->
            <x-nav-dropdown icon="fas fa-graduation-cap" text="Académique" :active="request()->is('academique*')">
                <x-dropdown-item icon="fas fa-calendar-alt" text="Années" href="{{ route('annees.index') }}"
                    :active="request()->routeIs('annees.index')" />
                <x-dropdown-item icon="fas fa-building-columns" text="Filières" href="{{ route('filieres.index') }}"
                    :active="request()->routeIs('filieres.index')" />
                <x-dropdown-item icon="fas fa-clock" text="Périodes" href="{{ route('periodes.index') }}"
                    :active="request()->routeIs('periodes.index')" />
                <x-dropdown-item icon="fas fa-layer-group" text="Niveaux" href="{{ route('niveaux.index') }}"
                    :active="request()->routeIs('niveaux.index')" />
                <x-dropdown-item icon="fas fa-chalkboard-teacher" text="Classes" href="{{ route('classes.index') }}"
                    :active="request()->routeIs('classes.index')" />
            </x-nav-dropdown>

            <!-- Paramètres -->
            <x-nav-dropdown icon="fas fa-cogs" text="Paramètres" :active="request()->is('parametres*')">
                <x-dropdown-item icon="fas fa-sliders-h" text="Général" href="#" :active="request()->routeIs('')" />
                <x-dropdown-item icon="fas fa-calendar-check" text="Années académiques" href="#"
                    :active="request()->routeIs('')" />
                <x-dropdown-item icon="fas fa-user-circle" text="Profil" href="#" :active="request()->routeIs('')" />
            </x-nav-dropdown>

        </nav>

        <!-- Sidebar footer -->
        <div class="p-4 border-t border-blue-700/50">
            <div class="text-blue-200 text-xs">
                Version 1.0.0
            </div>
        </div>


    </div>
</aside>
