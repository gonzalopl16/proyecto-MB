<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/posts', function(){
    return 'psts';
})->name('posts');

