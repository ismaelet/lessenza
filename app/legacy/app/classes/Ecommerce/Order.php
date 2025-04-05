<?php

namespace Ecommerce;

use DB;
use Ecommerce\Product\PriceData;
use Structure\DatabaseObject;

class Order {

	use \Legacy\System\Traits\DatabaseObject;

	public const TABLE = 'ecommerce_orders';
	public const INDEX = 'id';
	public const PRODUCT_INDEX = 'productId';
	public const CART_INDEX = 'cartId';
	public const CUSTOMER_INDEX = 'customerId';

	public $id;
	public $cartId;
	public $customerId;
	public $productId;
	public $staticFullPrice;
	public $staticDiscount;
	public $quantity;
	public $time;

	/*
	* Get methods
	*/
	// basic data
	private function getName() {
		return $this->quantity > 1 ? $this->quantity . ' x ' . $this->product->name : $this->product->name;
	}

	// single product price
	private function getPriceData() {
		return new PriceData($this->productId, $this->quantity);
	}

	private function getProductPrice() {
		return $this->fullProductPrice - $this->productDiscount;
	}

	private function getFullProductPrice() {
		return $this->priceData->price;
	}

	private function getProductDiscount() {
		return 0;
	}

	// order price
	private function getPrice() {
		return $this->productPrice * $this->quantity;
	}

	private function getPriceString() {
		return format_price($this->price);
	}

	private function getFullPrice() {
		return $this->fullProductPrice * $this->quantity;
	}

	private function getFullPriceString() {
		return format_price($this->fullProductPrice);
	}

	private function getDiscount() {
		return $this->productDiscount * $this->quantity;
	}

	// related classes
	private function getProduct() {
		return new Product($this->productId);
	}

	private function getCart() {
		return new Cart($this->cartId);
	}

	/*
	* Istance methods
	*/
	static function add(array $data) {
		// create a new cart if there is no active cart
		if (!cartId()) {
			Cart::newActiveCart();
		}

		// check if there is already an order with the same characteristics
		$orderId = \Legacy\System\Classes\DB::find(
			self::INDEX . ' FROM ' . self::TABLE . ' WHERE ' . self::CART_INDEX . ' = ? AND ' . self::CUSTOMER_INDEX . ' = ? AND ' . self::PRODUCT_INDEX . ' = ?',
			[cartId(), customerId(), $data[self::PRODUCT_INDEX]]
		);

		if ($orderId) {
			// add the quantity to the previous order
			\Legacy\System\Classes\DB::update(self::TABLE . ' SET quantity = quantity + ?, time = NOW() WHERE ' . self::INDEX . ' = ?', [$data['quantity'], $orderId]);
		} else {
			// create a new order
			$orderId = \Legacy\System\Classes\DB::add(
				self::TABLE . ' (' . self::CART_INDEX . ', ' . self::CUSTOMER_INDEX . ',' . self::PRODUCT_INDEX . ', quantity)',
				[cartId(), customerId(), $data[self::PRODUCT_INDEX], $data['quantity']]
			);
		}

		/*
		if ($cart->couponId) {
			$cart->applyCoupon();
		}
		*/

		return new self($orderId);
	}

	public function delete() {
		\Legacy\System\Classes\DB::delete(self::TABLE . ' WHERE ' . self::INDEX . ' = ?', [$this->id]);

		$this->reset();
		$this->cart->resetDynamicProperties();

		if (!$this->cart->quantity) {
			$this->cart->delete();
		}
	}
}
