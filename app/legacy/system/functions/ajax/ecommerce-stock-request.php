<?php

$email = $_GET['email'];
$itemId = $_GET['itemId'];
$item = new Product($itemId);

$mailContent = "
	<h1 style='font-size: 32px; font-weight: 700;'>Richiesta di un prodotto esaurito</h1>
	<p style='margin-top: 32px; font-size: 16px;'>Un cliente (indirizzo email: <a href='mailto:" . $email . "'>" . $email . "</a>) ha richiesto di essere avvisato quando il prodotto <strong>" . $item->name . "</strong> sarà nuovamente disponibile.</p>
";

$mailBody = Email::prepareBody($mailContent);

// setup mail config
$mailData = [
	'debugger' => false,
	'from-address' => sys_config('mail-username'),
	'from-name' => sys_config('name'),
	'to' => sys_config('cont-email'),
	'subject' => 'Richiesta di un prodotto esaurito',
	'text' => $mailBody,
];

// send mail
Email::send($mailData);
