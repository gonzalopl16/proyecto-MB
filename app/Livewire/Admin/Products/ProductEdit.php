<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Family;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;


class ProductEdit extends Component
{
   
    use WithFileUploads;
    public $families;
    public $family_id = '';
    public $subCategory;
    public $category_id='';
    public $image;
    public $product;
    public $productEdit;

    public function mount($product){
        $sub = SubCategory::find($product->sub_category_id);
        $this->productEdit = $product->only('sku', 'name', 'descripcion', 'image_path', 'price','sub_category_id');
        $this->families = Family::all();
        $this->category_id = $sub->category->id;
        $this->family_id = $sub->category->family->id;
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
        $this->productEdit['sub_category_id'] = '';
    }

    public function updatedCategoryId(){
        $this->productEdit['sub_category_id'] = '';
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
            'image' => 'nullable|image|max:1024',
            'productEdit.sku' => 'required|unique:products,sku,'.$this->product->id,
            'productEdit.name' => 'required|max:255',
            'productEdit.descripcion' => 'required',
            'productEdit.price' => '',
            'productEdit.sub_category_id' => 'required|exists:sub_categories,id',
        ],[],[
            'product.sku' => 'codigo',
            'product.name' => 'nombre',
            'product.descripcion' => 'descripción',
            'product.price' => 'precio',
            'product.sub_category_id' => 'subcategoria',
        ]);

        if($this->image){
            Storage::delete($this->productEdit['image_path']);
            $this->productEdit['image_path'] = $this->image->store('products','public');
        }

        $this->product->update($this->productEdit);

        session()->flash('swal',[
            'icon' => 'success',
            'title' => 'Actualizado',
            'text' => 'Producto actualizado correctamente'
        ]);
        return redirect()->route('admin.products.index');
    }

    public function temporaryUrl()
    {
        return 'storage/products/';
    }


    public function render()
    {
        return view('livewire.admin.products.product-edit');
    }
}
