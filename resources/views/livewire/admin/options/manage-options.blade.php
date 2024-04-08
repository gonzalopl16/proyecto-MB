<div>

    <section class="rounded-lg bg-white shadow-lg">
        <header class="border-b border-gray-200 px-6 py-2">
            <div class="flex justify-between">
                <h1 class="text-lg font-semibold text-gray-700">
                    Opciones
                </h1>

                <x-button wire:click="set('newOption.openModal', true)">
                    Nuevo
                </x-button>
            </div>
        </header>

        <div class="p-6">

            <div class="space-y-6">

                @foreach ($options as $option)
                    <div class="p-6 rounded-lg border border-gray-200 relative" 
                    wire:key="option-{{$option->id}}">

                        <div class="absolute -top-3 px-4 bg-white">
                            <button class="mr-1" onclick="confirmDelete({{$option->id}},'option')">
                                <i class="fa-solid fa-trash-can hover:text-red-600"></i>
                            </button>
                            <span>
                                {{ $option->name }}
                            </span>
                        </div>

                        {{-- valores --}}
                        <div class="flex flex-wrap">
                            @foreach ($option->features as $feature)
                                @switch($option->type)
                                    @case(1)
                                        {{-- texto --}}
                                        <span
                                            class="bg-gray-100 text-gray-800 text-sm font-medium me-2 pl-2.5 pr-1.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">
                                            {{ $feature->descripcion }}
                                            <button class="ml-0.5" onclick="confirmDelete({{$feature->id}}, 'feature')">
                                                <i class="fa-solid fa-xmark hover:text-red-700 hover:cursor-pointer"></i>
                                            </button>
                                        </span>
                                    @break

                                    @case(2)
                                        {{-- color --}}
                                        <div class="relative">
                                            <span class="inline-block h-6 w-6 shadow-lg rounded-full border-2 border-gray-300 mr-4"
                                                style="background-color: {{ $feature->value }}">
                                            </span>
                                            <button class="absolute z-10 left-3 -top-2 rounded-full bg-red-500 hover:bg-red-700 h-4 w-4 flex justify-center items-center"
                                                {{-- wire:click="deleteFeature({{$feature->id}})" --}}
                                                onclick="confirmDelete({{$feature->id}}, 'feature')">
                                                <i class="fa-solid fa-xmark text-white hover:cursor-pointer"></i>
                                            </button>
                                        </div>
                                    @break

                                    @default
                                @endswitch
                            @endforeach
                        </div>

                        <div>
                            @livewire('admin.options.add-new-feature', compact('option'), key('add-new-feature-'.$option->id))
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section>

    <x-dialog-modal wire:model="newOption.openModal">

        <x-slot name="title">
            Crear Nueva Opción
        </x-slot>
        <x-slot name="content">
            <x-validation-errors class="mb-4"></x-validation-errors>
            <div class="grid grid-cols-2 gap-6 mb-4">
                <div>
                    <x-label class="mb-1">Nombre</x-label>
                    <x-input wire:model="newOption.name" class="w-full"
                        placeholder="Ingrese Nombre de Opción"></x-input>
                </div>

                <div>
                    <x-label class="mb-1">Tipo</x-label>
                    <x-select wire:model.live="newOption.type" class="w-full">
                        <option value="1">Texto</option>
                        <option value="2">Color</option>
                    </x-select>
                </div>
            </div>

            <div class="flex items-center mb-4">
                <hr class="flex-1">

                <span class="mx-4">
                    Valores
                </span>

                <hr class="flex-1">
            </div>

            <div class="mb-4 space-y-4">
                @foreach ($newOption->features as $index => $feature)
                    <div wire:key="features-{{$index}}" class="p-6 rounded-lg border border-gray-200 relative">

                        <div class="absolute -top-3 px-4 bg-white">
                            <button wire:click="removeFeature({{$index}})">
                                <i class="fa-solid fa-trash-can text-red-500 hover:text-red-700"></i>
                            </button>
                        </div>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <x-label class="mb-1">Valor</x-label>
                                
                                    @switch($newOption->type)
                                        @case(1)
                                            <x-input wire:model="newOption.features.{{ $index }}.value" class="w-full"
                                            placeholder="Ingrese el Valor de la Opción"></x-input>
                                            @break
                                        @case(2)
                                            <div class="border border-gray-300 rounded-md flex items-center justify-between px-3 h-[42px]">

                                                {{$newOption->features[$index]['value'] ?: 'Selecione un color'}}
                                                <input type="color"
                                                wire:model.live="newOption.features.{{ $index }}.value">
                                            </div>
                                            @break
                                        @default
                                            
                                    @endswitch
                            </div>

                            <div>
                                <x-label class="mb-1">Descripción</x-label>
                                <x-input wire:model="newOption.features.{{ $index }}.descripcion" class="w-full"
                                    placeholder="Ingrese una descripción"></x-input>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            <div class="flex justify-end">

                <x-button wire:click="addFeature"> 
                    Agregar Valor
                </x-button>

            </div>
        </x-slot>
        <x-slot name="footer">
            <button class="btn-alternative" wire:click="addOption">
                Agregar
            </button>
        </x-slot>
    </x-dialog-modal>

    @push('js')
        <script>
            function confirmDelete(id,type) {
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
                        switch(type){
                        case 'feature':
                            @this.call('deleteFeature',id);
                        break;
                        case 'option':
                            @this.call('deleteOption',id);
                        break;
                        // default:
                        // @this.call('deleteFeature',id); 
                        // break;
                    }
                    }
                });
            }
        </script>
    @endpush
</div>
