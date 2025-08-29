<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller {

	/**
	 * Display the post page
	 */
	public function index(): \Illuminate\View\View {
		$posts = Post::latest()->get();

		return view('posts.index', [
			'title' => 'Blog',
			'location' => 'blog',
			'posts' => $posts,
		]);
	}

	/**
	 * Display the specified post
	 */
	public function show(Post $post): \Illuminate\View\View {
		return view('posts.show', [
			'title' => $post->title,
			'location' => 'blog',
			'post' => $post,
		]);
	}
}
