<div>
    <form wire:submit="save">
        <div class="card">
            <x-validation-errors class="mb-4"/>

            <div class="mb-4">
                <x-label class="mb-2">Familias</x-label>
                <x-select class="w-full" wire:model.live="subcategoryEdit.family_id">

                    <option value="" disabled>
                        Selecciona una familia
                    </option>

                    @foreach ($families as $family)
                        <option value="{{ $family->id }}">
                            {{ $family->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">Categoria</x-label>
                <x-select class="w-full" name="category_id" wire:model.live="subcategoryEdit.category_id">
                    <option value="" disabled>Seleccione categoria</option>
                    @foreach ($this->categories as $category)
                        <option value="{{ $category->id }}"
                            @selected(old('category_id')==$category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="mb-4">
                <x-label class="mb-2">Nombre</x-label>
                <x-input class="w-full mb-4"
                    placeholder="Ingresar nombre de Categoria"
                    wire:model="subcategoryEdit.name" />
            </div>
            <div class="flesx justify-end space-x-2">
                <x-danger-button onclick="confirmDelete()">
                    Eliminar 
                </x-danger-button>
                <x-button>Actualizar</x-button>
            </div>
        </div>
    </form>

    <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" method="POST" id="delete-form">
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
</div>