<?php

global $customer;

$address = new Ecommerce\Address(\Legacy\System\Classes\DB::find('id FROM ecommerce_addresses WHERE customerId=? ORDER BY id DESC', [$customer->id]));

$inputs = [
	[
		['type' => 'lbl', 'text' => 'Nominativo'],
		['name' => 'fullName', 'text' => 'Nominativo di spedizione', 'value' => $address->fullName ?? '', 'size' => 4, 'required' => true],
	],
	[
		['type' => 'lbl', 'text' => 'Indirizzo'],
		['name' => 'address', 'text' => 'Indirizzo', 'value' => $address->address ?? '', 'size' => 3, 'required' => true],
		['name' => 'number', 'text' => 'Numero civico', 'value' => $address->number ?? '', 'size' => 1, 'required' => true],
		['name' => 'city', 'text' => 'Città', 'value' => $address->city ?? '', 'size' => 4, 'required' => true],
		['name' => 'zip', 'text' => 'CAP', 'maxlength' => 5, 'value' => $address->zip ?? '', 'size' => 2, 'required' => true],
		['name' => 'region', 'text' => 'Provincia', 'maxlength' => 2, 'value' => $address->region ?? '', 'size' => 2, 'required' => true],
	],
	[
		['type' => 'lbl', 'text' => 'Contatti'],
		['name' => 'email', 'text' => 'Email', 'value' => $address->email ?? '', 'required' => true],
		['name' => 'phone', 'text' => 'Numero di telefono', 'value' => $address->phone ?? '', 'required' => true],
	]
];

if (isset($_POST['submit'])) {
	query_from_inputs('ecommerce_addresses', $inputs, $address->id);
	redirect_legacy('/profile');
}
