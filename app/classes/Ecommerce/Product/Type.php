<?php

namespace Ecommerce\Product;

use Structure\DatabaseObject;

class Type {

	use DatabaseObject;

	public const TABLE = 'ecommerce_product_types';
	public const INDEX = 'id';

	public $id = null;
	public $name;
	public $names;

	/*
	* Get methods
	*/
	private function getPluralName() {
		return $this->names ?: $this->name;
	}
}
