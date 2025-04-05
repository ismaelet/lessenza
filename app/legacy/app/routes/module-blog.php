<?php

// blog

use Blog\Post;

Route::add('/blog', function () {
	View::setPage('blog')
		->setTitle('Blog')
		->show();
});

// post
Route::add('/blog/post', function () {
	$postId = $_GET['id'] ?? null;
	$post = new Post($postId);

	if (!$post->id) {
		redirect('/blog');
	}

	View::setPage('blog/post')
		->setTitle($post->title)
		->set('post', $post)
		->show();
});
