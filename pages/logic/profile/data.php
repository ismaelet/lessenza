<?php

global $user;

$error = $_GET['error'] ?? false;
$done = $_GET['done'] ?? false;

$dataInputs = [
	[
		['type' => 'done', 'text' => 'Dati aggiornati'],
		/*['type' => 'lbl', 'text' => 'Username'],
		['text' => 'Usuário', 'name' => 'username', 'size' => 2, 'value' => $user->username ?: '', 'minlength' => 6, 'required' => true],
		['type' => 'error', 'error' => 'existing-username', 'text' => 'L\'username scelto è già in uso'],*/
	],
	[
		['type' => 'lbl', 'text' => 'Nome completo'],
		['text' => 'Nome', 'name' => 'firstName', 'size' => 2, 'value' => $user->firstName ?: '', 'minlength' => 2, 'required' => true],
		['text' => 'Cognome', 'name' => 'lastName', 'size' => 2, 'value' => $user->lastName ?: '', 'minlength' => 2, 'required' => true],
	],
	[
		['type' => 'lbl', 'text' => 'Indirizzo email'],
		['type' => 'email', 'text' => 'Indirizzo email', 'name' => 'email', 'value' => $user->email ?: '', 'required' => true],
		['type' => 'error', 'error' => 'existing-mail', 'text' => 'L\'indirizzo email scelto è già in uso'],
	],
];

$passwordInputs = [
	[
		['type' => 'lbl', 'text' => 'Password vecchia'],
		['type' => 'password', 'text' => 'Password vecchia', 'name' => 'old-password', 'size' => 2, 'required' => true],
		['type' => 'error', 'error' => 'wrong-password', 'text' => 'Password vecchia sbagliata'],
	],
	[
		['type' => 'lbl', 'text' => 'Nuova password'],
		['type' => 'password', 'text' => 'Nuova password', 'name' => 'new-password', 'size' => 2, 'minlength' => 6, 'required' => true],
		['type' => 'password', 'text' => 'Confermare la password', 'name' => 'password-confirmation', 'size' => 2, 'minlength' => 6, 'required' => true],
		['type' => 'error', 'error' => 'password-not-matching', 'text' => 'Le password inserite non corrispondono'],
	],
];

/*
* Form
*/
if (isset($_POST['edit-data'])) {
	$email = $_POST['email'];

	if (DB::exists('users WHERE email = ? AND id <> ?', [$mail, $user->id])) {
		$error = 'existing-mail';
	} else {
		query_from_inputs('users', $dataInputs, $user->id);
		redirect('?done=1#user-data');
	}

	redirect('?error=' . $error . '#user-data');
}

if (isset($_POST['edit-password'])) {
	$dbPassword = DB::find('password FROM users WHERE id=?', [$user->id]);
	$oldPassword = $_POST['old-password'];
	$newPassword = $_POST['new-password'];
	$passwordConfirmation = $_POST['password-confirmation'];

	if (!password_verify($oldPassword, $dbPassword)) $error = 'wrong-password';
	else if ($newPassword != $passwordConfirmation) $error = 'password-not-matching';
	else {
		$newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
		DB::update('users SET password=? WHERE id=?', [$newPassword, $user->id]);
		redirect('?done=1#user-data');
	}

	redirect('?error=' . $error . '#password-edit');
}
