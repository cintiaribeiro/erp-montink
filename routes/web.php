<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::controller(StoreController::class)->group(function () {
    Route::get('/', 'index')->name('stores.index');
    Route::get('/{product}/show', 'show')->name('stores.show');
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

Route::controller(CouponController::class)->prefix('coupon')->group(function () {
   Route::get('/', 'index')->name('coupons.index');
   Route::get('/create', 'create')->name('coupons.create');
   Route::post('/', 'store')->name('coupons.store');
   Route::get('/{coupon}', 'show')->name('coupons.show');
   Route::get('/{coupon}/edit', 'edit')->name('coupons.edit');
   Route::put('/{coupon}/update', 'update')->name('coupons.update');
   Route::delete('/{coupon}', 'destroy')->name('coupons.destroy');
});

Route::controller(CartController::class)->prefix('cart')->group(function () {
    Route::get('/', 'index')->name('carts.index');
});



