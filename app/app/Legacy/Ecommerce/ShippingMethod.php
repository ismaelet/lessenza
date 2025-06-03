<?php

namespace App\Legacy\Ecommerce;

use Structure\DatabaseObject;

class ShippingMethod {

	use DatabaseObject;

	public const TABLE = 'ecommerce_shipping_methods';
	public const INDEX = 'id';

	private const MONTH_NAMES = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];
	private const DAY_NAMES = ['Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato', 'Domenica'];

	public $id;
	public $name;
	public $description;
	public $processingDays;
	public $minimumDeliveryDays;
	public $maximumDeliveryDays;

	private $api;
	private $minimumPrice;
	private $maximumPrice;
	private $additionalPrice;
	private $freeShippingAbove;

	/*
	* Get methods
	*/
	// price
	private function getPrice() {
		if ($this->apiResults) {
			$price = $this->apiResults['price'];
		} else {
			$price = $this->minimumPrice + $this->additionalPrice * ($this->associatedCart->quantity - 1);
			$price = $price > $this->maximumPrice ? $this->maximumPrice : $price;
		}

		if ($this->freeShippingAbove && $this->associatedCart->productPrice > $this->freeShippingAbove) {
			$price = 0;
		}

		return $price;
	}

	private function getPriceString() {
		return format_price($this->price);
	}

	// delivery time
	private function getDeliveryDate() {
		$deliveryDate = [];
		$totDays = $totWorkDays = 0;

		$today = date('Y/m/d/', time());
		$weekDay = date('N', strtotime($today));
		$holidays = ['25-12', '26-12',];
		$minimumDeliveryDays = $this->apiResults ? $this->apiResults['minimumDeliveryDays'] : $this->minimumDeliveryDays;
		$maximumDeliveryDays = $this->apiResults ? $this->apiResults['maximumDeliveryDays'] : $this->maximumDeliveryDays;
		$extimateDays = $minimumDeliveryDays == $maximumDeliveryDays ? [$minimumDeliveryDays] : [$minimumDeliveryDays, $maximumDeliveryDays];

		foreach ($extimateDays as $deliveryDays) {
			while ($totWorkDays < $deliveryDays) {

				$totDays++;
				$weekDay++;

				if ($weekDay > 7) $weekDay = 1;

				$day = date('d-m', strtotime($today . ' +' . $totDays . ' days'));

				if (!in_array($weekDay, [6, 7]) && !in_array($day, $holidays)) $totWorkDays++;
			}

			$deliveryDate[] = strtotime($today . ' + ' . $totDays . ' days');
		}

		return $deliveryDate;
	}

	private function getDeliveryDateString() {
		$deliveryDate = [];

		foreach ($this->deliveryDate as $date) {
			$dateWeekDay = date('N', $date);
			$dateMonthDay = date('d', $date);
			$dateMonth = date('m', $date);

			$deliveryDate[] = '<span class="fw-semibold">' . strtolower(self::DAY_NAMES[$dateWeekDay - 1]) . ' ' . $dateMonthDay . ' ' . strtolower(self::MONTH_NAMES[$dateMonth - 1]) . '</span> ';
		}

		return implode(' - ', $deliveryDate);
	}

	// APIs
	private function getHasApi() {
		return (bool) $this->api;
	}

	private function getApiResults() {
		return $this->hasApi ? $this->{$this->api . 'Results'}() : null;
	}

	private function getActiveApi() {
		return (bool) $this->apiResults;
	}

	// cart
	private function getAssociatedCartId() {
		return cart()->id;
	}

	private function getAssociatedCart() {
		return $this->associatedCartId == cart()->id ? cart() : new Cart($this->associatedCartId);
	}

	/*
	* Set methods
	*/
	public function setAssociatedCartId(int $cartId = null) {
		$this->data = [];
		$this->data['associatedCartId'] = $cartId;

		return $this;
	}
}
