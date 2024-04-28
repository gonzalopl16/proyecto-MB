<div class="pt-[4rem]">
    <x-container>
        <div class="card">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="col-span-1">
                    <figure class="">
                        <img src="{{$product->image}}" class="aspect-[1/1] w-full object-cover object-center" alt="">
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
