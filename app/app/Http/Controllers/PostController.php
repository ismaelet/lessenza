<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display the post page
     */
    public function index(): View
    {
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
    public function show(Post $post): View
    {
        return view('posts.show', [
            'title' => $post->title,
            'location' => 'blog',
            'post' => $post,
        ]);
    }
}
