<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('families', FamilyController::class);

Route::resource('categories',CategoryController::class);

Route::resource('subcategories',SubcategoryController::class);