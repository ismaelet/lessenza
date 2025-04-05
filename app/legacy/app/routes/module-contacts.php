<?php

// home
Route::add('/contacts', function () {
	View::setPage('contacts')
		->setTitle(__('Contacts'))
		->show();
});
