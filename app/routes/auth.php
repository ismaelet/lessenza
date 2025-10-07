<?php

use App\Http\Controllers\Auth\RecoverController;
use App\Http\Controllers\Auth\ResetController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

// Login route
Route::get('/login', [LoginController::class, 'index'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [LoginController::class, 'attempt'])
    ->middleware('guest')
    ->name('login.attempt');

// Logout route
Route::get('/logout', [LogoutController::class, 'index'])
    ->middleware('auth')
    ->name('logout');

Route::post('/logout', [LogoutController::class, 'attempt'])
    ->middleware('auth')
    ->name('logout.attempt');

// Register route
Route::get('/register', [LoginController::class, 'register'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [LoginController::class, 'registerAttempt'])
    ->middleware('guest')
    ->name('register.attempt');

Route::get('/recover', [RecoverController::class, 'index'])->name('auth.recover')->middleware('guest');
Route::post('/recover', [RecoverController::class, 'store'])->middleware('guest')->name('auth.recover');

Route::get('/reset', [ResetController::class, 'index'])->name('auth.reset')->middleware('guest');
Route::post('/reset', [ResetController::class, 'update'])->middleware('guest');
