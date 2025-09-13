<?php

return [

	/*
    |--------------------------------------------------------------------------
    | Meta Data
    |--------------------------------------------------------------------------
    |
    |
    */

	'meta_data' => [
		'full_name' => env('APP_FULL_NAME', ''),
		'description' => env('APP_DESCRIPTION', 'Scopri le nostre essenze professionali per SPA, sauna, bagno turco, docce emozionali.'),
		'short_description' => env('APP_SHORT_DESCRIPTION', 'Essenze professionali per SPA, sauna, bagno turco, docce emozionali'),
		'default_color_scheme' => env('APP_DEFAULT_COLOR_SCHEME', 'light'),
	],

	/*
    |--------------------------------------------------------------------------
    | Header navigation Links
    |--------------------------------------------------------------------------
	|	
    |
    */

	'navigation' => [
		'header' => [
			['label' => 'Home', 'route' => 'home', 'main_route' => 'home'],
		],

		'footer' => [
			['label' => 'Home', 'route' => 'home', 'main_route' => 'home'],
		],
	],

	/*
    |--------------------------------------------------------------------------
    | Footer navigation Links
    |--------------------------------------------------------------------------
	|	
    | The footer navigation links are used to generate the footer navigation
	| Footer Navigation Interface: [
		'column_name':string =>
	|		[
	|			'label' => string,
	|			'url' => string,
	|			'social_media' => ?string,
	|			'icon' => ?boolean,
	| 		]
	|	...
	| ]
    |
    */

	/*
    |--------------------------------------------------------------------------
    | Contacts
    |--------------------------------------------------------------------------
    */

	'contacts' => [
		'phone' => ['url' => 'tel:3487852808', 'label' => '348 7852808', 'title' => 'Tel.'],
		'email' => ['url' => 'mailto:commerciale@lessenza.net', 'label' => 'commerciale@lessenza.net', 'title' => 'E-mail'],
		'instagram' => ['url' => 'https://www.instagram.com/lessenza80/', 'label' => '@lessenza80', 'title' => 'Instagram'],
		'facebook' => ['url' => 'https://www.facebook.com/lessenza.net/', 'label' => '@lessenza.net', 'title' => 'Facebook'],
	],

	/*
    |--------------------------------------------------------------------------
    | Order Status
    |--------------------------------------------------------------------------
    */
	'order_statuses' => [
		'-1' => [
			'tag' => 'canceled',
			'label' => 'Cancellato',
			'icon' => 'close',
			'color' => 'red'
		],
		'0' => [
			'tag' => 'open',
			'label' => 'Non completato',
			'icon' => 'pause',
			'color' => 'gray'
		],
		'1' => [
			'tag' => 'waiting-payment',
			'label' => 'In attesa del pagamento',
			'icon' => 'hourglass',
			'color' => 'sky'
		],
		'2' => [
			'tag' => 'confirmed-payment',
			'label' => 'Pagamento confermato',
			'icon' => 'correct',
			'color' => 'green'
		],
		'3' => [
			'tag' => 'shipped',
			'label' => 'Spedito',
			'icon' => 'shipping',
			'color' => 'amber'
		],
		'4' => [
			'tag' => 'delivered',
			'label' => 'Consegnato',
			'icon' => 'delivered',
			'color' => 'orange'
		],
	],
];
