<div class="bg-white py-12">
    <x-container class="px-4 md:flex">
        @if (count($options))       
        <aside class="md:w-52 md:flex-shrink-0 md:mr-8 mb-8 md:mb-0">
            <ul class="space-y-4">
                @foreach ($options as $option)
                    <li x-data="{
                        open: true
                    }">
                        <button class="px-4 py-2 bg-gray-200 w-full text-left text-gray-700 flex justify-between items-center"
                        x-on:click="open = !open">
                            {{$option['name']}}
                            <i class="fa-solid fa-angle-down"
                            x-bind:class="{
                                'fa-angle-down' : open,
                                'fa-angle-up' :!open
                            }"></i>
                        </button>
                        <ul class="mt-2 space-y-2" x-show="open">
                            @foreach ($option['features'] as $feature)
                                <li>
                                    <label class="inline-flex items-center">
                                        <x-checkbox value="{{$feature['id']}}" class="mr-2"
                                                    wire:model.live="selected_features"></x-checkbox>
                                        {{$feature['descripcion']}}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </aside>
        @endif
        <div class="md:flex-1">
            <div class="flex items-center">
                <span class="mr-2">
                    Ordenar por:
                </span>
                <x-select
                    wire:model.live="orderBy">
                    <option value="1">
                        Relevancia
                    </option>
                    <option value="2">
                        Precio: Mayor a menor
                    </option>
                    <option value="3">
                        Precio: Menor a mayor
                    </option>
                </x-select>
            </div>
            <hr class="my-4">
            <div class="grid grid-cols-1 sm:grid_cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 pb-[5rem]">
                @foreach ($products as $key => $product)
                    <article class="bg-white shadow rounded overflow-hidden">
                        <img src="{{$product->image}}"  class="w-full h-48 object-cover object-center" alt="">
                        <div class="p-4">
                            <h1 class="text-lg font-bold text-gray-700 line-clamp-2 min-h-[56px] mb-2">
                                {{$product->name}}
                            </h1>
                            <p class="text-gray-600 mb-4">
                                S/.{{$product->price}}
                            </p>
                            <a href="{{route('products.show',$product)}}" class="btn btn-brown block w-full text-center">
                                ver más
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="mt-8">
                {{$products->links()}}
            </div>
        </div>
    </x-container>
</div>
