<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

	/**
	 * Get the full address as a formatted string
	 */
	public function fullAddress(): string {
		return $this->full_name . '<br>' . $this->street . ', ' . $this->number . '<br>' . $this->zip . ' ' . $this->city . ' (' . $this->region . ')';
	}
}
