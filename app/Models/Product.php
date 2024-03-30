<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
        'sku',
        'name',
        'descripcion',
        'image_path',
        'price',
        'sub_category_id'
    ];

    //Relacion uno a muchos inversa
    public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }

    //Relacion uno a muchos
    public function variants(){
        return $this->hasMany(Variant::class);
    }

    //Relacion muchos a muchos
    public function options(){
        return $this->belongsToMany(Option::class)
                    ->withPivot('value')
                    ->withTimestamps();
    }
}
