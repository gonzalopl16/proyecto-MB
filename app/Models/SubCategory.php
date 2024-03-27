<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    //Relacion uno a muchos inversa
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //Realacion uno a muchos
    public function products(){
        return $this->hasMany(Product::class);
    }
}
