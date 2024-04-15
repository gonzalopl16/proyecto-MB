<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class MainSubcategoryController extends Controller
{
    public function show(SubCategory $subcategory){
        return view('subcategories.show',compact('subcategory'));
    }
}
