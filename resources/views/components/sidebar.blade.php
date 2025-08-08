    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-800 text-white transition-all duration-200 ease-in-out transform"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'" x-cloak>
        <div class="flex flex-col h-full">
            <!-- Logo -->
            <div class="flex items-center space-x-2 px-4 py-6 border-b border-blue-700/50">
                <i class="fas fa-graduation-cap text-2xl text-blue-200"></i>
                <span class="text-xl font-bold text-white">CampussPass</span>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto py-4 px-2 space-y-1">
                <x-dashboard-nav-link 
                    href="{{ route('admin.dashboard') }}" 
                    icon="fas fa-home" 
                    text="Tableau de bord"
                    :active="request()->routeIs('admin.dashboard')" 
                />
                <x-dashboard-nav-link 
                    href="{{ route('etudiants.index') }}" 
                    icon="fas fa-user-graduate"
                    text="Étudiants"
                    :active="request()->routeIs('etudiants.index')" 
                />
                <x-dashboard-nav-link 
                    href="#" 
                    icon="fas fa-chalkboard-teacher" 
                    text="Enseignants"
                    :active="request()->is('enseignants*')" 
                />
                <x-nav-dropdown 
                    icon="fas fa-book" 
                    text="Programmes"
                    :active="request()->is('programmes*')"
                >
                    <x-dropdown-item 
                        icon="fas fa-calendar-alt" 
                        text="Années"
                        href="{{ route('programmes.indexAnnee') }}"
                        :active="request()->routeIs('programmes.indexAnnee')" 
                    />
                    <x-dropdown-item 
                        icon="fas fa-project-diagram" 
                        text="Filières"
                        href="{{ route('programmes.indexFiliere') }}"
                        :active="request()->routeIs('programmes.indexFiliere')" 
                    />
                    <x-dropdown-item 
                        icon="fas fa-stream" 
                        text="Semestres"
                        href="{{ route('programmes.indexSemestre') }}"
                        :active="request()->routeIs('programmes.indexSemestre')" 
                    />
                    {{-- <x-dropdown-item 
                        icon="fas fa-book-open" 
                        text="Matières"
                        href="{{ route('programmes.indexMatiere') }}"
                        :active="request()->routeIs('programmes.indexMatiere')" 
                    /> --}}
                    <x-dropdown-item 
                        icon="fas fa-th-list" 
                        text="Niveaux"
                        href="{{ route('programmes.indexNiveau') }}"
                        :active="request()->routeIs('programmes.indexNiveau')" 
                    />
                </x-nav-dropdown>
                <x-dashboard-nav-link 
                    href="#" 
                    icon="fas fa-file-alt" 
                    text="Notes & Bulletins"
                    :active="request()->is('notes*')" 
                />
                <x-dashboard-nav-link 
                    href="#" 
                    icon="fas fa-calendar-check" 
                    text="Présences"
                    :active="request()->is('presences*')" 
                />
                <x-dashboard-nav-link 
                    href="#" 
                    icon="fas fa-credit-card" 
                    text="Paiements"
                    :active="request()->is('paiements*')" 
                />
                <x-dashboard-nav-link 
                    href="#" 
                    icon="fas fa-chart-line" 
                    text="Rapports"
                    :active="request()->is('rapports*')" 
                />
            </nav>

            <!-- Sidebar footer -->
            <div class="p-4 border-t border-blue-700/50">
                <div class="text-blue-200 text-xs">
                    Version 1.0.0
                </div>
            </div>
        </div>
    </aside>
