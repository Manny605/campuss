@props(['id', 'title'])

<div id="{{ $id }}" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50" role="dialog" aria-modal="true">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <h3 class="text-lg font-bold mb-4">{{ $title }}</h3>
        {{ $slot }}
    </div>
</div>
