<?php

namespace User;

use DB;

class Group {

	private $discountPercentage;

	public $id = null;
	public $priceMultiplier = 1;

	function __construct($id) {
		if ($row = DB::row('* FROM user_groups WHERE id=?', [$id])) {
			$this->id = $id;
			$this->discountPercentage = $row['discount'];
			$this->priceMultiplier = (100 - $this->discountPercentage) / 100;
		}
	}
}
