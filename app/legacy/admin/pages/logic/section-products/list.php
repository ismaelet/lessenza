<?php

use Ecommerce\Product;
use Ecommerce\Product\Type;

/*
* Page configuration
*/
// $pageConfig['add'] = false;
$pageConfig['row-action'] = 'add?id={{' . Product::INDEX . '}}';

/*
* Query configuration
*/
$queryConfig['select'] = [Product::TABLE . '.' . Product::INDEX, Product::TABLE . '.name', Type::TABLE . '.name AS type', Product::TABLE . '.time'];
$queryConfig['from'] =
	Product::TABLE .
	' INNER JOIN ' . Type::TABLE .
	' ON ' . Product::TABLE . '.' . Product::TYPE_INDEX . ' = ' . Type::TABLE . '.' . Type::INDEX;
$queryConfig['table'] = Product::TABLE;
$queryConfig['index'] = Product::INDEX;
$queryConfig['where-search'] = Product::TABLE . "." . Product::INDEX . " = ? OR " . Product::TABLE . ".name LIKE CONCAT('%',?,'%') OR " . Type::TABLE . ".name LIKE CONCAT('%',?,'%')";

// select fields
$fields = [
	['type' => 'image',],
	['title' => 'ID', 'name' => 'id'],
	['title' => 'Nome', 'name' => 'name', 'size' => 3],
	['title' => 'Tipo', 'name' => 'type', 'size' => 2],
	['title' => 'Prezzo', 'name' => 'price',],
	['title' => 'Aggiunto il', 'name' => 'time', 'parse' => 'date-day',],
	//['title' => 'Em destaque', 'name' => 'highlighted', 'type' => 'custom', 'size' => 1],
	['title' => 'Attivo', 'name' => 'status', 'type' => 'boolean-icon', 'size' => 1],

	['type' => 'btn'],
];

$buttons = [
	['type' => 'edit'],
	['type' => 'delete'],
];

function _expand_results(&$entry, $field, $key, $row) {
	$prodcut = new Product($row[Product::INDEX]);

	if ($field['type'] == 'image') {
		$entry['src'] = $prodcut->clientImage;
	}

	if ($field['name'] == 'price') {
		$entry['value'] = $prodcut->priceString;
	}
}
