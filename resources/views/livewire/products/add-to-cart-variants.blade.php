<div class="md:py-[3rem]">
    <x-container>
        <div class="card">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <figure>
                        <img src="{{$this->variant->image}}" class="aspect-[1/1] w-full object-cover object-center" alt="">
                    </figure>
                </div>
                <div class="col-span-1">
                    <h1 class="text-xl text-gray-600 mb-2">
                        {{$product->name}}
                    </h1>
                    <div class="flex items-center space-x-2 mb-4">
                        <ul class="flex space-x-1 text-sm">
                            <li>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                                <i class="fa-solid fa-star text-yellow-400"></i>
                            </li>
                        </ul>
                        <p class="text-sm text-gray-700">4.7 (55)</p>
                    </div>
                    <p class="font-semibold text-2xl text-gray-600 mb-4">
                        S/.{{$product->price}}
                    </p>
                    <div class="flex space-x-6 items-center mb-4"
                        x-data="{
                            qty: @entangle('qty'),
                        }">
                        <button x-on:click="qty--" x-bind:disabled="qty <= 1" class="btn btn-gray">
                            -
                        </button>
                        <span x-text="qty" class="inline-block w-2 text-center">
                            
                        </span>
                        <button x-on:click="qty++" class="btn btn-gray">
                            +
                        </button>
                    </div>

                    <div class="flex flex-wrap">
                        @foreach ($product->options as $option)
                            <div class="mr-4 mb-4">
                                <p class="font-semibold text-lg mb-2">
                                    {{$option->name}}
                                </p>
                                <ul class="flex items-center space-x-4">
                                    @foreach ($option->pivot->features as $feature)
                                        <li>
                                            @switch($option->type)
                                                @case(1)
                                                    <button class="w-20 h-8 font-semibold uppercase text-sm rounded-lg {{$selectedFeatures[$option->id] == $feature['id'] ? 'bg-[#996946] text-white' : 'border border-gray-200 text-gray-700'}} "
                                                            wire:click="set('selectedFeatures.{{$option->id}}', '{{$feature['id']}}')">
                                                        {{$feature['value']}}
                                                    </button>
                                                    @break
                                                @case(2)
                                                    <div class="p-0.5 border-2 rounded-lg flex items-center -mt-1.5 {{$selectedFeatures[$option->id] == $feature['id'] ? 'bg-[#996946] text-white' : 'border-transparent'}}"
                                                        wire:click="set('selectedFeatures.{{$option->id}}', '{{$feature['id']}}')">
                                                        <button class="w-20 h-8 rounded-lg border border-gray-200" 
                                                        style="background-color: {{$feature['value']}}"></button>
                                                    </div>
                                                    @break
                                                @default
                                                    
                                            @endswitch
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                    <button class="btn btn-brown w-full mb-4"
                        wire:click="add_to_card"
                        wire:loading.attr="disabled">
                        Agregar a carrito
                    </button>


                    <div class="text-sm mb-4">
                        {{$product->descripcion}}
                    </div>
                    <div class="text-gray-700 flex items-center space-x-4">
                        <i class="fa-solid fa-truck-fast text-2xl"></i>
                        <p>Despacho a domicilio</p>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</div>
