<?php

$sent = false;

if (isset($_POST['submit'])) {
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$fullName = $firstName . ' ' . $lastName;
	$email = $_POST['email'];

	if (!\Legacy\System\Classes\DB::exists('newsletter_subscribers WHERE email = ?', [$email])) {
		\Legacy\System\Classes\DB::add('newsletter_subscribers (firstName, lastName, fullName, email)', [$firstName, $lastName, $fullName, $email]);
	}

	$sent = true;
}
