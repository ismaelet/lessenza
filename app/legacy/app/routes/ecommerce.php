<?php

use Ecommerce\Cart;
use Ecommerce\Product;

use function Ecommerce\cart;
use function Ecommerce\customerId;
use function Ecommerce\ecommerce_config;
use function Ecommerce\order_count;

// Shop
Legacy\System\Classes\Route::add('/shop', function () {
	\Legacy\System\Classes\View::setPage('shop')
		->setTemplate('shop')
		->show();
});

// Product
Legacy\System\Classes\Route::add('/' . __('products') . '/*', function ($path) {
	$fullProductName = explode(__('products') . '/', $path)[1] ?? null;
	$productId = explode('-', $fullProductName)[0] ?? null;

	if (!$productId || !\Legacy\System\Classes\DB::exists(Product::TABLE . ' WHERE ' . Product::INDEX . ' = ?', [$productId])) {
		redirect_legacy('/shop');
	}

	\Legacy\System\Classes\View::setPage('product')
		->set('productId', $productId)
		->show();
});

// Wishlist
Legacy\System\Classes\Route::add('/wishlist', function () {
	\Legacy\System\Classes\View::setPage('wishlist')
		->show();
});

// Cart
Legacy\System\Classes\Route::add('/cart', function () {
	// car steps
	$cartSteps = ecommerce_config('cart-page')['steps'];
	$currentStep = $_GET['step'] ?? 1;
	$currentStep = in_array($currentStep, array_keys($cartSteps)) ? $currentStep : 1;

	// middlewares
	if (!order_count()) {
		redirect_legacy('/cart/empty');
	}

	if (cart()->step < $currentStep) {
		redirect_legacy('/cart?step=' . cart()->step);
	}

	// render view
	\Legacy\System\Classes\View::setPage('cart/' . $cartSteps[$currentStep][1])
		->setTemplate('cart')
		->set('currentStep', $currentStep)
		->show();
});

Legacy\System\Classes\Route::add('/cart/empty', function () {
	if (cart()->quantity) {
		redirect_legacy('/cart');
	}

	\Legacy\System\Classes\View::setPage('cart/empty')
		->setTitle('Carrello Vuoto')
		->show();
});

/*
* Payments
*/
// PayPal
Legacy\System\Classes\Route::add('/payment/paypal', function () {
	global $customer;
	global $cart;

	// setup cart
	$cartId = $_GET['id'] ?? null;

	if (!$cartId) {
		$cartId = \Legacy\System\Classes\DB::find('id FROM ecommerce_carts WHERE customerId=? AND status=1 AND processed=0 ORDER BY id DESC', [$customer->id]);
	}

	$cart = new Cart($cartId);

	if (!$cart->id) redirect_legacy('/cart/empty');
	else if (!$cart->status) redirect_legacy('/cart');
	else if ($cart->status != 1 || $cart->payment->slug != 'paypal') redirect_legacy('/order/completed?id=' . $cart->id);
	else {
		$_SESSION['trying-to-pay'] = $cart->id;
	}

	\Legacy\System\Classes\View::setPage('cart/payments/paypal')
		->setTemplate('void')
		->show();
});

// Bank Transfer
Legacy\System\Classes\Route::add('/payment/bank-transfer', function () {
	global $customer;
	global $cart;

	// setup cart
	$cartId = $_GET['id'] ?? null;

	if (!$cartId) {
		$cartId = \Legacy\System\Classes\DB::find('id FROM ecommerce_carts WHERE customerId=? AND status=1 AND processed=0 ORDER BY id DESC', [$customer->id]);
	}

	$cart = new Cart($cartId);

	if (!$cart->id) redirect_legacy('/cart/empty');
	else if (!$cart->status) redirect_legacy('/cart');
	else if ($cart->status != 1 || $cart->payment->slug != 'bank-transfer') redirect_legacy('/order/completed?id=' . $cart->id);
	else {
		$_SESSION['trying-to-pay'] = $cart->id;
	}

	\Legacy\System\Classes\View::setPage('cart/payments/bank-transfer')
		->show();
});

// Success
Legacy\System\Classes\Route::add('/success', function () {
	\Legacy\System\Classes\View::setPage('order/success')
		->setTemplate('void')
		->show();
});

// Completed order
Legacy\System\Classes\Route::add('/order', function () {
	$cartId = $_GET['id'] ?? null;
	$customerId = $_GET['customerId'] ?? customerId();

	// setup cart
	$cartId = \Legacy\System\Classes\DB::exists(Cart::TABLE . ' WHERE ' . cart::INDEX . ' = ? AND ' . Cart::CUSTOMER_INDEX . ' = ?', [$cartId, $customerId]) ? $cartId : null;

	if (!$cartId) {
		redirect_legacy('/shop');
	} else {
		$cart = new Cart($cartId);

		if (!$cart->statusId) {
			redirect_legacy('/cart');
		}
	}

	\Legacy\System\Classes\View::setPage('order/completed')
		->set('cart', $cart)
		->setTitle('Ordine ' . $cart->idCode)
		->show();
});

// Profile
Legacy\System\Classes\Route::add('/profile/*', function ($path) {
	$page = ltrim(explode('profile', $path)[1], '/') ?: 'recap';

	\Legacy\System\Classes\View::setPage('profile/' . $page)
		->addMiddlewares(['logged'])
		->setTemplate('profile')
		->setTitle('Profilo')
		->show();
});

// Address
Legacy\System\Classes\Route::add('/address/edit', function () {
	\Legacy\System\Classes\View::setPage('address')
		->setTitle('Modifica Indirizzo')
		->addMiddlewares(['logged'])
		->setTemplate('form')
		->show();
});

// Wishlist
Legacy\System\Classes\Route::add('/wishlist', function () {
	\Legacy\System\Classes\View::setPage('wishlist')
		->show();
});

// Listeners
Legacy\System\Classes\Route::add('/listener/paypal', function () {
	include_once(SERVER_ROOT . '/listeners/paypal.php');
});
