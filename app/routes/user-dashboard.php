<?php

use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::prefix('/profile')->name('user-dashboard.')->middleware('auth')->group(function () {
    // User dashboard index
    Route::get('/', [UserDashboardController::class, 'index'])
        ->name('index');

    // User dashboard orders
    Route::get('/orders', [UserDashboardController::class, 'orders'])
        ->name('orders');

    // User dashboard settings
    Route::get('/settings', [UserDashboardController::class, 'settings'])
        ->name('settings');

    Route::post('/settings', [UserDashboardController::class, 'updateSettings'])
        ->name('settings.update');

    Route::post('/settings/password', [UserDashboardController::class, 'updatePassword'])
        ->name('settings.password.update');
});
