<?php

namespace Newsletter;

use DB;
use Structure\DatabaseObject;

class Subscriber {

	use DatabaseObject;

	public const TABLE = 'newsletter_subscribers';
	public const INDEX = 'id';

	/**
	 * Istance methods
	 */
	public static function new(array $data) {
		$email = $data['email'];
		$id = DB::find(self::INDEX . ' FROM ' . self::TABLE . ' WHERE email = ?', [$email]);

		if (!$id) {
			$firstName = $data['firstName'] ?? '';
			$lastName = $data['lastName'] ?? '';
			$fullName = $data['fullName'] ?? '';

			$id = DB::add(self::TABLE . ' (firstName, lastName, fullName, email)', [$firstName, $lastName, $fullName, $email]);
		}

		return new self($id);
	}
}
