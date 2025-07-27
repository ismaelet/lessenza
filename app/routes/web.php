<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Artisan;
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

// Contacts
Route::get('/contacts', [ContactsController::class, 'index'])
	->name('contacts');

// Include the shop routes
include __DIR__ . '/shop.php';

// Include the shop routes
include __DIR__ . '/blog.php';

// Include the auth routes
include __DIR__ . '/auth.php';

// Include the user dashboard routes
include __DIR__ . '/user-dashboard.php';
