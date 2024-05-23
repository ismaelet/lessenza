<?php

// setup variabiles
$error = false;

// if already logged
if (logged() || isset($_POST['advance'])) {
	advance_cart();
}

// login
if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$remember = isset($_POST['remember']);
	$url = '/cart';

	$error = standard_login($username, $password, $url, $remember);

	if (!$error) advance_cart();
}
