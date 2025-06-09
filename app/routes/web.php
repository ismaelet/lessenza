<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [HomeController::class, 'index'])
	->name('home');

// About us
Route::get('/about-us', [AboutUsController::class, 'index'])
	->name('about-us');

// Videos
Route::get('/videos', [VideoController::class, 'index'])
	->name('videos');

// Reviews
Route::get('/reviews', [ReviewContoller::class, 'index'])
	->name('reviews');

// Include the shop routes
include __DIR__ . '/shop.php';
