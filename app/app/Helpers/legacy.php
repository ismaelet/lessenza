<?php

use App\Legacy\Ecommerce\Customer;
use App\Legacy\User;
use Illuminate\Support\Facades\Vite;

global $customer, $user, $con;

function sys_config($field) {
	$sysConfig = [
		// general settings
		'migrate' => true,
		'static' => false,
		'timezone' => 'Europe/Rome',
		'logged-redirect' => '/profile',
		'domain' => 'developing.ismaeletuffanelli.com',

		// e-mail
		'email-host' => 'authsmtp.securemail.pro',
		'email-username' => 'no-reply@lessenza.net',
		'email-passsword' => 'd*96KFZBsgMQULu',

		// name
		'name' => 'L\'Essenza',
		'full-name' => 'L\'Essenza S.r.l.s',
		'description' => 'Scopri le nostre essenze professionali per SPA, sauna, bagno turco, docce emozionali. ',
		'short-description' => 'Scopri le nostre essenze professionali per SPA, sauna, bagno turco, docce emozionali. ',

		// language
		'languages' => [
			'it' => 'Italiano',
			// 'en' => 'English',
			// 'de' => 'Deutsch',
			// 'pt' => 'Português',
			// 'es' => 'Español',
		],
		'default-language' => 'it',

		// logo
		'logo' => '/app/assets/logo/logo.png',

		// business data
		'VAT' => '02555680228',

		// contacts
		'contact-facebook' => '@lessenza.net',
		'contact-facebook-link' => 'https://www.facebook.com/lessenza.net',
		'contact-instagram' => '@lessenza80',
		'contact-instagram-link' => 'https://www.instagram.com/lessenza80/',
		'contact-youtube-link' => '',
		'contact-spotify' => '',
		'contact-twitter' => '',
		'contact-twitter-link' => '',
		'contact-email' => 'commerciale@lessenza.net',
		'contact-email-link' => 'mailto:commerciale@lessenza.net',
		'contact-phone' => '3487852808',
		'contact-phone-link' => 'tel:3487852808',
		'contact-whatsapp' => '',
		'contact-whatsapp-link' => '',
		'contact-telegram-link' => '',
		'contact-pinterest' => '',
		'contact-pinterest-link' => '',
		'contact-tiktok' => '',
		'contact-tiktok-link' => '',
		'contact-web-link' => '',

		// theme
		'theme-color' => 'light',

		'hostname' => env('DB_HOST'),
		'database' => env('DB_DATABASE'),
		'username' => env('DB_USERNAME'),
		'password' => env('DB_PASSWORD'),
	];;

	return $sysConfig[$field] ?? null;
}

function client_url(string $parcialUrl = '') {
	return $parcialUrl;
}

function customer() {
	global $customer;

	return $customer ?: initializeCustomer();
}

function user() {
	global $user;

	return $user ?: initializeUser();
}

function userId() {
	return user()->id;
}

function connection() {
	global $con;

	return $con ?: initializeConnection();
}

function background_image($img) {
	return 'style="background-image: url(' . Vite::image($img) . ');"';
}

function client_path(string $file = '') {
	$url = asset('' . file_time(generate_base_url($file)));
	return $url;
}

function generate_base_url(string $file = '') {
	if (!strpos($file, '.')) {
		$file .= '.webp';
	}

	if ($file[0] == '/') {
		$url = $file;
	} else {
		$url = 'images/' . $file;
	}

	return $url;
}

function file_time($file) {
	if (!strpos($file, '?=') && file_exists($url = base_path() . '/legacy' . $file)) $file .= '?=' . filemtime($url);

	return $file;
}

function initializeCustomer() {
	global $customer;

	$customerId = userId() ?: $_SESSION['customerId'] ?? null;

	return $customer = new Customer($customerId);
}

function initializeUser() {
	global $user;

	if (!isset($_SESSION['userId']) && isset($_COOKIE['auth_token'])) {
		login_direct($_COOKIE['auth_token']);
	}

	$userId = $_SESSION['userId'] ?? 0;
	return $user = new User($userId);
}

function initializeConnection() {

	try {
		$con = new mysqli(sys_config('hostname'), sys_config('username'), sys_config('password'), sys_config('database'));
		$con->query('SET NAMES utf8');
	} catch (Exception $e) {
		$error = $e->getMessage();

		dd('Connection error: ' . $error);
	}

	return $con;
}
