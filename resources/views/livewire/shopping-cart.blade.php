<div>
    <div class="grid grid-cols-1 lg:grid-cols-7 gap-6">
        <div class="lg:col-span-5">
            <div class="flex justify-between mb-2">
                <h1 class="text-lg">
                    Carrito de compras ({{Cart::count()}} Productos)
                </h1>
                <button class="font-semibold text-gray-600 underline hover:no-underline"
                    wire:click="destroy()">
                    Limpiar Carro
                </button>
            </div>

            <div class="card">
                <ul class="space-y-4">
                    @forelse (Cart::content() as $item)
                        <li class="lg:flex items-center">
                            <img class="w-full lg:w-36 aspect-square object-cover object-center mr-5" src="{{$item->options->image}}" alt="">
                            <div class="w-80">
                                <p class="text-sm">
                                    <a href="{{route('products.show',$item->id)}}">
                                        {{$item->name}}
                                    </a>
                                </p>
                                <button class="bg-red-100 hover:bg-red-200 text-red-800 text-xs font-semibold rounded px-2.5 py-0.5"
                                    wire:click="remove('{{$item->rowId}}')">
                                    <i class="fa-solid fa-xmark"></i>
                                    Quitar
                                </button>
                            </div>
                            <p class="mr-3">
                                S/.{{$item->price}}
                            </p>
                            <div class="ml-auto space-x-3">
                                <button class="btn btn-gray"
                                wire:click="decrease('{{$item->rowId}}')">
                                    -
                                </button>
                                <span class="inline-block w-2 text-center">
                                    {{$item->qty}}
                                </span>
                                <button class="btn btn-gray"
                                    wire:click="increase('{{$item->rowId}}')">
                                    +
                                </button>
                            </div>
                        </li>
                        @empty
                        <p class="text-center">
                            No hay productos en el carrito
                        </p>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="card">
                <div class="flex justify-between mb-2">
                    <p>
                        Total:
                    </p>
                    <p>
                        S/. {{Cart::subtotal()}}
                    </p>
                </div>
                <a href="" class="btn btn-brown block w-full text-center">
                    Continuar compra
                </a>
            </div>
        </div>
    </div>
</div>
