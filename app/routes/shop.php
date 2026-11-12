<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Services\PayPal\PayPalController;
use App\Http\Controllers\ShopController;
use App\Http\Middleware\EmptyCart;
use App\Http\Middleware\NotEmptyCart;
use App\Http\Middleware\UnconfirmedOrder;
use Illuminate\Support\Facades\Route;

// Shop
Route::get('/shop', [ShopController::class, 'index'])
    ->name('shop');

// Product
Route::get('/products/{product:slug}', [ProductController::class, 'show'])
    ->name('product.show');

// Cart
Route::middleware([NotEmptyCart::class])->group(function () {
    Route::get('/cart', [CartController::class, 'addressIndex'])
        ->name('cart');

    Route::post('/cart', [CartController::class, 'addressStore'])
        ->name('cart.address.store');

    Route::get('/cart/payment', [CartController::class, 'paymentIndex'])
        ->name('cart.payment');

    Route::post('/cart/payment', [CartController::class, 'paymentStore'])
        ->name('cart.payment.store');
});

Route::get('/cart/email/{cartId}', [CartController::class, 'displayEmail'])
    ->name('cart.email');

Route::get('/cart/success', [CartController::class, 'success'])
    ->name('cart.success');

Route::get('/cart/empty', [CartController::class, 'empty'])
    ->middleware([EmptyCart::class])
    ->name('cart.empty');

// PayPal
Route::prefix('paypal')->middleware(UnconfirmedOrder::class)->name('paypal.')->group(function () {
    Route::resource('orders', PayPalController::class)->only(['create']);
    Route::get('/orders/{order}/capture', [PayPalController::class, 'capture'])->name('order.capture');
    Route::get('/orders/{order}/cancel', [PayPalController::class, 'cancel'])->name('order.cancel');
});

// Order
Route::get('/orders/{order}', [OrderController::class, 'show'])
    ->name('order.show');
