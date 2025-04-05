<?php

use Ecommerce\Product;

$giftCard = false;

// setup
$product = new Product(View::get('productId'));

View::setTitle($product->name)
	->setDescription($product->description)
	->setThumbnail($product->clientImage);

// related products
$relatedProducts = $product->relatedProducts;

// third party integrations
$pixelEnabled = DB::find('value FROM config WHERE name="facebook_pixel"');

// questions
/*
if (ecommerce_config('product-faq')) {
	$generalFaqs = (array) DB::select('question, answer FROM faqs ORDER BY question ASC')->res;
	$specificFaqs = (array) DB::select('question, answer FROM products_faqs WHERE productId=? ORDER BY question ASC', [$product->id])->res;

	$faqs = array_filter(array_merge($specificFaqs, $generalFaqs));
}
*/
/*
* Post a reviews
*/
/*

// reviews
$reviews = DB::select('id, IF(userId = ?, 1, 0) as userMade FROM ecommerce_reviews WHERE productId=? ORDER BY userMade DESC, time DESC', [$user->id, $product->id]);
$reviewed = logged() && DB::exists('ecommerce_reviews WHERE userId=? AND productId=?', [$user->id, $product->id]);
$boughtproduct = logged() && DB::exists('ecommerce_orders WHERE productId=? AND customerId=? AND cartId IN (SELECT id FROM ecommerce_carts WHERE status>1)', [$product->id, $customer->id]);

if (isset($_POST['post-review'])) {
	DB::add('ecommerce_reviews (productId, userId, text, score) VALUES (?, ?, ?, ?)', [$product->id, $user->id, $_POST['review-text'], $_POST['review-score']]);

	redirect('#reviews');
}

if (isset($_POST['delete-review'])) {
	DB::delete('ecommerce_reviews WHERE productId=? AND userId=?', [$product->id, $user->id]);

	redirect('#reviews');
}
*/

/*
* Gift card
*/
/*
if (isset($_POST['add-to-cart'])) {

	global $con;

	// setup variables
	$quantity = $_POST['quantity'] ?? 1;
	$price = $_POST['gift-price'];

	$data = [
		'productId' => $product->id,
		'price' => $price,
		'quantity' => $quantity,
		'variation' => false,
	];

	// add order
	Ecommerce\Order::add($data);

	$orderId = DB::find('id FROM ecommerce_orders WHERE customerId=? ORDER BY id DESC', [$user->id]);

	// store gift card information
	DB::add('ecommerce_giftcards (orderId, customerId, forOthers, email, name, text, price)', [$orderId, $user->id, $_POST['gift-type'], $_POST['gift-email'], $_POST['gift-name'], $_POST['gift-text'], $price]);

	redirect('/cart');
}

$giftCard = $product->id == 61;
$existsGiftCard = false;
if ($giftCard) $existsGiftCard = DB::exists('ecommerce_orders WHERE productId=? AND cartId IN (SELECT id FROM ecommerce_carts WHERE status=0 AND customerId=?)', [61, $user->id]);
*/
