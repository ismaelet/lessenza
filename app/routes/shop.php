<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Middleware\EmptyCart;
use App\Http\Middleware\NotEmptyCart;
use Illuminate\Support\Facades\Route;

// Shop
Route::get('/shop', [ShopController::class, 'index'])
	->name('shop');

// Product
Route::get('/products/{product:slug}', [ProductController::class, 'show'])
	->name('product.show');

// Cart
Route::middleware([NotEmptyCart::class])->group(function () {
	Route::get('/cart', [CartController::class, 'index'])
		->name('cart');

	Route::post('/cart', [CartController::class, 'update'])
		->name('cart.update');
});

Route::get('/cart/email/{cartId}', [CartController::class, 'displayEmail'])
	->name('cart.email');

Route::get('/cart/success', [CartController::class, 'success'])
	->name('cart.success');

Route::get('/cart/empty', [CartController::class, 'empty'])
	->middleware([EmptyCart::class])
	->name('cart.empty');

// Order
Route::get('/orders/{order}', [OrderController::class, 'show'])
	->name('order.show');
