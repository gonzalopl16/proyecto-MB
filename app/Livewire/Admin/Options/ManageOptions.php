<?php

namespace App\Livewire\Admin\Options;

use App\Models\Option;
use Livewire\Component;

class ManageOptions extends Component
{

    public $options;

    public $newOption = [
        'name' => '',
        'type' => 1,
        'features' => [
            [
                'value' => '',
                'descripcion' => ''
            ]
        ]
     ];

    public $openModal = false;

    public function mount(){
        $this->options = Option::with('features')->get();
    }

    public function addFeature(){
        $this->newOption['features'][] = [
            'value' => '',
            'descripcion' => ''
        ];
    }

    public function removeFeature($index){
        unset($this->newOption['features'][$index]);
        $this->newOption['features'] = array_values($this->newOption['features']);
    }

    public function addOption(){

        $rules =[
            'newOption.name' => 'required',
            'newOption.type' => 'required|in:1,2',
            'newOption.features' => 'required|array|min:1'
        ];
        foreach($this->newOption['features'] as $index => $feature){
            if($this->newOption['type']==1){
                $rules['newOption.features.'.$index.'.value'] = 'required';
            }else{
                $rules['newOption.features.'.$index.'.value'] = 'required|regex:/^#[a-f0-9]{6}$/i';
            }
            $rules['newOption.features.'.$index.'.descripcion'] = 'required';
        }
        $this->validate($rules);
        $option = Option::create([
            'name' => $this->newOption['name'],
            'type' => $this->newOption['type']
        ]);

        foreach($this->newOption['features'] as $feature){
            $option->features()->create([
                'value'=>$feature['value'],
                'descripcion' => $feature['descripcion']
            ]);
        }
        $this->options = Option::with('features')->get();

        $this->reset('openModal', 'newOption');

        $this->dispatch('swal',[
            'icon' => 'success',
            'title' => 'ejecucion exitosa',
            'text' => 'La opcion se agregó correctamente'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.options.manage-options');
    }
}
