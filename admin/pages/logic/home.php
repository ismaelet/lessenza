<?php

use Blog\Post;
use Ecommerce\Cart;
use Ecommerce\Product;

$orderCount = DB::count(Cart::TABLE);
$productCount = DB::count(Product::TABLE);
$postCount = DB::count(Post::TABLE);
$reviewCount = DB::count(Review::TABLE);
$usersCount = DB::count(User::TABLE);

$panels = [
	[
		'slug' => 'orders',
		'title' => 'Ordini',
		'info' => '<span class="fw-bold">' . $orderCount . '</span> ordini ricevuti',
		'primary-button' => [
			'label' => 'Lista degli ordini',
			'link' => client_url('/orders/list'),
		],
	],
	[
		'slug' => 'products',
		'title' => 'Prodotti',
		'info' => '<span class="fw-bold">' . $productCount . '</span> prodotti in catalogo',
		'primary-button' => [
			'label' => 'Aggiungi un prodotto',
			'link' => client_url('/products/add'),
		],
		'secondary-button' => [
			'label' => 'Lista dei prodotti',
			'link' => client_url('/products/list'),
		],
	],
	[
		'slug' => 'blog',
		'title' => 'Blog',
		'info' => '<span class="fw-bold">' . $postCount . '</span> post pubblicati',
		'primary-button' => [
			'label' => 'Aggiungi un post',
			'link' => client_url('/blog/add'),
		],
		'secondary-button' => [
			'label' => 'Lista dei post',
			'link' => client_url('/blog/list'),
		],
	],
	[
		'slug' => 'reviews',
		'title' => 'Recensioni',
		'info' => '<span class="fw-bold">' . $reviewCount . '</span> recensioni pubblicate',
		'primary-button' => [
			'label' => 'Aggiungi una recensione',
			'link' => client_url('/reviews/add'),
		],
		'secondary-button' => [
			'label' => 'Lista delle recensioni',
			'link' => client_url('/reviews/list'),
		],
	],
	[
		'slug' => 'users',
		'title' => 'Clienti',
		'info' => '<span class="fw-bold">' . $usersCount . '</span> clienti aggiunti',
		'primary-button' => [
			'label' => 'Aggiungi un cliente',
			'link' => client_url('/users/add'),
		],
		'secondary-button' => [
			'label' => 'Lista dei clienti',
			'link' => client_url('/users/list'),
		],
	],
];
