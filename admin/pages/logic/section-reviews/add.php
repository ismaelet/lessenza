<?php

use ViewManager\Admin;

$id = View::get('id');
$review = new Review($id);

/*
* Page configuration
*/
// $pageConfig['confirm'] = $pageConfig['confirm'] ?? null;

/*
* Query configuration
*/
$queryConfig['table'] = Review::TABLE;
$queryConfig['index-field'] = Review::INDEX;
$queryConfig['title-field'] = 'name';

/*
* Form fields
*/
$inputs = [
	[
		['type' => 'lbl', 'text' => 'Nome'],
		['name' => 'name', 'text' => 'Nome', 'required' => true,],
	],
	[
		['type' => 'lbl', 'text' => 'Località'],
		['name' => 'location', 'text' => 'Località'],
	],
	[
		['type' => 'lbl', 'text' => 'Testo'],
		['type' => 'textarea', 'name' => 'text', 'text' => 'Testo', 'required' => true,],
	],
	[
		['type' => 'lbl', 'text' => 'Link al sito web (opzionale)'],
		['name' => 'contactUrl', 'text' => 'Url completo'],
	],
	[
		['type' => 'lbl', 'text' => 'Icona (opzionale)'],
		['type' => 'image', 'name' => 'icon', 'client-path' => $review->id && $review->hasIcon ? $review->clientIcon : null],
	],
	[
		['type' => 'lbl', 'text' => 'Foto di copertina (opzionale)'],
		['type' => 'image', 'name' => 'image', 'client-path' => $review->id && $review->hasImage ? $review->clientImage : null],
	],
];

/*
* Form handling
*/
$uploadFunction = function ($inputs, $id) {
	$review = new Review($id);

	if ($_FILES['icon']['name']) {
		$fileData = [
			'url' => $review->serverIcon,
			'size' => [250, 250],
			'name' => 'icon',
			'mode' => 'crop',
		];

		upload_image($fileData);
	}

	if ($_FILES['image']['name']) {
		$fileData = [
			'url' => $review->serverImage,
			'size' => 800,
			'name' => 'image',
			'mode' => 'width',
		];

		upload_image($fileData);
	}
};

Admin::setAdditionalFormAddFunction($uploadFunction)
	->setAdditionalFormUpdateFunction($uploadFunction);
