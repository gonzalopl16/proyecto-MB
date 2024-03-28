<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorias',
        'route' => route('admin.categories.index'),
    ],
    [
        'name' => 'Nuevo',
    ],
]">



    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="card">
            <x-validation-errors class="mb-4">

            </x-validation-errors>
            <div class="mb-4">
                <x-label class="mb-2">Familia</x-label>
                <x-select class="w-full" name="family_id" id="">
                    @foreach ($families as $family)
                        <option value="{{ $family->id }}"
                            @selected(old('family_id')==$family->id)>
                            {{ $family->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="mb-4">
                <x-label class="mb-2">Nombre</x-label>
                <x-input name="name" class="w-full mb-4" value="{{ old('name') }}"
                    placeholder="Ingresar nombre de Categoria" />
            </div>
            <div>
                <x-button>Guardar</x-button>
            </div>
        </div>
    </form>

</x-admin-layout>
