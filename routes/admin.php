<?php

use App\Http\Controllers\FamilyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('families', FamilyController::class);

