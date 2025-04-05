<?php

namespace Item;

use \DB;

class Category {

	public $id = 0;
	public $name;

	function __construct($id) {
		if ($id && $row = DB::row('name FROM items_categories WHERE id=?', [$id])) {

			$this->id = $id;
			$this->name = $row['name'];
		}
	}
}
