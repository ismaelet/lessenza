<?php

use Blog\Post;
use ViewManager\Admin;

$id = View::get('id');
$post = new Post($id);

/*
* Page configuration
*/
// $pageConfig['confirm'] = $pageConfig['confirm'] ?? null;

/*
* Query configuration
*/
$queryConfig['table'] = Post::TABLE;
$queryConfig['index-field'] = Post::INDEX;
$queryConfig['title-field'] = 'title';

/*
* Form fields
*/
$inputs = [
	[
		['type' => 'lbl', 'text' => 'Titolo'],
		['name' => 'title', 'text' => 'Title', 'required' => true,],
	],
	[
		['type' => 'lbl', 'text' => 'Testo'],
		['type' => 'textarea', 'name' => 'text', 'text' => 'Testo', 'required' => true,],
	],
	[
		['type' => 'lbl', 'text' => 'Immagine'],
		['type' => 'image', 'name' => 'image', 'client-path' => $post->id && $post->hasImage ? $post->clientImage : null],
	],
];

/*
* Form handling
*/
$uploadFunction = function ($inputs, $id) {
	if ($_FILES['image']['name']) {
		$post = new Post($id);

		$fileData = [
			'url' => $post->serverImage,
			'size' => 1920,
			'name' => 'image',
			'mode' => 'width',
		];

		upload_image($fileData);
	}
};

Admin::setAdditionalFormAddFunction($uploadFunction)
	->setAdditionalFormUpdateFunction($uploadFunction);
