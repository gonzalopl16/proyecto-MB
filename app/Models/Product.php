<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
        'sku',
        'name',
        'descripcion',
        'image_path',
        'price',
        'stock',
        'sub_category_id'
    ];

    protected function image():Attribute{
        return Attribute::make(
            get: fn()=> Storage::url($this->image_path),
        );
    }

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
                    ->using(OptionProduct::class)
                    ->withPivot('features')
                    ->withTimestamps();
    }
}
