<?php

namespace App\Livewire;

use App\Models\Option;
use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Filter extends Component
{
    use WithPagination;

    public $subcategory_id;

    public $category_id;

    public $family_id;

    public $options;

    public $selected_features = [];

    public $orderBy = 1;

    public $search;

    public function mount(){
        $this->options = Option::verifyFamily($this->family_id)
        ->verifyCategory($this->category_id)
        ->verifySubcategory($this->subcategory_id)
        ->get()->toArray();;
        
    }

    #[On('search')]
    public function search($search){
        $this->search = $search;
    }

    public function render()
    {
        $products= Product::verifyFamily($this->family_id)
        ->verifyCategory($this->category_id)
        ->verifySubcategory($this->subcategory_id)
        ->customOrder($this->orderBy)
        ->SelectFeatures($this->selected_features)
        ->when($this->search,function($query){
            $query->where('name','like','%'.$this->search.'%');
        })
        ->paginate(12);
        return view('livewire.filter',compact('products'));
    }
}
