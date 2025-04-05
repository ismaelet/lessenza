<?php

$action = $_GET['action'] ?? null;
$error = false;

// structure
$loginConfig = [
	'welcome-text' => false,
	'stay-connected' => true,
	'password-recovery' => true,
	'register' => true,
];

// login
if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$remember = isset($_POST['remember']);
	$url = $_POST['url'] ?? false;

	$error = standard_login($username, $password, $url, $remember);
}
