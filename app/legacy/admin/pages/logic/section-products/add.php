<?php

use Ecommerce\Product;
use Ecommerce\Product\Type;

/**
 * Setup
 */
$productId = \Legacy\System\Classes\View::get('id');
$newProduct = (bool) !$productId;
$product = !$newProduct ? new Product($productId) : null;

/**
 * Form events
 */
if (isset($_POST['submit'])) {
	$productName = trim($_POST['name']);
	$productDescription = trim($_POST['description']);
	$productTypeId = $_POST['typeId'];
	$productStatusId = $_POST['statusId'];
	$productInStock = $_POST['inStock'];
	$productHighlighted = isset($_POST['highlighted']) ? 1 : 0;

	// create the product is it doesn't exist
	if ($newProduct) {
		$productId = \Legacy\System\Classes\DB::add(Product::TABLE . ' ()');
		$product = new Product($productId);
		$productSlug = $product->slug;
	} else {
		$productSlug = trim($_POST['slug']);
	}

	// update the product
	\Legacy\System\Classes\DB::update(
		Product::TABLE . ' SET name = ?, typeId = ?, slug = ?, description = ?, highlighted = ?, inStock = ?, statusId = ? WHERE ' . Product::INDEX . ' = ?',
		[$productName, $productTypeId, $productSlug, $productDescription, $productHighlighted, $productInStock, $productStatusId, $productId]
	);

	// upload the image
	if ($_FILES['image']['name']) {
		$fileData = [
			'url' => $product->serverImage,
			'size' => 1024,
			'name' => 'image',
			'mode' => 'width',
		];

		upload_image($fileData);
	}

	if ($newProduct) {
		redirect_legacy('?id=' . $productId . '&added=1');
	} else {
		redirect_legacy('?id=' . $productId . '&updated=1');
	}
}

/**
 * Page config
 */
$pageConfig = [
	'delete' => true,
	'preview-url' => $newProduct ? null : $product->clientUrl,
];

/**
 * Form inputs
 */
$productInputs = [
	[
		['type' => 'lbl', 'text' => 'Nome'],
		['name' => 'name', 'text' => 'Nome', 'value' => $newProduct ? '' : $product->name, 'required' => true,],
	],
	[
		['type' => 'lbl', 'text' => 'Categoria'],
		[
			'type' => 'select',
			'name' => Product::TYPE_INDEX,
			'text' => 'Categoria',
			'query' => Type::INDEX . ', name FROM ' . Type::TABLE . ' ORDER BY name ASC',
			'field-name' => Type::INDEX,
			'field-show' => 'name',
			'value' => $newProduct ? '' : $product->typeId,
		],
	],
	[
		['type' => 'lbl', 'text' => 'Descrizione'],
		['type' => 'textarea', 'name' => 'description', 'text' => 'Descrizione', 'value' => $newProduct ? '' : $product->description],
	],
];

$imageInputConfig = [
	'name' => 'image',
	'client-path' => !$newProduct && file_exists($product->serverImage) ? $product->clientImage : null,
];

// delete
if (isset($_POST['delete'])) {
	$product->delete();

	redirect_legacy('list');
}

// add an img
if (isset($_POST['upload-image'])) {
	$imageId = $_POST['upload-image'][0];

	redirect_legacy('#gallery');
}

// delete an img
if (isset($_POST['delete-img'])) {

	redirect_legacy('#gallery');
}

// add a promotion
if (isset($_POST['add-promotion'])) {

	redirect_legacy('#promotions');
}

// delete promotion
if (isset($_POST['delete-promotion'])) {

	redirect_legacy('#promotions');
}
