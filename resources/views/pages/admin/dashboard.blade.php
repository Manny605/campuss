<x-layout>

    <x-slot:title>
        Tableau de bord - Admin
    </x-slot>

    <x-slot:header>
        Tableau de bord
    </x-slot>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500">
            <h3 class="text-gray-500 text-sm">Étudiants inscrits</h3>
            <p class="text-2xl font-bold">1,234</p>
            <i class="fas fa-users text-blue-500 mt-2"></i>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-green-500">
            <h3 class="text-gray-500 text-sm">Cours actifs</h3>
            <p class="text-2xl font-bold">45</p>
            <i class="fas fa-book-open text-green-500 mt-2"></i>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-purple-500">
            <h3 class="text-gray-500 text-sm">Taux de complétion</h3>
            <p class="text-2xl font-bold">78%</p>
            <i class="fas fa-chart-line text-purple-500 mt-2"></i>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="mt-6 bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold mb-4">Activités récentes</h2>
        <div class="space-y-4">
            <div class="flex items-center">
                <div class="h-8 w-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-user-plus text-blue-500"></i>
                </div>
                <span>Nouvel étudiant inscrit</span>
            </div>
            <!-- Add more activities -->
        </div>
    </div>

</x-layout>
