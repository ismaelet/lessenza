<?php

// blog

use Blog\Post;

Legacy\System\Classes\Route::add('/blog', function () {
	\Legacy\System\Classes\View::setPage('blog')
		->setTitle('Blog')
		->show();
});

// post
Legacy\System\Classes\Route::add('/blog/post', function () {
	$postId = $_GET['id'] ?? null;
	$post = new Post($postId);

	if (!$post->id) {
		redirect_legacy('/blog');
	}

	\Legacy\System\Classes\View::setPage('blog/post')
		->setTitle($post->title)
		->set('post', $post)
		->show();
});
