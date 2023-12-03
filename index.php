<?php

define('DEBUG', false);

ini_set('error_log', 'logs/error.log');

if (DEBUG || in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
	ini_set('display_errors', '1');
	ini_set('display_startup_errors', '1');
	error_reporting(E_ALL ^ E_DEPRECATED);
}

require_once('system/setup/setup.php');
