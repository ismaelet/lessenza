<?php

$header['theme'] = 'dark';
$header['floating'] = true;

$debug = false;
$sent = false;
$error = false;

$websiteName = 'L<span class="fc-primary fw-medium">\'</span>Essenza<span class="fc-primary">.</span>';

// contacts
$contacts = [
	'phone' => 'Tel.',
	'email' => 'E-mail',
	'instagram' => 'Instagram',
	'facebook' => 'Facebook',
];

// send mail
if (isset($_POST['submit']) && !$sent) {
	// sender data
	$name = trim($_POST['name']);
	$text = trim($_POST['text']);
	$senderEmail = strtolower(trim($_POST['email']));

	$senderEmailDomain = explode('@', $senderEmail)[1] ?? false;
	$senderEmailDomain = explode('.', $senderEmailDomain)[0] ?? false;

	// if (!in_array($serv, ['tiscali', 'gmail', 'libero', 'yahoo', 'hotmail', 'icloud', 'outlook'])) $error = 'email-bad';
	// else if (preg_match("/(sexy|bitcoin|wellness|dollars|free|business)/i", $msg)) $error = 'word-bad';
	if (!$error) {
		$content = 'Sei stato contattato da ' . $name . ' (<a href="mailto:' . $senderEmail . '">' . $senderEmail . '</a>). Testo:<br><br>"' . $text . '"';

		$content = Email::prepareBody($content);

		$emailData = [
			'debug' => $debug,
			'reply-address' => $senderEmail,
			'reply-name' => $name,
			'to' => $debug ? 'ismaele.tuffanelli@gmail.com' : sys_config('contact-email'),
			'subject' => 'Contatto tramite sito web',
			'text' => $content,
		];

		Email::send($emailData);

		$sent = true;
	}
}
