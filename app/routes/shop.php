<?php

use Illuminate\Support\Facades\Route;

// Shop
Route::get('/shop', [ShopController::class, 'index'])
	->name('shop');

// Product
Route::get('/products/{product:slug}', [ProductController::class, 'show'])
	->name('product.show');
