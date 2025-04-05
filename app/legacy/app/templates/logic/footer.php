<?php

global $header;

$footer = [];

// Links
$footer['links'] = $header['links'];

// Contacts
$footer['contacts'] = [
	['slug' => 'instagram', 'link' => sys_config('contact-instagram-link')],
	['slug' => 'facebook', 'link' => sys_config('contact-facebook-link')],
	['slug' => 'phone', 'link' => sys_config('contact-phone-link')],
	['slug' => 'email', 'link' => sys_config('contact-email-link')],
];

// Notes
$footer['notes'] = '
	P.IVA ' . sys_config('VAT') . ' | Copyright © ' . getdate()['year'] . ' ' . sys_config('full-name') . '<br>
	Web designer: <a class="" href="mailto:ismaele.tuffanelli@gmail.com">Ismaele Tuffanelli</a>
';
