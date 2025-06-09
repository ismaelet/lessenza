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
		// 'instagram' => ['url' => 'https://www.instagram.com/tag/', 'label' => '@tag',],
		// 'facebook' => ['url' => 'https://www.facebook.com/tag/', 'label' => '@tag',],
		// 'email' => ['url' => 'mailto:mail@mail.com', 'label' => 'mail@mail.com',],
		// 'whatsapp' => ['url' => 'https://wa.me/000000000', 'label' => '000 000000',],
		// 'phone' => ['url' => 'tel:0000 000000', 'label' => '0000 000000',],
	],
];
