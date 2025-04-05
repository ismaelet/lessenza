<?php

// home
Legacy\System\Classes\Route::add('/contacts', function () {
	\Legacy\System\Classes\View::setPage('contacts')
		->setTitle(__('Contacts'))
		->show();
});
