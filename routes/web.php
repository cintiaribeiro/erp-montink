<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::controller(ProductController::class)->prefix('product')->group(function () {
    Route::get('/', 'index')->name('products.index');
    Route::get('/create', 'create')->name('products.create');
    Route::post('/', 'store')->name('products.store');
    Route::get('/{product}', 'show')->name('products.show');
    Route::get('/{product}/edit', 'edit')->name('products.edit');
    Route::put('/{product}/update', 'update')->name('products.update');
    Route::delete('/{product}', 'destroy')->name('products.destroy');
});

