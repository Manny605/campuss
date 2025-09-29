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

                {{-- <x-dashboard-nav-link href="{{ route('etudiants.index') }}" icon="fas fa-users-cog" text="Inscriptions & Étudiants" :active="request()->routeIs('etudiants.index')" />

                <x-dashboard-nav-link href="{{ route('roles.index') }}" icon="fas fa-users-cog"
                    text="Roles & Permissions" :active="request()->routeIs('roles.index')" />

                <x-dashboard-nav-link href="{{ route('etudiants.index') }}" icon="fas fa-user-graduate" text="Étudiants"
                    :active="request()->routeIs('etudiants.index')" />

                <x-dashboard-nav-link href="{{ route('enseignants.index') }}" icon="fas fa-chalkboard-teacher"
                    text="Enseignants" :active="request()->is('enseignants*')" /> --}}

                <x-nav-dropdown icon="fas fa-book" text="Sécurité & Comptes" :active="request()->is('securite_comptes*')">
                    <x-dropdown-item icon="fas fa-calendar-alt" text="Utilisateurs" href="{{ route('users.index') }}" :active="request()->routeIs('users.index')" />
                    <x-dropdown-item icon="fas fa-project-diagram" text="Rôles" href="{{ route('roles.index') }}" :active="request()->routeIs('roles.index')" />
                    <x-dropdown-item icon="fas fa-stream" text="Permissions" href="{{ route('permissions.index') }}" :active="request()->routeIs('permissions.index')" />
                </x-nav-dropdown>

                {{-- <x-nav-dropdown icon="fas fa-school" text="Inscriptions & Étudiants" :active="request()->is('inscriptions*')">
                    <x-dropdown-item icon="fas fa-user-graduate" text="Étudiants" href="{{ route('etudiants.index') }}" :active="request()->routeIs('etudiants.index')" />
                    <x-dropdown-item icon="fas fa-users-cog" text="Tuteurs" href="{{ route('tuteurs.index') }}" :active="request()->routeIs('tuteurs.index')" />
                    <x-dropdown-item icon="fas fa-users-cog" text="Inscriptions" href="{{ route('inscriptions.index') }}" :active="request()->routeIs('inscriptions.index')" />
                </x-nav-dropdown> --}}
{{-- 
                <x-nav-dropdown icon="fas fa-book" text="Pédagogie" :active="request()->is('pedagogie*')">
                    <x-dropdown-item icon="fas fa-calendar-alt" text="Documents de cours" href="{{ route('documents.index') }}" :active="request()->routeIs('documents.index')" />
                    <x-dropdown-item icon="fas fa-project-diagram" text="Devoirs" href="{{ route('devoirs.index') }}" :active="request()->routeIs('devoirs.index')" />
                    <x-dropdown-item icon="fas fa-stream" text="Examens" href="{{ route('examens.index') }}" :active="request()->routeIs('examens.index')" />
                    <x-dropdown-item icon="fas fa-stream" text="Notes" href="{{ route('notes.index') }}" :active="request()->routeIs('notes.index')" />
                    <x-dropdown-item icon="fas fa-stream" text="Bulletins" href="{{ route('bulletins.index') }}" :active="request()->routeIs('bulletins.index')" />
                </x-nav-dropdown>

                <x-nav-dropdown icon="fas fa-book" text="Présences & Discipline" :active="request()->is('presences_disciplines*')">
                    <x-dropdown-item icon="fas fa-calendar-alt" text="Présences" href="{{ route('presences.index') }}" :active="request()->routeIs('presences.index')" />
                    <x-dropdown-item icon="fas fa-project-diagram" text="Incidents" href="{{ route('incidents.index') }}" :active="request()->routeIs('incidents.index')" />
                </x-nav-dropdown>

                <x-nav-dropdown icon="fas fa-wallet" text="Finance" :active="request()->is('finance*')">
                    <x-dropdown-item icon="fas fa-money-bill-wave" text="Frais scolaires" href="{{ route('frais.index') }}" :active="request()->routeIs('frais.index')" />
                    <x-dropdown-item icon="fas fa-file-invoice" text="Factures" href="{{ route('factures.index') }}" :active="request()->routeIs('factures.index')" />
                    <x-dropdown-item icon="fas fa-credit-card" text="Paiements" href="{{ route('paiements.index') }}" :active="request()->routeIs('paiements.index')" />
                    <x-dropdown-item icon="fas fa-chart-line" text="Rapports financiers" href="{{ route('rapports.financiers') }}" :active="request()->routeIs('rapports.financiers')" />
                </x-nav-dropdown> --}}

                <x-nav-dropdown icon="fas fa-book" text="Programmes" :active="request()->is('programmes*')">
                    <x-dropdown-item icon="fas fa-calendar-alt" text="Années" href="{{ route('annees.index') }}" :active="request()->routeIs('annees.index')" />
                    <x-dropdown-item icon="fas fa-project-diagram" text="Filières" href="{{ route('filieres.index') }}" :active="request()->routeIs('filieres.index')" />
                    <x-dropdown-item icon="fas fa-stream" text="Periodes" href="{{ route('periodes.index') }}" :active="request()->routeIs('periodes.index')" />
                    <x-dropdown-item icon="fas fa-th-list" text="Niveaux" href="{{ route('niveaux.index') }}" :active="request()->routeIs('niveaux.index')" />
                    {{-- <x-dropdown-item icon="fas fa-th-list" text="Plannings" href="{{ route('plannings.index') }}" :active="request()->routeIs('plannings.index')" />
                    <x-dropdown-item icon="fas fa-th-list" text="Classes" href="{{ route('classes.index') }}" :active="request()->routeIs('classes.index')" /> --}}
                </x-nav-dropdown>
{{-- 
                <!-- Communication -->
                <x-nav-dropdown icon="fas fa-comments" text="Communication" :active="request()->is('communication*')">
                    <x-dropdown-item icon="fas fa-bullhorn" text="Annonces" href="{{ route('annonces.index') }}" :active="request()->routeIs('annonces.index')" />
                    <x-dropdown-item icon="fas fa-envelope" text="Messages" href="{{ route('messages.index') }}" :active="request()->routeIs('messages.index')" />
                    <x-dropdown-item icon="fas fa-bell" text="Notifications" href="{{ route('notifications.index') }}" :active="request()->routeIs('notifications.index')" />
                </x-nav-dropdown>

                <!-- Rapports & Exports -->
                <x-nav-dropdown icon="fas fa-chart-bar" text="Rapports & Exports" :active="request()->is('rapports*')">
                    <x-dropdown-item icon="fas fa-file-alt" text="Rapports académiques" href="{{ route('rapports.academiques') }}" :active="request()->routeIs('rapports.academiques')" />
                    <x-dropdown-item icon="fas fa-file-invoice-dollar" text="Rapports financiers" href="{{ route('rapports.financiers') }}" :active="request()->routeIs('rapports.financiers')" />
                    <x-dropdown-item icon="fas fa-user-clock" text="Rapports absences" href="{{ route('rapports.absences') }}" :active="request()->routeIs('rapports.absences')" />
                </x-nav-dropdown>

                <!-- Paramètres -->
                <x-nav-dropdown icon="fas fa-cogs" text="Paramètres" :active="request()->is('settings*')">
                    <x-dropdown-item icon="fas fa-wrench" text="Paramètres généraux" href="{{ route('settings.index') }}" :active="request()->routeIs('settings.index')" />
                    <x-dropdown-item icon="fas fa-ruler" text="Barèmes / Notation" href="{{ route('settings.grading') }}" :active="request()->routeIs('settings.grading')" />
                    <x-dropdown-item icon="fas fa-link" text="Intégrations" href="{{ route('settings.integrations') }}" :active="request()->routeIs('settings.integrations')" />
                </x-nav-dropdown> --}}

            </nav>

            <!-- Sidebar footer -->
            <div class="p-4 border-t border-blue-700/50">
                <div class="text-blue-200 text-xs">
                    Version 1.0.0
                </div>
            </div>


        </div>
    </aside>
