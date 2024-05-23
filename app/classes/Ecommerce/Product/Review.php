<?php

namespace Ecommerce;

use \DB;
use \User;

class Review {

	private $time;

	public $userId;
	public $text;
	public $score;
	public $scorePercent;
	public $scoreOutOfFive;

	function __construct($id) {

		if ($row = DB::row('* FROM ecommerce_reviews WHERE id=?', [$id])) {
			$this->userId = $row['userId'];
			$this->text = $row['text'];
			$this->score = $row['score'];
			$this->scorePercent = $this->score * 10;
			$this->scoreOutOfFive = $this->score / 2;
			$this->time = $row['time'];
		}
	}

	function __get($name) {
		switch ($name) {
			case 'fullName':
				return $this->fullName = (new User($this->userId))->fullName;
		}
	}
}
