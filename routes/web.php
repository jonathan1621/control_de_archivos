<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::resource('archivos', App\Http\Controllers\ArchivoController::class);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
