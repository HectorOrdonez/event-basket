<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('products/store', \App\Http\Controllers\ProductsController::class . '@store')->name('products.store');
