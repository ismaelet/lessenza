<?php

use function Ecommerce\ecommerce_config;

$profileLocation = explode('profile/', \Legacy\System\Classes\View::$name)[1];

//navigation menu
$profileLinks = [
	1 => ['title' => 'Account', 'url' => '/profile', 'location' => 'recap', 'icon' => 'user-circle'],
	2 => ['title' => 'Ordini', 'url' => '/profile/orders', 'location' => 'orders', 'icon' => 'orders'],
	4 => ['title' => 'I miei dati', 'url' => '/profile/data', 'location' => 'data', 'icon' => 'settings'],
	5 => ['title' => 'Logout', 'url' => '/logout', 'location' => 'logout', 'icon' => 'logout'],
];

if (ecommerce_config('whishlist')) {
	$profileLinks[3] = ['title' => 'Wishlist', 'url' => 'wishlist', 'location' => 'wishlist', 'icon' => 'love'];
}

ksort($profileLinks);
