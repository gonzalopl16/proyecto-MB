<div>

    <form wire:submit="store">
        <figure class="mb-4 relative">
            <div class="absolute top-8 right-8">
                <label class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer text-gray-600">
                    <i class="fas fa-camera mr-2"></i> Actualizar imagen
                    <input type="file" class="hidden" accept="image/*" wire:model="image">
                </label>

            </div>
            <img class="aspect-[16/9] object-cover object-center w-full"
                src="{{ $image ? $image->temporaryUrl() : Storage::url($productEdit['image_path']) }}" alt="">
        </figure>

        <x-validation-errors class="mb-4"></x-validation-errors>

        <div class="card">
            <div class="mb-4">
                <x-label class="mb-2">Codigo</x-label>
                <x-input wire:model="productEdit.sku" type="number" class="w-full" placeholder="Ingrese el codigo del producto"></x-input>
            </div>
            <div class="mb-4">
                <x-label class="mb-2">Nombre</x-label>
                <x-input wire:model="productEdit.name" class="w-full"
                    placeholder="Ingrese el Nombre del producto"></x-input>
            </div>
            <div class="mb-4">
                <x-label class="mb-2">Descripcion</x-label>
                <x-textarea class="w-full" wire:model="productEdit.descripcion" placeholder="Ingrese la descripcion"></x-textarea>
            </div>
            <div class="mb-4">
                <x-label class="mb-2">Familias</x-label>
                <x-select class="w-full" wire:model.live="family_id">

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
                <x-select class="w-full" name="category_id" wire:model.live="category_id">
                    <option value="" disabled>Seleccione categoria</option>
                    @foreach ($this->categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="mb-4">
                <x-label class="mb-2">Subcategoria</x-label>
                <x-select class="w-full" name="category_id" wire:model.live="productEdit.sub_category_id">
                    <option value="" disabled>Seleccione subcategoria</option>
                    @foreach ($this->subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}" @selected(old('sub_category_id') == $subcategory->id)>
                            {{ $subcategory->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>
            <div class="mb-4">
                <x-label class="mb-2">Precio</x-label>
                <x-input wire:model="productEdit.price" step="0.01" class="w-full" type="number" placeholder="Ingresar precio"></x-input>
            </div>

            @empty($product->variants->count()>0)
                <div class="mb-4">
                    <x-label class="mb-2">Stock</x-label>
                    <x-input wire:model="productEdit.stock" class="w-full" type="number" placeholder="Ingresar el stock del producto"></x-input>
                </div>
            @endempty
        </div>
        <div class="flesx justify-end space-x-2 mt-4">
            <x-danger-button onclick="confirmDelete()">
                Eliminar 
            </x-danger-button>
            <x-button>Actualizar</x-button>
        </div>
    </form>

    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" id="delete-form">
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
