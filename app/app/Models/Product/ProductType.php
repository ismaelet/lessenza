<?php

namespace App\Models\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends Model {

	use SoftDeletes;

	/**
	 * The attributes that are mass assignable
	 */
	protected $fillable = ['name'];

	/**
	 * Relationship: The products associated with this product type
	 */
	public function products(): HasMany {
		return $this->hasMany(Product::class);
	}
}
