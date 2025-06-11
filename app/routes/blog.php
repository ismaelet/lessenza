<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Blog index
Route::get('/blog', [PostController::class, 'index'])
	->name('posts.index');

// Blog post
Route::get('/blog/{post}', [PostController::class, 'show'])
	->name('posts.show');
