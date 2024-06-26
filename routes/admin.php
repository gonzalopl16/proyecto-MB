<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoverController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/options',[OptionController::class,'index'])->name('option.index');

Route::resource('families', FamilyController::class);

Route::resource('categories',CategoryController::class);

Route::resource('subcategories',SubcategoryController::class);

Route::resource('products', ProductController::class);

Route::get('products/{product}/variants/{variant}',[ProductController::class,'variants'])
    ->name('products.variants')
    ->scopeBindings();

Route::put('products/{product}/variants/{variant}',[ProductController::class,'variantsUpdate'])
    ->name('products.variantUpdate')
    ->scopeBindings(); 

Route::resource('covers', CoverController::class);