<?php

namespace Ecommerce\Product;

use \DB;

class Promotion {

	public $id = null;
	public $price;
	public $start;
	public $end;

	function __construct($id) {
		if ($data = DB::row('* FROM ecommerce_promotions WHERE id=?', [$id])) {
			$this->id = $id;
			$this->price = $data['price'];
			$this->end = $data['end'];
			$this->start = $data['start'];
		}
	}

	function __get($name) {
		switch ($name) {
			case 'priceStr':
				return $this->priceStr = format_price($this->price);
		}
	}
}
