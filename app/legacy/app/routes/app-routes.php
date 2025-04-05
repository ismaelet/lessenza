<?php

// home
Route::add('/', function () {
	View::setPage('home')
		->show();
});

// about us
Route::add('/videos', function () {
	View::setPage('videos')
		->setTitle('Video')
		->setLocation('videos')
		->show();
});

// about us
Route::add('/about-us', function () {
	View::setPage('about-us')
		->setTitle('Chi siamo')
		->show();
});

// 
Route::add('/confirmation', function () {
	View::setPage('confirmation')
		->show();
});

// newsletter
Route::add('/newsletter', function () {
	View::setPage('newsletter')
		->setTitle('Newsletter')
		->setTemplate('form')
		->show();
});
