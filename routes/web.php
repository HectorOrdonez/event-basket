<?php

use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPageController::class . '@index')->name('landing');
Route::get('products', ProductsController::class . '@index')->name('products');
Route::post('products', ProductsController::class . '@store')->name('products.store');
Route::get('products/create', ProductsController::class . '@create')->name('products.create');
Route::get('products/{id}', ProductsController::class . '@show')->name('products.show');

Route::post('products/{id}/add', ProductsController::class . '@add')->name('products.add');
Route::post('products/{id}/ship', ProductsController::class . '@ship')->name('products.ship');
Route::post('products/{id}/sell', ProductsController::class . '@sell')->name('products.sell');
Route::post('products/{id}/adjust', ProductsController::class . '@adjust')->name('products.adjust');

