<?php

// reviews
Legacy\System\Classes\Route::add('/reviews', function () {
	\Legacy\System\Classes\View::setPage('reviews')
		->setTitle('Recensioni')
		->show();
});
