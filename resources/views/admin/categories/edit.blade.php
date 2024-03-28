<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categoria',
        'route' => route('admin.categories.index'),
    ],
    [
        'name' => $category->name,
    ],
]">

<form action="{{ route('admin.categories.update',$category) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card">
        <x-validation-errors class="mb-4">
        </x-validation-errors>
        <div class="mb-4">
            <x-label class="mb-2">Familia</x-label>
            <x-select class="w-full" name="family_id" id="">
                @foreach ($families as $family)
                    <option value="{{ $family->id }}" 
                        @selected(old('family_id',$category->family_id)==$family->id)>
                        {{ $family->name }}
                    </option>
                @endforeach
            </x-select>
        </div>
        <div class="mb-4">
            <x-label class="mb-2">Nombre</x-label>
            <x-input name="name" class="w-full mb-4" value="{{ old('name',$category->name) }}"
                placeholder="Ingresar nombre de Categoria" />
        </div>
        <div class="flex justify-end space-x-2">
            <x-danger-button onclick="confirmDelete()">
                Eliminar
            </x-danger-button>
            <x-button>Guardar</x-button>
        </div>
    </div>
</form>

<form action="{{ route('admin.categories.destroy', $category) }}" method="POST" id="delete-form">
    @csrf
    @method('DELETE')
</form>

@push('js')
    <script>
        function confirmDelete() {
            Swal.fire({
                title: "Estas seguro?",
                text: "No podras lo revertir!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminalo!",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form').submit();
                }
            });
        }
    </script>
@endpush
</x-admin-layout>
