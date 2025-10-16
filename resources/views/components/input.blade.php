@props([
    'name', 
    'type' => 'text', 
    'icon' => '', 
    'placeholder' => '', 
    'value' => '', 
    'required' => false, 
    'edit' => false, 
    'class' => ''
])

<div class="relative">
    @if($icon)
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="{{ $icon }} text-gray-400"></i>
        </div>
    @endif
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        placeholder="{{ $placeholder }}" 
        value="{{ old($name, $value) }}" 
        @if($required) required @endif
        class="w-full {{ $icon ? 'pl-10' : 'pl-4' }} pr-4 py-2.5 border border-gray-200 rounded-lg transition-all duration-200 {{ $class }}"
    >
    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>