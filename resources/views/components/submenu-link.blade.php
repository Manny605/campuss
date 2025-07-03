@props(['href' => '#', 'text' => 'Link', 'active' => false])

<a href="{{ $href }}" 
   @class([
       'block pl-4 pr-2 py-2 text-sm transition-colors duration-200',
       'text-blue-200 hover:bg-blue-700 hover:text-white' => !$active,
       'bg-blue-900 text-white' => $active,
       'dark:text-blue-300 dark:hover:bg-gray-700' => !$active && config('dark_mode'),
   ])
   {{ $attributes }}>
    <div class="flex items-center">
        <!-- Bullet point -->
        <span class="w-2 h-2 mr-3 bg-current rounded-full opacity-75"></span>
        {{ $text }}
    </div>
</a>