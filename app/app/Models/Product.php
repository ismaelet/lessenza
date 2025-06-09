<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	private const DEFAULT_IMAGE_RESOLUTION = 1024;
	private const ALLOWED_IMAGE_RESOLUTIONS = [100, 400, 1024];

	/**
	 * Get the route key for the model.
	 * 
	 * @return string
	 */
	public function getRouteKeyName(): string {
		return 'slug';
	}

	/**
	 * Get the URL for the product.
	 * 
	 * @return string
	 */
	public function url(): string {
		return route('product.show', ['product' => $this->slug]);
	}

	/**
	 * Get the image URL for the product.
	 * 
	 * @param int $resolution The resolution of the image.
	 * @return string
	 */
	public function image(int $resolution = self::DEFAULT_IMAGE_RESOLUTION): string {
		if (!in_array($resolution, self::ALLOWED_IMAGE_RESOLUTIONS)) {
			$resolution = self::DEFAULT_IMAGE_RESOLUTION;
		}

		return public_asset('products/' . $this->id . '-' . $resolution . '.webp');
	}
}
