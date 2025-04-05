<?php

// home
Legacy\System\Classes\Route::add('/', function () {
	\Legacy\System\Classes\View::setPage('home')
		->show();
});

// about us
Legacy\System\Classes\Route::add('/videos', function () {
	\Legacy\System\Classes\View::setPage('videos')
		->setTitle('Video')
		->setLocation('videos')
		->show();
});

// about us
Legacy\System\Classes\Route::add('/about-us', function () {
	\Legacy\System\Classes\View::setPage('about-us')
		->setTitle('Chi siamo')
		->show();
});

// 
Legacy\System\Classes\Route::add('/confirmation', function () {
	\Legacy\System\Classes\View::setPage('confirmation')
		->show();
});

// newsletter
Legacy\System\Classes\Route::add('/newsletter', function () {
	\Legacy\System\Classes\View::setPage('newsletter')
		->setTitle('Newsletter')
		->setTemplate('form')
		->show();
});
