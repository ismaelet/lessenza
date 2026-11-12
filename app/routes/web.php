<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TechnologiesController;
use App\Http\Controllers\VideoController;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// Technologies
Route::get('/technologies', [TechnologiesController::class, 'index'])
    ->name('technologies');

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
Route::post('/contacts', [ContactsController::class, 'store'])
    ->name('contacts.store');

// Terms and Conditions
Route::get('/terms', function () {
    return view('terms');
})->name('terms');

// Include the shop routes
include __DIR__.'/shop.php';

// Include the shop routes
include __DIR__.'/blog.php';

// Include the auth routes
include __DIR__.'/auth.php';

// Include the user dashboard routes
include __DIR__.'/user-dashboard.php';

Route::get('/genlink', function () {
    $link = public_path('storage');
    $target = storage_path('app/public');

    $filesystem = new Filesystem;

    try {
        if ($filesystem->exists($link)) {
            echo "Link already exists: {$link}";
        } else {
            $filesystem->link($target, $link);
            echo "Symlink created: {$link} → {$target}";
        }
    } catch (Exception $e) {
        echo 'Error: '.$e->getMessage();
    }
});
