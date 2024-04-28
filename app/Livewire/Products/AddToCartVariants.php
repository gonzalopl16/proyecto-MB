<?php

namespace App\Livewire\Products;

use App\Models\Feature;
use App\Models\Product;
use JeleDev\Shoppingcart\Facades\Cart;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AddToCartVariants extends Component
{
    public $product;

    public $qty = 1;

    public $selectedFeatures = [];

    #[Computed]
    public function variant(){
        return $this->product->variants->filter(function($variant){
            return !array_diff($variant->features->pluck('id')->toArray(), $this->selectedFeatures);
        })->first();
    }

    public function add_to_card(){
        Cart::instance('shopping');
        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'options' => [
                'image' => $this->variant->image,
                'sku' => $this->variant->sku,
                'features' => Feature::whereIn('id', $this->selectedFeatures)
                                        ->pluck('descripcion','id')
                                        ->toArray()
            ]
        ]);
        if(auth()->check()){
            Cart::store(auth()->id());
        }
        $this->dispatch('cartUpdated', Cart::count());

        $this->dispatch('swal',[
            'icon' => 'success',
            'title' => 'Bien hecho!',
            'text' => 'El producto se añadió correctamente al carrito'
        ]);
    }

    public function mount(){
        foreach($this->product->options as $option){
            $features = collect($option->pivot->features);
            $this->selectedFeatures[$option->id] = $features->first()['id'];
        }
    }

    public function render()
    {
        return view('livewire.products.add-to-cart-variants');
    }
}
