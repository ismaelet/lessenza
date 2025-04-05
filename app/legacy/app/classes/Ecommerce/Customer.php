<?php

namespace Ecommerce;

use DB;
use Structure\DatabaseObject;

class Customer {

	use \Legacy\System\Traits\DatabaseObject;

	public const TABLE = 'ecommerce_customers';
	public const INDEX = 'id';
	public const USER_INDEX = 'userId';

	public $id;
	public $userId;
	public $groupId;
	public $time;

	/*
	* Get methods
	*/
	// basic data
	private function getGuest() {
		return (bool) $this->id;
	}

	// carts
	private function getCart() {
		$cartId = \Legacy\System\Classes\DB::find(Cart::INDEX . ' FROM ' . Cart::TABLE . ' WHERE ' . Cart::CUSTOMER_INDEX . ' = ? AND statusId = 0', [$this->id]);
		return new Cart($cartId);
	}

	private function getConfirmedCarts() {
		return rows_to_objects(\Legacy\System\Classes\DB::select(Cart::INDEX . ' FROM ' . Cart::TABLE . ' WHERE ' . Cart::CUSTOMER_INDEX . ' = ? AND statusId <> 0 ORDER BY time DESC', [$this->id]), Cart::class);
	}

	private function getConfirmedCartsCount() {
		return count($this->confirmedCarts);
	}

	// addresses
	private function getDefaultAddressId() {
		return \Legacy\System\Classes\DB::find(Address::INDEX . ' FROM ' . Address::TABLE . ' WHERE ' . Address::CUSTOMER_INDEX . ' = ? ORDER BY ' . Address::INDEX . ' DESC', [$this->id]);
	}

	private function getDefaultAddress() {
		return new Address($this->defaultAddressId);
	}

	private function getHasAddress() {
		return (bool) $this->getDefaultAddressId();
	}

	/*
	* Set methods
	*/
	public function setCart(object $cart) {
		$this->data[] = [];
		$this->data['cart'] = $cart;

		return $this;
	}

	/*
	* Istance methods
	*/
	public static function new() {
		if (logged()) {
			$customerId = \Legacy\System\Classes\DB::find(self::INDEX . ' FROM ' . self::TABLE . ' WHERE ' . self::USER_INDEX . ' = ?', [userId()]);
		}

		if (!$customerId) {
			$customerId = \Legacy\System\Classes\DB::add(self::TABLE . ' (' . self::USER_INDEX . ')', [userId() ?: 0]);
		}

		return new self($customerId);
	}
}
