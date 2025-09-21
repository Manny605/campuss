    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-800 text-white transition-all duration-200 ease-in-out transform"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'" x-cloak>
        <div class="flex flex-col h-full">


            <!-- Logo -->
            <div class="flex items-center space-x-2 px-4 py-6 border-b border-blue-700/50">
                <i class="fas fa-graduation-cap text-2xl text-blue-200"></i>
                <span class="text-xl font-bold text-white">CampussPro</span>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-4 px-2 space-y-1">

                <x-dashboard-nav-link href="{{ route('admin.dashboard') }}" icon="fas fa-home" text="Tableau de bord"
                    :active="request()->routeIs('admin.dashboard')" />

                <x-dashboard-nav-link href="{{ route('etudiants.index') }}" icon="fas fa-users-cog"
                    text="Gestion des comptes" :active="request()->routeIs('etudiants.index')" />

                <x-dashboard-nav-link href="{{ route('roles.index') }}" icon="fas fa-users-cog"
                    text="Roles & Permissions" :active="request()->routeIs('roles.index')" />

                <x-dashboard-nav-link href="{{ route('etudiants.index') }}" icon="fas fa-user-graduate" text="Étudiants"
                    :active="request()->routeIs('etudiants.index')" />

                <x-dashboard-nav-link href="{{ route('enseignants.index') }}" icon="fas fa-chalkboard-teacher"
                    text="Enseignants" :active="request()->is('enseignants*')" />

                <x-nav-dropdown icon="fas fa-book" text="Programmes" :active="request()->is('programmes*')">
                    <x-dropdown-item icon="fas fa-calendar-alt" text="Années" href="{{ route('annees.index') }}"
                        :active="request()->routeIs('annees.index')" />
                    <x-dropdown-item icon="fas fa-project-diagram" text="Filières"
                        href="{{ route('filieres.index') }}" :active="request()->routeIs('filieres.index')" />
                    <x-dropdown-item icon="fas fa-stream" text="Periodes" href="{{ route('periodes.index') }}"
                        :active="request()->routeIs('periodes.index')" />
                    <x-dropdown-item icon="fas fa-th-list" text="Niveaux" href="{{ route('niveaux.index') }}"
                        :active="request()->routeIs('niveaux.index')" />
                </x-nav-dropdown>

                <x-dashboard-nav-link href="#" icon="fas fa-calendar-alt" text="Emplois du temps"
                    :active="request()->is('plannings*')" />

                <x-dashboard-nav-link href="#" icon="fas fa-chart-line" text="Rapports" :active="request()->is('rapports*')" />
            </nav>

            <!-- Sidebar footer -->
            <div class="p-4 border-t border-blue-700/50">
                <div class="text-blue-200 text-xs">
                    Version 1.0.0
                </div>
            </div>


        </div>
    </aside>
