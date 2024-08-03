<?php

use Ecommerce\Address;
use Ecommerce\Cart;
use Ecommerce\Customer;
use Ecommerce\Order;
use Ecommerce\Product;

use function Ecommerce\ecommerce_config;

$cartStatuses = ecommerce_config('cart-statuses');
$statusIds = array_keys($cartStatuses);
$defaultCartStatuses = [1, 2, 3, 4];

$selectedCartStatuses = $_GET['filter-status'] ?? $defaultCartStatuses;
$selectedCartStatuses = isset($_GET['empty-filter-status']) ? [] : $selectedCartStatuses;
$selectedCartStatusesSql = implode(',', $selectedCartStatuses);

/*
* Page configuration
*/
$pageConfig['add'] = false;
$pageConfig['row-action'] = 'add?id={{' . Cart::INDEX . '}}';

/*
* Query config
*/
$queryConfig['table'] = Cart::TABLE;
$queryConfig['index'] = Cart::INDEX;
$queryConfig['select'] = [Cart::TABLE . '.' . Cart::INDEX, Cart::TABLE . '.time'];
$queryConfig['from'] =
	Cart::TABLE .
	' LEFT JOIN ' . Customer::TABLE .
	' ON ' . Cart::TABLE . '.' . Cart::CUSTOMER_INDEX . ' = ' . Customer::TABLE . '.' . Customer::INDEX .
	' LEFT JOIN ' . Address::TABLE .
	' ON ' . Address::TABLE . '.' . Address::CUSTOMER_INDEX . ' = ' . Customer::TABLE . '.' . Customer::INDEX;
$queryConfig['where'] = $selectedCartStatuses ? '(statusId IN (' . $selectedCartStatusesSql . '))' : 'statusId = -1000';

// handle search
$queryConfig['where-search'] = "
	(
		" . Cart::TABLE . "." . Cart::INDEX . " = ? OR
		LPAD(" . Cart::TABLE . "." . Cart::INDEX . ", 6, '0') = ? OR
		CONCAT('#', LPAD(" . Cart::TABLE . "." . Cart::INDEX . ", 6, '0')) = ? OR
		LOWER(fullName) LIKE CONCAT('%',?,'%') OR
		" . Cart::TABLE . "." . Cart::INDEX . " IN
			(
				SELECT " . Order::CART_INDEX . " FROM " . Order::TABLE . "
				INNER JOIN " . Product::TABLE . "
				ON " . Order::TABLE . "." . Order::PRODUCT_INDEX . " = " . Product::TABLE . "." . Product::INDEX . "
				WHERE LOWER(name) LIKE CONCAT('%',?,'%')
			)
		)
";

/*
* Fields
*/
$fields = [
	['title' => 'ID'],
	['title' => 'Dati', 'size' => 1],
	['title' => 'Destinatario', 'size' => 1],
	['title' => 'Contatti', 'size' => 1],
	['title' => 'Articoli', 'size' => 1],
	['title' => 'Totale'],
	['title' => 'Stato'],
	['title' => 'Data', 'name' => 'time', 'parse' => 'date-day'],

	['type' => 'btn'],
];

$buttons = [
	['title' => 'Gestisci', 'color' => 'blue', 'url' => 'add?id={{' . Cart::INDEX . '}}'],
	// ['title' => 'Rinvia l\'email', 'color' => 'green', 'name' => 'resend-status-email'],
];

//expand results
function _expand_results(&$entry, $field, $key, $row) {

	$cart = new Cart($row[Cart::INDEX]);

	if ($key == 0) {
		// id
		$entry['value'] = $cart->idCode;
	} else if ($key == 1) {
		$entry['value'] = [];

		if ($cart->shippingMethodId) {
			$entry['value'][] = $cart->shippingMethod->name;
		}

		if ($cart->paymentMethodId) {
			$entry['value'][] = $cart->paymentMethod->name;
		}

		if ($cart->couponId) {
			$entry['value'][] = 'Codice sconto: ' . $cart->coupon->code;
		}

		$entry['value'] = implode('<br>', $entry['value']);
	} else if ($key == 2) {
		// address
		$entry['value'] = $cart->address->id ? $cart->address->fullAddress : '- indirizzo non ancora aggiunto -';
	} else if ($key == 3) {
		// contacts
		$entry['value'] = $cart->address->contactsString;
	} else if ($key == 4) {
		// orders
		if ($cart->quantity) {
			$entry['value'] = '';

			foreach ($cart->orders as $order) {
				$entry['value'] .= $order->name . '<br>';
			}
		} else $entry['value'] = '- Nessun articolo registrato -<br>';
	} else if ($key == 5) {
		// price
		$entry['value'] = $cart->priceString;
	} else if ($key == 6) {
		// status
		$entry['value'] = '<span class="order-status background-status-color--' . $cart->statusCode . '">' . $cart->statusName . '</span>';
	}
}

// resend status email
if (isset($_POST['resend-status-email'])) {
	(new Cart($_POST['ID']))->sendStatusEmail();
}
