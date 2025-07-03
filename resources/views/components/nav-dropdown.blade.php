@props(['href', 'icon', 'text', 'active' => false])

<div x-data="{ open: false }" class="relative">
    {{-- Trigger button --}}
    <button 
        @click="open = !open"
        class="flex items-center justify-between space-x-3 px-4 py-2.5 rounded-md transition-colors w-full"
        :class="{ 
            'bg-blue-700 text-white': {{ $active ? 'true' : 'false' }} || open, 
            'text-gray-200 hover:bg-blue-600 hover:text-white': !{{ $active ? 'true' : 'false' }} && !open 
        }"
    >
        <div class="flex items-center space-x-3">
            <i class="{{ $icon }} w-5 text-center"></i>
            <span class="text-sm font-medium">{{ $text }}</span>
        </div>
        <i class="fas transition-transform duration-200" :class="{ 'fa-chevron-up': open, 'fa-chevron-down': !open }"></i>
    </button>

    {{-- Dropdown menu --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        @click.outside="open = false"
        class="absolute z-10 left-0 mt-2 w-56 origin-top-left rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
        style="display: none;"
    >
        <div class="py-1">
            {{ $slot }}
        </div>
    </div>
</div>