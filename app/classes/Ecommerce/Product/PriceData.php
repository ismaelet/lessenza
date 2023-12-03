<?php

namespace Ecommerce\Product;

use Structure\DynamicProperties;

use function Ecommerce\format_price;

class PriceData {

	use DynamicProperties;

	private $productId;
	private $quantity;

	function __construct(int $productId, int $quantity = 1) {
		$this->productId = $productId;
		$this->quantity = $quantity;
	}

	/*
	* Get methods
	*/
	private function getPrice() {
		return $this->getAppCalculatedPrice();
	}

	private function getFullPrice() {
		return 49.9;
	}

	private function getPriceString() {
		return format_price($this->price);
	}

	/*
	* Set methods
	*/
	public function setQuantity(int $quantity) {
		$this->quantity = $quantity;
		$this->data = [];

		return $this;
	}

	/*
	* App specific methods
	*/
	private function getAppCalculatedPrice() {
		if (user()->groupId != 2) {
			switch (true) {
				case $this->quantity > 20:
					$price = 34.9;
					break;
				case $this->quantity > 10:
					$price = 39.9;
					break;
				case $this->quantity > 5:
					$price = 44.9;
					break;
				default:
					$price = 49.9;
					break;
			}
		} else {
			$price = 23;
		}

		return $price;
	}
}
