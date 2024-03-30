<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use App\Models\Product;
use App\Models\SubCategory;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ProductCreate extends Component
{

    use WithFileUploads;
    public $families;
    public $family_id = '';
    public $category_id='';
    public $image;
    public $product =[
        'sku' => '',
        'name' => '',
        'descripcion' => '',
        'image_path' => '',
        'price' => '',
        'sub_category_id' => '',
    ];

    public function mount(){
        $this->families = Family::all();
    }

    public function boot(){
        $this->withValidator(function($validator){
            if($validator->fails()){
                $this->dispatch('swal',[
                    'icon' => 'error',
                    'title' => 'Error',
                    'text' => 'El formulario contiene errores'
                ]);
            }
        });
    }

    public function updatedFamilyId(){
        $this->category_id = '';
        $this->product['sub_category_id'] = '';
    }

    public function updatedCategoryId(){
        $this->product['sub_category_id'] = '';
    }

    #[Computed()]
    public function categories(){
        return Category::where('family_id',$this->family_id)->get();
    }

    #[Computed()]
    public function subcategories(){
        return SubCategory::where('category_id',$this->category_id)->get();
    }

    public function store(){
        $this->validate([
            'image' => 'required|image|max:1024',
            'product.sku' => 'required|unique:products,sku',
            'product.name' => 'required|max:255',
            'product.descripcion' => 'required',
            'product.price' => '',
            'product.sub_category_id' => 'required|exists:sub_categories,id',
        ],[],[
            'product.sku' => 'codigo',
            'product.name' => 'nombre',
            'product.descripcion' => 'descripción',
            'product.price' => 'precio',
            'product.sub_category_id' => 'subcategoria',
        ]);

        $this->product['image_path'] = $this->image->store('products');

        Product::create($this->product);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Bien hecho',
            'text' => 'Producto creado correctamente'
        ]);

        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.admin.products.product-create');
    }
}
