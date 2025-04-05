<?php

AdminSetup::execute();

class AdminSetup {
	// routes
	private static function initializeRoutes() {
		\Legacy\System\Classes\Logic::$dependencies['admin'] = 'void';
		\Legacy\System\Classes\Logic::$dependencies['admin-list'] = 'admin';
		\Legacy\System\Classes\Logic::$dependencies['admin-form'] = 'admin';
		\Legacy\System\Classes\Logic::$dependencies['admin-advanced'] = 'admin';
		\Legacy\System\Classes\Logic::$priorities['admin'] = 60;
		\Legacy\System\Classes\Logic::$priorities['admin-list'] = 200;
		\Legacy\System\Classes\Logic::$priorities['admin-form'] = 200;
		\Legacy\System\Classes\Logic::$priorities['admin-advanced'] = 65;
	}

	private static function initializeFunctions() {
		if (file_exists($file = PUBLIC_SERVER_ROOT . '/app/config/ecommerce-config.php')) require_once($file);
		if (file_exists($file = PUBLIC_SERVER_ROOT . '/app/functions/ecommerce.php')) require_once($file);
	}

	private static function initializeConstants() {
		define('PUBLIC_SERVER_ROOT', explode('/admin', SERVER_ROOT)[0]);
		define('PUBLIC_CLIENT_ROOT',  explode('/admin', CLIENT_ROOT)[0]);
		define('PUBLIC_CLIENT_URL',  explode('/admin', CLIENT_URL)[0]);
	}

	public static function execute() {
		self::initializeRoutes();
		self::initializeConstants();
		self::initializeFunctions();
	}
}
