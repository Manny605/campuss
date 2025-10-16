@props([
    'id',
    'title',
    'type' => 'default', // default | edit | delete | success | warning | info
    'maxWidth' => 'md'
])

@php
    $styles = [
        'default' => [
            'icon' => 'fas fa-window-restore',
            'iconColor' => 'text-indigo-600',
            'bg' => 'bg-white/100 backdrop-blur-md border border-gray-200',
            'titleColor' => 'text-gray-800',
        ],
        'edit' => [
            'icon' => 'fas fa-pen-to-square',
            'iconColor' => 'text-blue-600',
            'bg' => 'bg-white/100 backdrop-blur-md border border-gray-200',
            'titleColor' => 'text-blue-800',
        ],
        'delete' => [
            'icon' => 'fas fa-trash-alt',
            'iconColor' => 'text-red-600',
            'bg' => 'bg-red-50/80 backdrop-blur-md border border-red-200',
            'titleColor' => 'text-red-800',
        ],
        // 'success' => [
        //     'icon' => 'fas fa-check-circle',
        //     'iconColor' => 'text-green-600',
        //     'bg' => 'bg-green-50/80 backdrop-blur-md border border-green-200',
        //     'titleColor' => 'text-green-800',
        // ],
        // 'warning' => [
        //     'icon' => 'fas fa-exclamation-triangle',
        //     'iconColor' => 'text-yellow-600',
        //     'bg' => 'bg-yellow-50/80 backdrop-blur-md border border-yellow-200',
        //     'titleColor' => 'text-yellow-800',
        // ],
        // 'info' => [
        //     'icon' => 'fas fa-info-circle',
        //     'iconColor' => 'text-sky-600',
        //     'bg' => 'bg-sky-50/80 backdrop-blur-md border border-sky-200',
        //     'titleColor' => 'text-sky-800',
        // ],
    ];

    $maxWidthClass = match ($maxWidth) {
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
        default => 'max-w-md',
    };
@endphp

<div id="{{ $id }}"
     class="hidden fixed inset-0 bg-gray-900/40 backdrop-blur-sm flex items-center justify-center z-50 transition-all duration-300"
     role="dialog" aria-modal="true">

    <div class="{{ $styles[$type]['bg'] }} rounded-2xl shadow-2xl p-6 w-full {{ $maxWidthClass }} transition-all duration-300">
        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2">
                <i class="{{ $styles[$type]['icon'] }} {{ $styles[$type]['iconColor'] }} text-lg"></i>
                <h3 class="text-xl font-semibold {{ $styles[$type]['titleColor'] }}">
                    {{ $title }}
                </h3>
            </div>
            <button type="button" 
                    onclick="closeModal('{{ $id }}')"
                    class="text-gray-500 cursor-pointer hover:text-gray-700 transition">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- Contenu -->
        <div class="text-gray-700">
            {{ $slot }}
        </div>
    </div>
</div>
