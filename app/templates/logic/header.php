<?php

global $user, $header;

// theme
$header['theme'] = 'light';
$header['floating'] = false;
$header['sticky'] = false;
$header['mobile-threshold'] = 768;

/*
* Elements
*	- Navigation:
*		desktop-navigation: desktop navigation bar
*		mobile-icon: the burger icon to open the mobile menu
*	- Branding
*		logo: the svg or webp logo
*		name: the name of the website
*	- Profile
*		profile-icon: the icon that redirects to he user's profile
*		profile-link: the button that redirects to he user's profile
*	- Ecommerce
*		cart-icon: the cart icon
*	- Search
*		search-icon: inline search icon with expanding search bar
*		search-bar: extended search bar
*		simple-search-icon: search icon with dropdown search bar
*	- Languages
*		language-icon: language switcher with dropdown
*/
$header['structure'] = [
	'left' => ['simple-search-icon',],
	'center' => ['desktop-navigation',],
	'right' => ['profile-icon', 'cart-icon'],
	'mobile-left' => ['simple-search-icon',],
	'mobile-center' => [],
	'mobile-right' => ['profile-icon', 'cart-icon', 'mobile-icon',],
	'hanging-content' => [],
];

/*
* Elements settings
*/
$header['title'] = sys_config('name');
$header['title-mobile'] = $header['title'];
$header['login-link'] = [
	'not-logged' => [
		'label' => 'Login',
		'url' => client_url('/login'),
	],
	'logged' => [
		'label' => $user->username,
		'url' => client_url('/profile')
	],
];;

/*
* Links
*	filters: mobile, logged, admin, manager
*/
$header['links'] = [
	['label' => 'Home', 'location' => 'home', 'url' => client_url('/')],
	['label' => 'Le Fragranze', 'location' => 'shop', 'url' => client_url('/shop')],
	['label' => 'Chi Siamo', 'location' => 'about-us', 'url' => client_url('/about-us')],
	['label' => 'Recensioni', 'location' => 'reviews', 'url' => client_url('/reviews')],
	['label' => 'Blog', 'location' => 'blog', 'url' => client_url('/blog')],
	['label' => 'Contatti', 'location' => 'contacts', 'url' => client_url('/contacts')],
	['label' => 'Gestione', 'location' => 'admin', 'url' => client_url('/admin'), 'admin' => true]
];

// dropdowns
/*$header['dropdowns']['*dropdown-name*'] = [
	['Title', client_url('/link')],
];*/

// load components
include_once('-expands-header/components.php');
