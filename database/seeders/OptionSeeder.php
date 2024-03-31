<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            [
                'name' => 'Talla',
                'type' => 1,
                'features' => [
                    [
                        'value' => 's',
                        'descripcion' => 'small'
                    ],
                    [
                        'value' => 'm',
                        'descripcion' => 'medium'
                    ],
                    [
                        'value' => 'l',
                        'descripcion' => 'large'
                    ],
                    [
                        'value' => 'xl',
                        'descripcion' => 'extra large'
                    ]
                ]
            ],[
                'name' => 'Color',
                'type' => 2,
                'features' => [
                    [
                        'value' => '#000000',
                        'descripcion' => 'black'
                    ],
                    [
                        'value' => '#ffffff',
                        'descripcion' => 'white'
                    ],
                    [
                        'value' => '#ff0000',
                        'descripcion' => 'green'
                    ],
                    [
                        'value' => '#0000ff',
                        'descripcion' => 'blue'
                    ]
                ]
            ],[
                'name' => 'Sexo',
                'type' => 1,
                'features' => [
                    [
                        'value' => 'm',
                        'descripcion' => 'masculino'
                    ],
                    [
                        'value' => 'f',
                        'descripcion' => 'femenino'
                    ],
                ]
            ]
        ];

        foreach($options as $option){
            $optionModel = Option::create([
                'name' => $option['name'],
                'type' => $option['type'],
            ]);
            foreach($option['features'] as $feature){
                $optionModel->features()->create([
                    'value' => $feature['value'],
                    'descripcion' => $feature['descripcion']
                ]);

            }
        }
    }
}
