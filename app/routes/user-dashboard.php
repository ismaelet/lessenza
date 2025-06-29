<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/profile')->name('user-dashboard.')->middleware('auth')->group(function () {
	Route::get('/', [\App\Http\Controllers\UserDashboardController::class, 'index'])
		->name('user-dashboard.index');

	Route::get('/profile', [\App\Http\Controllers\UserProfileController::class, 'edit'])
		->name('user-dashboard.profile.edit');

	Route::put('/profile', [\App\Http\Controllers\UserProfileController::class, 'update'])
		->name('user-dashboard.profile.update');

	Route::get('/orders', [\App\Http\Controllers\UserOrderController::class, 'index'])
		->name('user-dashboard.orders.index');
});
