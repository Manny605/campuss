@props(['href', 'icon', 'text', 'active' => false])

<a href="{{ $href }}" 
   @class([
       'flex items-center space-x-3 px-4 py-2.5 rounded-md transition-colors',
       'bg-blue-700 text-white' => $active,
       'text-gray-200 hover:bg-blue-600 hover:text-white' => !$active
   ])
   {{ $attributes }}>
    <i class="{{ $icon }} w-5 text-center"></i>
    <span class="text-sm font-medium">{{ $text }}</span>
</a>