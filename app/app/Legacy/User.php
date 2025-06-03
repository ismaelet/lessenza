<?php

namespace App\Legacy;

use App\Legacy\Traits\DatabaseObject;

class User {

	use DatabaseObject;

	public const TABLE = 'users';
	public const INDEX = 'id';

	public $id;
	public $username;
	public $firstName;
	public $groupId;
	public $admin;
	public $password;
	public $email;
	public $lastName;
	public $time;

	/*
	* Get methods
	*/
	private function getFullName() {
		$fullName = [];

		if ($this->firstName) $fullName[] = $this->firstName;
		if ($this->lastName) $fullName[] = $this->lastName;

		return implode(' ', $fullName);
	}

	private function getEmailIsUsername() {
		return !$this->username || $this->username == $this->email;
	}
}
