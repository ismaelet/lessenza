<?php

namespace Ecommerce;

use DB;
use Ecommerce\Product\PriceData;
use Ecommerce\Product\Type;
use Structure\DatabaseObject;

class Product {

	use DatabaseObject;

	private const BRAND_SKU = '';
	private const DEFAULT_IMAGE_RESOLUTION = 1024;
	private const ALLOWED_IMAGE_RESOLUTIONS = [100, 400, 1024];

	public const TABLE = 'ecommerce_products';
	public const INDEX = 'id';
	public const TYPE_INDEX = 'typeId';
	public const STATUS_INDEX = 'statusId';

	public $id;
	public $typeId;
	public $description;
	public $details;
	public $variations;
	public $slug;
	public $time;
	public $name;
	public $ingredients;
	public $resellerPrice;
	public $inStock;
	public $highlighted;
	public $sales;
	public $recentSales;
	public $statusId;
	public $processed;

	/**
	 * Get methods
	 */
	// data
	private function getSlug() {
		$slug = $this->slug;

		if (!$slug) {
			$slug = generate_product_slug($this->name);

			DB::update(self::TABLE . ' SET slug = ? WHERE ' . self::INDEX . ' = ?', [$slug, $this->id]);
		}

		return $slug;
	}

	private function getSku() {
		$brandSku = self::BRAND_SKU;
		$typeSku = str_pad($this->type->id, 3, '0', STR_PAD_LEFT);
		$productSku = $this->id;

		$sku = implode('-', [$brandSku, $typeSku, $productSku]);

		return $sku;
	}

	private function getUrl() {
		return '/' . __('products') . '/' . $this->id . '-' . $this->getSlug();
	}

	private function getClientUrl() {
		return public_client_url($this->url);
	}

	private function getStaticUrl() {
		return public_client_url($this->url);
	}

	private function getIsLiked() {
		return DB::exists('ecommerce_product_likes WHERE productId = ? AND userId = ?', [$this->id, userId()]);
	}

	// Prices
	private function getPriceData() {
		return new PriceData($this->id);
	}

	private function getPrice() {
		return $this->priceData->price;
	}

	private function getPriceString() {
		return format_price($this->price);
	}

	private function getFullPrice() {
		return $this->priceData->fullPrice;
	}

	private function getFullPriceString() {
		return format_price($this->fullPrice);
	}

	private function getFormattedFullPrice() {
		return format($this->price);
	}

	private function getDiscountedPrice() {
		return $this->price;
	}

	private function getOnSale() {
		return $this->discountedPrice < $this->price;
	}

	// Related classes
	private function getType() {
		return new Type($this->typeId);
	}

	// Images
	private function getImage(int $resolution = self::DEFAULT_IMAGE_RESOLUTION) {
		if (!in_array($resolution, self::ALLOWED_IMAGE_RESOLUTIONS)) {
			$resolution = self::DEFAULT_IMAGE_RESOLUTION;
		}

		return '/uploads/products/' . $this->id . '-' . $resolution;
	}

	private function getClientImage() {
		return public_client_path($this->image);
	}

	private function getServerImage() {
		return public_server_path($this->image);
	}

	private function getAllImage() {
		$images = [];

		foreach (self::ALLOWED_IMAGE_RESOLUTIONS as $resolution) {
			$images[] = '/uploads/products/' . $this->id . '-' . $resolution;
		}

		return $images;
	}

	private function getAllServerImages() {
		$images = [];

		foreach ($this->allImages as $image) {
			if (file_exists($file = public_server_path($image))) {
				$images[] = $image;
			}
		}

		return $images;
	}

	// related products
	public function getRelatedProducts(int $count = 5) {
		$products = rows_to_objects(DB::select(self::INDEX . ' FROM ' . self::TABLE . ' WHERE ' . self::INDEX . ' <> ? AND ' . self::TYPE_INDEX . ' = ? ORDER BY recentSales DESC, sales DESC, ' . self::INDEX . ' DESC LIMIT ?', [$this->id, $this->typeId, $count]), self::class);

		return $products;
	}

	/**
	 * Istance methods
	 */
	public function delete(bool $permanently = true) {
		if ($permanently) {
			DB::delete(self::TABLE . ' WHERE ' . self::INDEX . ' = ?', [$this->id]);

			foreach ($this->allServerImages as $image) {
				unlink($image);
			}
		} else {
			DB::update(self::TABLE . ' SET ' . self::STATUS_INDEX . ' = ? WHERE ' . self::INDEX . ' = ?', [0, $this->id]);
		}

		$this->reset();

		return $this;
	}
}
