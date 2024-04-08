<div class="mt-4">
    <form wire:submit="addFeature" class="flex space-x-4">
        <div class="flex-1">
            <x-label class="mb-1">Valor</x-label>
                                
            @switch($option->type)
                @case(1)
                    <x-input wire:model="newFeature.value" class="w-full"
                    placeholder="Ingrese el Valor de la Opción"></x-input>
                    @break
                @case(2)
                    <div class="border border-gray-300 rounded-md flex items-center justify-between px-3 h-[42px]">

                        {{$newFeature['value'] ?: 'Selecione un color'}}
                        <input type="color"
                        wire:model.live="newFeature.value">
                    </div>
                    @break
                @default
                    
            @endswitch
        </div>
        <div class="flex-1">
            <x-label class="mb-1">Descripción</x-label>
            <x-input wire:model="newFeature.descripcion" class="w-full"
                placeholder="Ingrese una descripción"></x-input>
        </div>
        <div class="pt-7">
            <x-button
                wire:click="addFeature">
                Agregar
            </x-button>
        </div>
    </form>
</div>
