<?php

// style
\Legacy\System\Classes\StyleLoader::add('access/login', 'page');

// setup variables
$error = false;
$pageConfig = [
	'username' => false,
	'fullName' => true,
];

// setup form
$inputs = [];

if ($pageConfig['fullName']) {
	$inputs[] = [
		['type' => 'lbl', 'text' => 'Nome completo'],
		['type' => 'text', 'text' => 'Nome', 'name' => 'firstName', 'required' => true,],
		['type' => 'text', 'text' => 'Cognome', 'name' => 'lastName', 'required' => true,],
	];
}

$inputs[] =
	[
		['type' => 'lbl', 'text' => 'E-mail'],
		['type' => 'email', 'text' => 'Indirizzo e-mail', 'name' => 'email', 'maxlength' => 50, 'required' => true,],
		['type' => 'error', 'error' => 'email-exists', 'text' => __('Email address already associated with another account'),],
	];

$inputs[] =
	[
		['type' => 'lbl', 'text' => __('Password'),],
		['type' => 'password', 'text' => __('Password'), 'name' => 'password', 'maxlength' => 20, 'required' => true,],
		['type' => 'error', 'error' => 'password-too-short', 'text' => __('The chosen password is too short, it has to be at least 6 characters long'),],
		['type' => 'password', 'text' => __('Confirm password'), 'name' => 'password-confirmation', 'ignore' => true, 'maxlength' => 20, 'required' => true,],
		['type' => 'error', 'error' => 'password-match', 'text' => __('The chosen passwords do not match'),],
	];

// submit
if (isset($_POST['submit'])) {
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$passwordConfirmation = $_POST['password-confirmation'];

	// check for errors
	switch (true) {
		case \Legacy\System\Classes\DB::exists('users WHERE email = ?', [$email]):
			$error = 'email-exists';
			break;

		case strlen($password) < 6:
			$error = 'password-too-short';
			break;

		case $password != $passwordConfirmation:
			$error = 'password-match';
			break;

		default:
			query_from_inputs(User::TABLE, $inputs);

			standard_login($email, $password);
	}
}
