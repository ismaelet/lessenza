<?php

namespace Ecommerce;

use DB;

class Coupon {

	private $percentageDiscount;
	private $percentageDiscountMultiple;
	private $fixedDiscount;
	private $fixedDiscountMultiple;
	private $minPrice;
	private $types;
	private $onePerUser;
	private $freeShipping;
	private $timeStart;
	private $timeEnd;

	public $id = null;
	public $code;

	function __construct($id) {
		if ($row = \Legacy\System\Classes\DB::row('* FROM ecommerce_coupons WHERE id=?', [$id])) {
			$this->id = $id;
			$this->code = $row['code'];
			$this->percentageDiscount = $row['percentage-discount'];
			$this->percentageDiscountMultiple = $row['percentageDiscountMultiple'];
			$this->fixedDiscount = $row['fixedDiscount'];
			$this->fixedDiscountMultiple = $row['fixedDiscountMultiple'];
			$this->minPrice = $row['minPrice'];
			$this->types = !empty($row['types']) ? explode(',', $row['types']) : false;
			$this->onePerUser = $row['onePerUser'];
			$this->freeShipping = $row['freeShipping'];
			$this->timeStart = $row['timeStart'];
			$this->timeEnd = $row['timeEnd'];
		}
	}

	/*
	private function applyFreeShipping() {
		global $customer;

		$customer->cart->shippingDiscount = $customer->cart->originalShippingPrice;
		$customer->cart->freeShipping = true;

		\Legacy\System\Classes\DB::update('ecommerce_carts SET freeShipping=1 WHERE id=?', [$customer->cart->id]);
	}

	private function calculateCode() {
		global $customer;

		// update orders
		$orders = $customer->cart->orders;

		foreach ($orders as $order) {

			// check matches
			$matchType = !$this->types || in_array($order->item->type->id, $this->types) ? true : false;

			// calculate discount amount
			if ($matchType) {

				$percentage = $flat = 0;

				// discount percentage
				if ($this->percentageMore && $customer->cart->quantity > 2) $percentage = $this->percentageMore;
				else if ($this->percentage2 && $customer->cart->quantity > 1) $percentage = $this->percentage2;
				else $percentage = $this->percentage;

				// flat discount
				if ($this->flatMore && $customer->cart->quantity > 2) $flat = $this->flatMore;
				else if ($this->flat2 && $customer->cart->quantity > 1) $flat = $this->flat2;
				else $flat = $this->flat;

				// total
				$discount = round(($order->originalPrice * $percentage / 100) + $flat, 2);

				// update the order price
				\Legacy\System\Classes\DB::update('ecommerce_orders SET discount=? WHERE id=?', [$discount, $order->id]);
			}
		}
	}

	public function add() {
		global $customer;

		$error = false;

		if ($this->id) {
			if (strtotime($this->timeStart) > strtotime('now'))
				$error = 'coupon-not-started';
			else if (strtotime($this->timeEnd . ' +1 day') < strtotime('now'))
				$error = 'coupon-expired';
			else if ($this->onePerUser && !logged())
				$error = 'coupon-not-logged';
			else if ($this->onePerUser && \Legacy\System\Classes\DB::exists('ecommerce_carts WHERE couponId=? AND customerId=?', [$this->id, $customer->cart->customerId]))
				$error = 'coupon-used';
			else if ($this->minPrice && $customer->cart->originalItemsPrice < $this->minPrice)
				$error = 'coupon-min-price';
			else {
				\Legacy\System\Classes\DB::update('ecommerce_carts SET couponId=? WHERE id=?', [$this->id, $customer->cart->id]);

				if ($this->freeShipping) {
					$this->applyFreeShipping($customer->cart->id);
				}

				$this->calculateCode($customer->cart->id);

				$customer->cart->updateItemPrices();
			}
		} else $error = 'coupon-invalid';

		return $error;
	}

	public function remove() {
		global $customer;

		$customer->cart->couponId = 0;
		unset($customer->cart->coupon);

		\Legacy\System\Classes\DB::update('ecommerce_carts SET couponId=0, shippingDiscount=0 WHERE id=?', [$customer->cart->id]);
		\Legacy\System\Classes\DB::update('ecommerce_orders SET discount=0 WHERE cartId=?', [$customer->cart->id]);

		$customer->cart->updateItemPrices();
	}
	*/
}
