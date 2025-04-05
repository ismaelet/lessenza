<?php

// reviews
Route::add('/reviews', function () {
	View::setPage('reviews')
		->setTitle('Recensioni')
		->show();
});
