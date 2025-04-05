<?php

use Ecommerce\Order;
use Ecommerce\Product;

$method = $_GET['method'];

switch ($method) {
	case 'add':
		//add an order
		$product = new Product($_GET['productId']);
		$quantity = $_GET['quantity'] ?? 1;
		$variation = $_GET['variation'] ?? false;
		$price = $product->price;
		//$price = !empty($_GET['fixedPrice']) ? $_GET['fixedPrice'] : ($variation ? $product->variations[0]['variants'][$variation][1] : $product->price);

		$data = [
			'productId' => $product->id,
			'price' => $price,
			'quantity' => $quantity,
			//'variation' => $variation,
		];

		Order::add($data);

		break;

	case 'delete':
		// delete an order
		$orderId = $_GET['orderId'];
		$order = new Order($orderId);
		$order->delete();

		break;
}
