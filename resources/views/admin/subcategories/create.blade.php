<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Subcategorias',
        'route' => route('admin.subcategories.index'),
    ],
    [
        'name' => 'Nuevo',
    ],
]">



    {{-- <form action="{{ route('admin.subcategories.store') }}" method="POST">
        @csrf
        <div class="card">
            <x-validation-errors class="mb-4">

            </x-validation-errors>
            <div class="mb-4">
                <x-label class="mb-2">Categoria</x-label>
                <x-select class="w-full" name="category_id" id="">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @selected(old('category_id')==$category->id)>
                            {{ $category->name }}
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
    </form> --}}

    @livewire('admin.subcategories.subcategory-create')

</x-admin-layout>
