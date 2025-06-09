<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [HomeController::class, 'index'])
	->name('home');

// Include the shop routes
include __DIR__ . '/shop.php';
