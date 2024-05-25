<?php

namespace Ecommerce;

use DB;
use Structure\DatabaseObject;

class Address {

	use DatabaseObject;

	public const TABLE = 'ecommerce_addresses';
	public const INDEX = 'id';
	public const CUSTOMER_INDEX = 'customerId';

	public $fullName;
	public $address;
	public $number;
	public $city;
	public $zip;
	public $region;
	public $email;
	public $phone;
	public $notes;
	public $id;
	public $customerId;
	public $time;

	/*
	* Instace methods
	*/
	public static function new(array $data) {
		$id = DB::add(self::TABLE . ' (customerId, fullName, address, number, city, zip, region, email, phone, notes)', [$data['customerId'] ?? customerId(), $data['fullName'], $data['address'], $data['number'], $data['city'], $data['zip'], $data['region'], $data['email'], $data['phone'], $data['notes']]);

		return new self($id);
	}

	public function update(array $data) {
		DB::update(self::TABLE . ' SET fullName = ?, address = ?, number = ?, city = ?, zip = ?, region = ?, email = ?, phone = ?, notes = ? WHERE ' . self::INDEX . ' = ?', [$data['fullName'], $data['address'], $data['number'], $data['city'], $data['zip'], $data['region'], $data['email'], $data['phone'], $data['notes'], $this->id]);

		$this->reset();

		return $this;
	}

	/*
	* Get methods
	*/
	private function getFullAddress() {
		$fullAddress = $this->fullName . '<br>' . $this->address . ', ' . $this->number;

		if (!empty($this->apto)) {
			$fullAddress .= ' (' . $this->apto . ')';
		}

		$fullAddress .= '<br>' . $this->zip . ' ' . $this->city . ' (' . $this->region . ')';

		return $fullAddress;
	}

	private function getContacts() {
		$contacts = [];

		if ($this->email) {
			$contacts[] = $this->email;
		}

		if ($this->phone) {
			$contacts[] = $this->phone;
		}

		return $contacts;
	}

	private function getContactsString() {
		return implode('<br>', $this->contacts);
	}
}
