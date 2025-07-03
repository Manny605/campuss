@props(['href', 'icon', 'text', 'active' => false])

<a 
    href="{{ $href }}" 
    @class([
        'flex items-center space-x-3 px-4 py-2.5 text-gray-700 hover:bg-gray-100 transition-colors',
        'bg-gray-100 font-medium' => $active
    ])
>
    @if($icon)
        <i class="{{ $icon }} w-5 text-center text-gray-400"></i>
    @endif
    <span class="text-sm">{{ $text }}</span>
</a>