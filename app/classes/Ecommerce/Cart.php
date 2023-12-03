<?php

namespace Ecommerce;

use DB;
use Email;
use Structure\DatabaseObject;
use View;

class Cart {

	use DatabaseObject;

	public const TABLE = 'ecommerce_carts';
	public const INDEX = 'id';
	public const CUSTOMER_INDEX = 'customerId';
	public const SHIPPING_METHOD_INDEX = 'shippingMethodId';

	public $id;
	public $addressId;
	public $shippingMethodId;
	public $gift;
	public $step;
	public $statusId;
	public $trackingCode;

	/*
	* Public methods
	*/
	public function advance(int $currentStep = null) {
		$currentStep = $currentStep ?: View::get('currentStep');

		if ($this->step == $currentStep) {
			$this->updateStep($currentStep + 1);
		}

		return $this;
	}

	public function advanceAndRedirect() {
		$this->advance();

		redirect('/cart?step=' . $this->step);
	}

	public function confirm() {
		DB::update(self::TABLE . ' SET time = NOW() WHERE ' . self::INDEX . ' = ?', [$this->id]);

		// send email
		$debug = false;

		$content = 'Hai ricevuto un ordine da parte di ' . $this->address->fullName . '. Controlla i dati dell\'ordine <a href="https://lessenza.net/admin/orders/add?id=' . $this->id . '"><strong>qui</strong></a>.';

		$content = Email::prepareBody($content);

		$emailData = [
			'debug' => $debug,
			'to' => $debug ? 'ismaele.tuffanelli@gmail.com' : sys_config('contact-email'),
			'subject' => 'Ordine ricevuto',
			'text' => $content,
		];

		Email::send($emailData);

		$this->updateStatusId(1);
	}

	/*
	* Email methods
	*/
	public function sendStatusEmail() {
		EmailService::sendStatusEmail($this->id);
	}

	public function sendTrackingEmail() {
		EmailService::sendTrackingEmail($this->id);
	}

	/*
	* Instace methods
	*/
	static public function newActiveCart() {
		requireActiveCustomer();

		$cart = self::new(customerId());

		customer()->setCart($cart);

		return $cart;
	}

	static public function new(int $customerId) {
		// get default address
		$addressId = DB::find(Address::INDEX . ' FROM ' . Address::TABLE . ' WHERE customerId = ? ORDER BY ' . Address::INDEX . ' DESC', [$customerId]);

		// generate a new cart
		$cartId = DB::add(self::TABLE . ' (' . self::CUSTOMER_INDEX . ')', [$customerId]);
		$cart = new self($cartId);

		// associate existing address to the cart
		if ($addressId) {
			$cart->updateAddressId($addressId);
		}

		return $cart;
	}

	public function delete() {
		DB::delete(self::TABLE . ' WHERE ' . self::INDEX . ' = ?', [$this->id]);
		DB::delete(Order::TABLE . ' WHERE ' . Order::CART_INDEX . ' = ?', [$this->id]);

		$this->reset();
	}

	/*
	* Get methods
	*/
	// basic data
	private function getIdCode() {
		return '#' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
	}

	private function getStatusCode() {
		return ecommerce_config('cart-statuses')[$this->statusId][0];
	}

	private function getStatusName() {
		return ecommerce_config('cart-statuses')[$this->statusId][1];
	}

	private function getStatusIcon() {
		return ecommerce_config('cart-statuses')[$this->statusId][2];
	}

	private function getDateString() {
		return date('Y-m-d', strtotime($this->time));
	}

	private function getParcialUrl() {
		return '/order?id=' . $this->id . '&customerId=' . $this->customerId;
	}

	private function getUrl() {
		return public_client_url($this->parcialUrl);
	}

	private function getStaticUrl() {
		return CLIENT_URL . $this->parcialUrl;
	}

	// orders
	private function getOrders() {
		return rows_to_objects(DB::select(Order::INDEX . ' FROM ' . Order::TABLE . ' WHERE ' . Order::CART_INDEX . ' = ? ORDER BY ' . Order::INDEX . ' DESC', [$this->id]), Order::class);
	}

	private function getQuantity() {
		return (int) DB::sum('quantity FROM ' . Order::TABLE . ' WHERE ' . Order::CART_INDEX . ' = ?', [$this->id]);
	}

	// address
	private function getHasAddress() {
		return (bool) $this->addressId;
	}

	private function getAddress() {
		return new Address($this->addressId);
	}

	// coupon
	private function getUsedCoupon() {
		return (bool) $this->couponId;
	}

	private function getCoupon() {
		return new Coupon($this->couponId);
	}

