<x-layout>
    <x-slot name="title">Affecter des permissions au rôle {{ $role->name }}</x-slot>

    <x-slot name="breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                {{-- <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Rôles</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.show', $role->id) }}">{{ $role->name }}</a></li> --}}
                <li class="breadcrumb-item active" aria-current="page">Affecter des permissions</li>
            </ol>
        </nav>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Affecter des permissions au rôle {{ $role->name }}</h3>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="permissions" class="form-label">Sélectionner les permissions à affecter :</label>
                    <select name="permissions[]" id="permissions" class="form-select" multiple required>
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->id }}" {{ $role->hasPermissionTo($permission) ? 'selected' : '' }}>
                                {{ $permission->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Affecter les permissions</button>
            </form>
        </div>
    </div>
</x-layout>


{{-- {{ route('roles.permissions.attach', $role->id) }} --}}