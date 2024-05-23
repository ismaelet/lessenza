<?php

use Ecommerce\Cart;
use Ecommerce\Product;

use function Ecommerce\cart;
use function Ecommerce\customerId;
use function Ecommerce\ecommerce_config;
use function Ecommerce\order_count;

// Shop
Route::add('/shop', function () {
	View::setPage('shop')
		->setTemplate('shop')
		->show();
});

// Product
Route::add('/' . __('products') . '/*', function ($path) {
	$fullProductName = explode(__('products') . '/', $path)[1] ?? null;
	$productId = explode('-', $fullProductName)[0] ?? null;

	if (!$productId || !DB::exists(Product::TABLE . ' WHERE ' . Product::INDEX . ' = ?', [$productId])) {
		redirect('/shop');
	}

	View::setPage('product')
		->set('productId', $productId)
		->show();
});

// Wishlist
Route::add('/wishlist', function () {
	View::setPage('wishlist')
		->show();
});

// Cart
Route::add('/cart', function () {
	// car steps
	$cartSteps = ecommerce_config('cart-page')['steps'];
	$currentStep = $_GET['step'] ?? 1;
	$currentStep = in_array($currentStep, array_keys($cartSteps)) ? $currentStep : 1;

	// middlewares
	if (!order_count()) {
		redirect('/cart/empty');
	}

	if (cart()->step < $currentStep) {
		redirect('/cart?step=' . cart()->step);
	}

	// render view
	View::setPage('cart/' . $cartSteps[$currentStep][1])
		->setTemplate('cart')
		->set('currentStep', $currentStep)
		->show();
});

Route::add('/cart/empty', function () {
	if (cart()->quantity) {
		redirect('/cart');
	}

	View::setPage('cart/empty')
		->setTitle('Carrello Vuoto')
		->show();
});

/*
* Payments
*/
// PayPal
Route::add('/payment/paypal', function () {
	global $customer;
	global $cart;

	// setup cart
	$cartId = $_GET['id'] ?? null;

	if (!$cartId) {
		$cartId = DB::find('id FROM ecommerce_carts WHERE customerId=? AND status=1 AND processed=0 ORDER BY id DESC', [$customer->id]);
	}

	$cart = new Cart($cartId);

	if (!$cart->id) redirect('/cart/empty');
	else if (!$cart->status) redirect('/cart');
	else if ($cart->status != 1 || $cart->payment->slug != 'paypal') redirect('/order/completed?id=' . $cart->id);
	else {
		$_SESSION['trying-to-pay'] = $cart->id;
	}

	View::setPage('cart/payments/paypal')
		->setTemplate('void')
		->show();
});

// Bank Transfer
Route::add('/payment/bank-transfer', function () {
	global $customer;
	global $cart;

	// setup cart
	$cartId = $_GET['id'] ?? null;

	if (!$cartId) {
		$cartId = DB::find('id FROM ecommerce_carts WHERE customerId=? AND status=1 AND processed=0 ORDER BY id DESC', [$customer->id]);
	}

	$cart = new Cart($cartId);

	if (!$cart->id) redirect('/cart/empty');
	else if (!$cart->status) redirect('/cart');
	else if ($cart->status != 1 || $cart->payment->slug != 'bank-transfer') redirect('/order/completed?id=' . $cart->id);
	else {
		$_SESSION['trying-to-pay'] = $cart->id;
	}

	View::setPage('cart/payments/bank-transfer')
		->show();
});

// Success
Route::add('/success', function () {
	View::setPage('order/success')
		->setTemplate('void')
		->show();
});

// Completed order
Route::add('/order', function () {
	$cartId = $_GET['id'] ?? null;
	$customerId = $_GET['customerId'] ?? customerId();

	// setup cart
	$cartId = DB::exists(Cart::TABLE . ' WHERE ' . cart::INDEX . ' = ? AND ' . Cart::CUSTOMER_INDEX . ' = ?', [$cartId, $customerId]) ? $cartId : null;

	if (!$cartId) {
		redirect('/shop');
	} else {
		$cart = new Cart($cartId);

		if (!$cart->statusId) {
			redirect('/cart');
		}
	}

	View::setPage('order/completed')
		->set('cart', $cart)
		->setTitle('Ordine ' . $cart->idCode)
		->show();
});

// Profile
Route::add('/profile/*', function ($path) {
	$page = ltrim(explode('profile', $path)[1], '/') ?: 'recap';

	View::setPage('profile/' . $page)
		->addMiddlewares(['logged'])
		->setTemplate('profile')
		->setTitle('Profilo')
		->show();
});

// Address
Route::add('/address/edit', function () {
	View::setPage('address')
		->setTitle('Modifica Indirizzo')
		->addMiddlewares(['logged'])
		->setTemplate('form')
		->show();
});

// Wishlist
Route::add('/wishlist', function () {
	View::setPage('wishlist')
		->show();
});

// Listeners
Route::add('/listener/paypal', function () {
	include_once(SERVER_ROOT . '/listeners/paypal.php');
});
