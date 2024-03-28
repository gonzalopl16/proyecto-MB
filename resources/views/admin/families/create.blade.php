<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Familias',
        'route' => route('admin.families.index'),
    ],
    [
        'name' => 'Nuevo',
    ],
]">

    <div class="card">
        <x-validation-errors class="mb-4">

        </x-validation-errors>
        <form action="{{ route('admin.families.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <x-label class="mb-2">Nombre</x-label>
                <x-input name="name" class="w-full" value="{{ old('name') }}"
                    placeholder="Ingresar nombre de Familia" />
            </div>
            <div>
                <x-button>Guardar</x-button>
            </div>
        </form>
    </div>

</x-admin-layout>
