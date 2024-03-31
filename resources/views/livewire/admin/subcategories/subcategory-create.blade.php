<div>
    <form wire:submit="save">
        <div class="card">
            <x-validation-errors class="mb-4"/>

            <div class="mb-4">
                <x-label class="mb-2">Familias</x-label>
                <x-select class="w-full" wire:model.live="subcategory.family_id">

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
                <x-select class="w-full" name="category_id" wire:model.live="subcategory.category_id">
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
                    wire:model="subcategory.name" />
            </div>
            <div>
                <x-button>Guardar</x-button>
            </div>
        </div>
    </form>
</div>