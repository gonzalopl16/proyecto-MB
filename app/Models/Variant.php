<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Variant extends Model
{
    use HasFactory;

    protected $fillable =[
        'sku',
        'image_path',
        'stock',
        'product_id'
    ];

    protected function image():Attribute{
        return Attribute::make(
            get: fn() => $this->image_path ? Storage::url($this->image_path) : asset('images/img/no-image.jpeg')
        );
    }

    //Relacion uno a muchos inversa
    public function product(){
        return $this->belongsTo(Product::class);
    }

    //Relacion muchos a muchos
    public function features(){
        return $this->belongsToMany(Feature::class)
                    ->withTimestamps();
    }
}
