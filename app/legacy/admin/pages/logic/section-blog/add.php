<?php

use Blog\Post;
use ViewManager\Admin;

$id = View::get('id');
$post = new Post($id);
$video = $post?->video_url;

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
		['type' => 'lbl', 'text' => 'URL del video su YouTube (opzionale)'],
		['name' => 'video_url', 'text' => 'URL del video su YouTube',],
	],
	[
		['type' => 'lbl', 'text' => 'Immagine'],
		['type' => 'image', 'name' => 'image', 'client-path' => $post->id && $post->hasImage ? $post->clientImage : null],
	],
];

/*
* Form handling
*/
$uploadFunction = function ($inputs, $id) use ($video) {
	// Save or remove video
	$post = new Post($id);

	if ($video && $video != $_POST['video_url']) {
		DB::delete('videos WHERE url = ?', [$video]);
	}

	if ($_POST['video_url'] && !DB::exists('videos WHERE url = ?', [$_POST['video_url']])) {
		DB::add('videos (url)', [$_POST['video_url']]);
	}

	// Upload file
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
