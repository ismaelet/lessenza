<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

	/**
	 * The attributes that are mass assignable
	 */
	protected $fillable = [
		'user_id',
		'full_name',
		'street',
		'number',
		'city',
		'zip',
		'region',
		'email',
		'phone',
		'notes',
	];

	/**
	 * Get the full address as a formatted string
	 */
	public function fullAddress(): string {
		return $this->full_name . '<br>' . $this->street . ', ' . $this->number . '<br>' . $this->zip . ' ' . $this->city . ' (' . $this->region . ')';
	}
}
