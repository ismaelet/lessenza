<?php

// get raw data from POST
$rawPostData = file_get_contents('php://input');

// convert raw data tu array
$rawPostArray = explode('&', $rawPostData);

// separate variabile and value in array
$myPost = array();

foreach ($rawPostArray as $keyval) {
	$keyval = explode('=', $keyval);
	if (count($keyval) == 2) $myPost[$keyval[0]] = urldecode($keyval[1]);
}

$req = 'cmd=_notify-validate';

foreach ($myPost as $key => $value) {
	$value = urlencode($value);
	$req .= "&$key=$value";
}

// notify PayPal that the notification has been received
$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

if (!($res = curl_exec($ch))) {
	curl_close($ch);
	exit;
}

curl_close($ch);

// process the transaction
if ($res == 'VERIFIED') {

	// get status and mail
	$status = $_POST['payment_status'];

	if ($status == 'Completed') {

		// get payment data
		$cartId = $_POST['custom'] ?? false;

		if ($cartId) {
			// register the payment
			include_once('shared.php');
		} else {
			// log errors
			error_log('Paypal Error - POST data: ' . print_r($_POST, true));
		}
	}
}
