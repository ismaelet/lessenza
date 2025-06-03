<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {

	/**
	 * The attributes that are mass assignable.
	 * 
	 * @var array
	 */
	protected $fillable = [
		'name',
		'location',
		'text',
		'rating',
		'website',
	];
}
