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
                src="{{ $image ? $image->temporaryUrl() : asset('images/img/no-image.jpeg') }}" alt="">
        </figure>

        <x-validation-errors class="mb-4"></x-validation-errors>

        <div class="card">
            <div class="mb-4">
                <x-label class="mb-2">Codigo</x-label>
                <x-input wire:model="product.sku" type="number" class="w-full" placeholder="Ingrese el codigo del producto"></x-input>
            </div>
            <div class="mb-4">
                <x-label class="mb-2">Nombre</x-label>
                <x-input wire:model="product.name" class="w-full"
                    placeholder="Ingrese el Nombre del producto"></x-input>
            </div>
            <div class="mb-4">
                <x-label class="mb-2">Descripcion</x-label>
                <x-textarea class="w-full" wire:model="product.descripcion" placeholder="Ingrese la descripcion"></x-textarea>
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
                <x-select class="w-full" name="category_id" wire:model.live="product.sub_category_id">
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
                <x-input wire:model="product.price" step="0.01" class="w-full" type="number" placeholder="Ingresar precio"></x-input>
            </div>
        </div>
        <div class="flex justify-end mt-4">
            <x-button>Crear Producto</x-button>
        </div>
    </form>

</div>
