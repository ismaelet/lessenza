<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [HomeController::class, 'index'])
	->name('home');

// About us
Route::get('/about-us', [AboutUsController::class, 'index'])
	->name('about-us');

// Reviews
Route::get('/reviews', [ReviewController::class, 'index'])
	->name('reviews');

// Videos
Route::get('/videos', [VideoController::class, 'index'])
	->name('videos');

// Include the shop routes
include __DIR__ . '/shop.php';

// Include the shop routes
include __DIR__ . '/blog.php';
