<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //Relacion una a muchos inversa
    public function family(){
        return $this->belongsTo(Family::class);
    }

    //Relacion uno a muchos
    public function subcategories(){
        return $this->hasMany(SubCategory::class);
    }
}
