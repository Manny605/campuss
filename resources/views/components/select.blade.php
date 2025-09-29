@props([
    'name',
    'id' => '',
    'donnees' => [],
    'value' => '',     {{-- attribut de la valeur dans ton objet --}}
    'label' => '',     {{-- attribut à afficher comme label --}}
    'placeholder' => '',
    'icon' => '',
    'class' => '',
])

<div class="relative {{ $class }}">
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <i class="{{ $icon }} text-gray-400"></i>
    </div>
    <select id="{{ $id }}" name="{{ $name }}" class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
        <option value="">{{ $placeholder }}</option>
        @foreach ($donnees as $donnee)
            <option value="{{ $donnee->$value }}" @selected(old($name) == $donnee->$value)>
                {{ $donnee->$label }}
            </option>
        @endforeach
    </select>
    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
