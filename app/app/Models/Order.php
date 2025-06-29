<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model {

	/**
	 * The attributes that are mass assignable
	 */
	protected $fillable = [
		'user_id',
		'shipping_method_id',
		'payment_method_id',
		'price',
		'item_price',
		'shipping_fee',
		'status',
	];

	/**
	 * Relationship: Get the order items associated with the order
	 */
	public function order_items(): HasMany {
		return $this->hasMany(OrderItem::class);
	}

	/**
	 * Get the name of the order item
	 */
	public function idCode(): string {
		return '#' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
	}

	/**
	 * Get the date of the order item
	 */
	public function date(): string {
		return $this->created_at->format('d/m/Y');
	}

	/**
	 * Get the label for the order status
	 */
	public function statusTag(): string {
		return config('custom.order_statuses.' . $this->status . '.tag', 'unknown');
	}

	/**
	 * Get the tag for the order status
	 */
	public function statusLabel(): string {
		return config('custom.order_statuses.' . $this->status . '.label', 'Unknown Status');
	}

	/**
	 * Calculate the current price of the order, based on the currrent product prices and shipping fees
	 */
	public function dynamicPrice(): float {
		return $this->dynamicItemPrice() + $this->dynamicShippingFee();
	}

	/**
	 * Calculate the total price of the items in the order
	 */
	public function dynamicItemPrice(): float {
		$price = 0;

		foreach ($this->order_items as $orderItem) {
			$price += $orderItem->price;
		}

		return $price;
	}

	/**
	 * Calculate the shipping fee of the order
	 */
	public function dynamicShippingFee(): float {
		return $this->shippingMethod?->price() ?? 0.0;
	}
}
