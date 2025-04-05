<?php

// login
Route::add('/login', function () {
	View::setPage('access/login')
		->setTitle('Login')
		->setMiddlewares(['not-logged'])
		->show();
});

// logout
Route::add('/logout', function () {
	View::setPage('access/logout')
		->setTitle('Logout')
		->setTemplate('form')
		->setMiddlewares(['logged'])
		->show();
});

// register
Route::add('/register', function () {
	View::setPage('access/register')
		->setTitle(__('Register'))
		->setMiddlewares(['not-logged'])
		->show();
});

// offline page
Route::add('/offline', function () {
	View::setPage('errors/offline')
		->setTitle('Offline')
		->setTemplate('void')
		->setMiddlewares(['not-public'])
		->show();
});

// recover
Route::add('/recover', function () {
	View::setPage('access/recover')
		->setTitle('Recupera i dati di accesso')
		->setTemplate('form')
		->setMiddlewares(['not-logged'])
		->show();
});

// reset
Route::add('/reset', function () {
	$userId = $_GET['id'] ?? false;
	$security = $_GET['security'] ?? false;

	if (!DB::exists('user_resets WHERE userId=? AND security=?', [$userId, $security])) redirect('/recover');

	View::setPage('access/reset')
		->setTitle('Reimposta la password')
		->setTemplate('form')
		->setMiddlewares(['not-logged'])
		->show();
});
