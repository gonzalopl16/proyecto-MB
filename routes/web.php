<?php

use App\Http\Controllers\MainCategoryController;
use App\Http\Controllers\MainFamilyController;
use App\Http\Controllers\MainSubcategoryController;
use App\Http\Controllers\WelcomeController;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class,'index'])->name('welcome.index');

Route::get('families/{family}',[MainFamilyController::class, 'show'])->name('families.show');

Route::get('categories/{category}',[MainCategoryController::class, 'show'])->name('categories.show');

Route::get('subcategories/{subcategory}',[MainSubcategoryController::class, 'show'])->name('subcategories.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

