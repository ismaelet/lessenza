<?php

// login
Legacy\System\Classes\Route::add('/login', function () {
	\Legacy\System\Classes\View::setPage('access/login')
		->setTitle('Login')
		->setMiddlewares(['not-logged'])
		->show();
});

// logout
Legacy\System\Classes\Route::add('/logout', function () {
	\Legacy\System\Classes\View::setPage('access/logout')
		->setTitle('Logout')
		->setTemplate('form')
		->setMiddlewares(['logged'])
		->show();
});

// register
Legacy\System\Classes\Route::add('/register', function () {
	\Legacy\System\Classes\View::setPage('access/register')
		->setTitle(__('Register'))
		->setMiddlewares(['not-logged'])
		->show();
});

// offline page
Legacy\System\Classes\Route::add('/offline', function () {
	\Legacy\System\Classes\View::setPage('errors/offline')
		->setTitle('Offline')
		->setTemplate('void')
		->setMiddlewares(['not-public'])
		->show();
});

// recover
Legacy\System\Classes\Route::add('/recover', function () {
	\Legacy\System\Classes\View::setPage('access/recover')
		->setTitle('Recupera i dati di accesso')
		->setTemplate('form')
		->setMiddlewares(['not-logged'])
		->show();
});

// reset
Legacy\System\Classes\Route::add('/reset', function () {
	$userId = $_GET['id'] ?? false;
	$security = $_GET['security'] ?? false;

	if (!\Legacy\System\Classes\DB::exists('user_resets WHERE userId=? AND security=?', [$userId, $security])) redirect_legacy('/recover');

	\Legacy\System\Classes\View::setPage('access/reset')
		->setTitle('Reimposta la password')
		->setTemplate('form')
		->setMiddlewares(['not-logged'])
		->show();
});
