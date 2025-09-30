<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use NumberFormatter;

class Product extends Model {

	use SoftDeletes;

	private const DEFAULT_IMAGE_RESOLUTION = 1024;
	private const ALLOWED_IMAGE_RESOLUTIONS = [100, 400, 1024];

	/**
	 * The attributes that are mass assignable
	 */
	protected $fillable = [
		'name',
		'slug',
		'description',
		'description_short',
		'uses',
		'warnings',
		'product_type_id',
		'price',
	];

	/**
	 * Attribute: The image URL for the product
	 */
	public function image(): Attribute {
		return Attribute::make(
			get: fn(): string => $this->getImage(),
		);
	}

	public function storageImagePath(): Attribute {
		return Attribute::make(
			get: fn(): string => app()->environment() == 'local' ? $this->image : 'app/public/products/' . $this->id . '-' . self::DEFAULT_IMAGE_RESOLUTION . '.webp',
		);
	}

	/**
	 * Relationship: The product type associated with this product
	 */
	public function product_type(): BelongsTo {
		return $this->belongsTo(Product\ProductType::class);
	}

	/**
	 * Get the route key for the model.
	 */
	public function getRouteKeyName(): string {
		return 'slug';
	}

	/**
	 * Get the URL for the product
	 */
	public function url(): string {
		return route('product.show', ['product' => $this->slug]);
	}

	/**
	 * Get the image URL for the product
	 */
	public function getImage(int $resolution = self::DEFAULT_IMAGE_RESOLUTION): string {
		if (!in_array($resolution, self::ALLOWED_IMAGE_RESOLUTIONS)) {
			$resolution = self::DEFAULT_IMAGE_RESOLUTION;
		}

		return public_asset('products/' . $this->id . '-' . $resolution . '.webp');
	}

	/**
	 * Get the product price based on the quantity
	 */
	public function price(int $quantity = 1): float {
		if ($this->price) {
			return $this->price;
		}

		if (Auth::user()?->groupId != 2) {
			switch (true) {
				case $quantity > 20:
					$price = 34.9;
					break;
				case $quantity > 10:
					$price = 39.9;
					break;
				case $quantity > 5:
					$price = 44.9;
					break;
				default:
					$price = 49.9;
					break;
			}
		} else {
			$price = 23;
		}

		return $price;
	}

	/**
	 * Get the product price in a human-readable format.
	 * 
	 * @return string
	 */
	public function priceString(): string {
		return (new NumberFormatter('it_IT', NumberFormatter::CURRENCY))->formatCurrency($this->price(), 'EUR');
	}

	/**
	 * Get the related products.
	 * This method retrieves the latest 5 products excluding the current one.
	 * 
	 * @return Collection
	 */
	public function relatedProducts(): Collection {
		return self::where('id', '!=', $this->id)
			->latest()
			->take(5)
			->get();
	}

	/**
	 * Generate the SKU for the product
	 */
	public function sku(): string {
		return 'LES-' . str_pad($this->id, 5, '0', STR_PAD_LEFT);
	}
}
