<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model {

	/**
	 * The attributes that are mass assignable
	 */
	protected $fillable = [
		'order_id',
		'product_id',
		'price',
		'product_price',
		'quantity',
	];

	/**
	 * Attribute: Get the name of the order item
	 */
	public function name(): Attribute {
		return Attribute::make(
			get: fn(): string => $this->product?->name ?? '-'
		);
	}

	/**
	 * Relationship: Get the product associated with the order item
	 */
	public function product(): BelongsTo {
		return $this->belongsTo(Product::class);
	}

	/**
	 * Get the name of the order item
	 */
	public function fullName(): string {
		return $this->quantity . ' x ' . $this->product?->name ?? '-';
	}

	/**
	 * Calculate the current price of the order item, based on the current product price
	 */
	public function dynamicPrice(): float {
		return $this->quantity * ($this->dynamicProductPrice());
	}

	/**
	 * Get the dynamic product price based on the current product price
	 */
	public function dynamicProductPrice(): float {
		return $this->product->price();
	}
}
