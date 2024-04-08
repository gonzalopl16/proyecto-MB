<?php

namespace App\Livewire\Forms\Admin\Options;

use App\Models\Option;
use Livewire\Attributes\Validate;
use Livewire\Form;

class NewOptionForm extends Form
{
    public $name;
    public $type = 1;
    public $features = [
        [
            'value' => '',
            'descripcion' => ''
        ]
    ];
    public $openModal = false;

    public function rules(){
        
        $rules =[
            'name' => 'required',
            'type' => 'required|in:1,2',
            'features' => 'required|array|min:1'
        ];
        foreach($this->features as $index => $feature){
            if($this->type==1){
                $rules['features.'.$index.'.value'] = 'required';
            }else{
                $rules['features.'.$index.'.value'] = 'required|regex:/^#[a-f0-9]{6}$/i';
            }
            $rules['features.'.$index.'.descripcion'] = 'required';
        }
        return $rules;
    }

    public function validationAttributes(){
        $attributes = [
            'name' => 'nombre',
            'type' => 'tipo',
            'features' => 'valores',
        ];

        foreach($this->features as $index => $feature){
            $attributes['features.'.$index.'.value'] = 'valor '.($index + 1);
            $attributes['features.'.$index.'.descripcion'] = 'descripcion '.($index+1);
        }

        return $attributes;
    }

    public function addFeature(){
        $this->features[] = [
            'value' => '',
            'descripcion' => ''
        ];
    }

    public function removeFeature($index){
        unset($this->features[$index]);
        $this->features = array_values($this->features);
    }

    public function save(){
        $this->validate();
        $option = Option::create([
            'name' => $this->name,
            'type' => $this->type
        ]);

        foreach($this->features as $feature){
            $option->features()->create([
                'value'=>$feature['value'],
                'descripcion' => $feature['descripcion']
            ]);
        }

        $this->reset();
    }

}
