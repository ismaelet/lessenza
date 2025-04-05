<?php

use Ecommerce\Product\Type;

global $ecommerceConfig;

$ecommerceConfig = [
	/*
	* General settings
	*/
	'currency' => 'EUR',
	'paypal-user' => 'paypal@account.com',
	'dynamic-product-price' => true,

	/*
	* Functionalities
	*/
	'whishlist' => false,
	'cart-status-emails' => true,
	'tracking-emails' => true,

	/*
	* Carts and orders settings
	*/
	'cart-statuses' => [
		'-1' => ['canceled', 'Cancellato', 'close'],
		'0' => ['open', 'Non completato', 'pause'],
		'1' => ['waiting-payment', 'In attesa del pagamento', 'waiting'],
		'2' => ['confirmed-payment', 'Pagamento confermato', 'correct'],
		'3' => ['shipped', 'Spedito', 'shipping'],
		'4' => ['delivered', 'Consegnato', 'delivered'],
	],

	/*
	* Layout
	*/
	// Product card
	'product-card' => [
		'functionalities' => false,
		'description' => false,
	],

	// Product page
	'product-page' => [
		'availability' => true,
		'installments' => false,
		'reviews' => false,
		'faq' => false,
	],

	// Shop page
	'shop-page' => [
		'sticky-sidebar' => true,
		'price-range' => false,
		'sale-filter' => false,
		'filters' => [
			[
				'title' => 'Collezioni',
				'slug' => 'typeId',
				'opened-by-default' => true,
				'list' => rows_to_objects(DB::select(Type::INDEX . ' FROM ' . Type::TABLE . ' ORDER BY names ASC, name ASC'), 'Ecommerce\Product\Type'),
			],
		],
	],

	// Cart pages
	'cart-page' => [
		'steps' => [
			1 => ['Spedizione', 'address'],
			2 => ['Confermato', 'confirmation'],
		],
		'header-background' => true,
		'flow-bar' => false,
		'gift-option' => false,
		'coupon-option' => false,
	],
];