	// settings
	private function getIsGift() {
		return (bool) $this->gift;
	}

	// cart total price
	private function getPrice() {
		return $this->productPrice + $this->shippingPrice;
	}

	private function getPriceString() {
		return format_price($this->price);
	}

	// product price
	private function getProductPrice() {
		$price = 0;

		foreach ($this->orders as $order) {
			$price += $order->price;
		}

		return $price;
	}

	private function getProductPriceString() {
		return format_price($this->productPrice);
	}

	private function getFullProductPrice() {
		$price = 0;

		foreach ($this->orders as $order) {
			$price += $order->fullPrice;
		}

		return $price;
	}

	private function getFullProductPriceString() {
		return format_price($this->fullProductPrice);
	}

	private function getDiscount() {
		return $this->productDiscount;
	}

	private function getDiscountString() {
		return format_price($this->productDiscount);
	}

	private function getProductDiscount() {
		$discount = 0;

		foreach ($this->orders as $order) {
			$discount += $order->discount;
		}

		return $discount;
	}

	private function getProductDiscountString() {
		return format_price($this->productDiscount);
	}

	// shipping price
	private function getShippingPrice() {
		return $this->fullShippingPrice - $this->shippingDiscount;
	}

	private function getShippingPriceString() {
		return format_price($this->shippingPrice);
	}

	private function getFullShippingPrice() {
		return $this->shippingMethod->price;
	}

	private function getShippingDiscount() {
		return 0;
	}

	// customer
	private function getCustomer() {
		return new Customer($this->customerId);
	}

	// shipping method
	private function getShippingMethod() {
		return (new ShippingMethod($this->shippingMethodId))
			->setAssociatedCartId($this->id);
	}

	// payment method
	private function getPaymentMethod() {
		return new PaymentMethod($this->paymentMethodId);
	}

	/*
	* Set methods
	*/
	public function setAddressId(int $addressId) {
		$this->addressId = $addressId;

		unset($this->data['address']);

		return $this;
	}

	public function setShippingMethodId(int $shippingMethodId) {
		$this->shippingMethodId = $shippingMethodId;
		$this->data = [];

		return $this;
	}

	public function setStep(int $step) {
		$this->step = $step;

		return $this;
	}

	public function setStatusId(int $statusId) {
		$this->statusId = $statusId;
		$this->data = [];

		return $this;
	}

	public function setTrackingCode(string $trackingCode) {
		$this->trackingCode = $trackingCode;

		return $this;
	}

	public function setIsGift(bool $isGift) {
		$this->gift = $isGift ? 1 : 0;

		unset($this->data['isGift']);

		return $this;
	}

	/*
	* Update methods
	*/
	public function updateAddressId(int $addressId) {
		DB::update(self::TABLE . ' SET addressId = ? WHERE id = ?', [$addressId, $this->id]);

		$this->setAddressId($addressId);

		return $this;
	}

	public function updateShippingMethodId(int $shippingMethodId) {
		$shippingMethod = new ShippingMethod($shippingMethodId);

		$this->setShippingMethodId($shippingMethodId);

		DB::update(self::TABLE . ' SET ' . self::SHIPPING_METHOD_INDEX . ' = ?, staticFullShippingPrice = ?, staticShippingDiscount = ? WHERE ' . self::INDEX . ' = ?', [$shippingMethod->id, $this->fullShippingPrice, $this->shippingDiscount, $this->id]);

		return $this;
	}

	public function updateGift(bool $isGift) {
		DB::update(self::TABLE . ' SET gift = ? WHERE ' . self::INDEX . ' = ?', [$isGift ? 1 : 0, $this->id]);

		$this->setIsGift($isGift);

		return $this;
	}

	public function updateStep(int $step) {
		DB::update(self::TABLE . ' SET step = ? WHERE ' . self::INDEX . ' = ?', [$step, $this->id]);

		$this->setStep($step);

		return $this;
	}

	public function updateStatusId(int $statusId) {
		DB::update(self::TABLE . ' SET statusId = ? WHERE ' . self::INDEX . ' = ?', [$statusId, $this->id]);

		$this->setStatusId($statusId);

		if (ecommerce_config('cart-statusId-emails')) {
			$this->sendStatusEmail();
		}
	}

	public function updateTrackingCode(string $trackingCode) {
		DB::update(self::TABLE . ' SET tracking = ? WHERE ' . self::INDEX . ' = ?', [$trackingCode, $this->id]);

		$this->setTrackingCode($trackingCode);

		if (ecommerce_config('cart-statusId-emails')) {
			$this->sendTrackingEmail();
		}
	}
}
