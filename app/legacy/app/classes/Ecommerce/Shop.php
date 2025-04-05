<?php

namespace Ecommerce;

use DB;
use Ecommerce\Shop\ViewManager;
use Structure\DynamicProperties;

class Shop {

	use DynamicProperties;

	public $seed;
	public $products;
	public $productCount;
	public $size = 35;
	public $title;
	public $search = null;
	public $category = null;
	public $sort = 'popular';
	public $priceRange = [null, null];
	public $currentPriceRange = null;
	public $promotion;
	public $inStock;
	public $page = 1;
	public $filters;

	function __construct() {

		// setup variables
		$queryValues = [];
		$queryWhere = [];

		// get filters
		$this->filters = ecommerce_config('shop-page')['filters'];

		// get search values
		$this->title = $_GET['title'] ?? 'Catalogo';
		if (isset($_GET['search'])) $this->search = $_GET['search'];
		if (isset($_GET['sort'])) $this->sort = $_GET['sort'];
		if (isset($_GET['page'])) $this->page = (int) $_GET['page'];
		if (isset($_GET['price-range'])) {
			$currentPriceRange = explode(',', $_GET['price-range']);
			$this->currentPriceRange = ['min' => $currentPriceRange[0], 'max' => $currentPriceRange[1]];
		}
		$this->promotion = $_GET['promotion'] ?? false;
		$this->inStock = $_GET['inStock'] ?? false;

		$start = $this->page ? $this->size * ($this->page - 1) : 1;

		// sort
		if (!in_array($this->sort, ['popular', 'new', 'custom'])) $this->sort = 'popular';
		if ($this->sort == 'popular') $queryOrder = 'inStock DESC, typeId ASC, recentSales DESC, sales DESC, id ASC';
		else if ($this->sort == 'new') $queryOrder = 'inStock DESC, typeId ASC, time DESC, id DESC';
		else if ($this->sort == 'custom') $queryOrder = 'inStock DESC, typeId ASC, sort ASC, typeId ASC';

		// search word
		if ($this->search) {
			$queryWhere[] = "(name LIKE CONCAT('%',?,'%') OR typeId IN (SELECT id FROM ecommerce_product_types WHERE name LIKE CONCAT('%',?,'%')))";
			$queryValues[] = $this->search;
			$queryValues[] = $this->search;
		}

		// price range
		if ($this->currentPriceRange) {
			$queryWhere[] = 'price>=? AND price<=?';
			$queryValues[] = $this->currentPriceRange['min'];
			$queryValues[] = $this->currentPriceRange['max'];
		}

		// promotion
		if ($this->promotion) {
			$queryWhere[] = 'products.id IN (SELECT itemId FROM ecommerce_promotions WHERE start <= NOW() AND end >= NOW())';
		}

		// in stock
		if ($this->inStock) {
			$queryWhere[] = 'inStock=1';
		}

		// other filters search
		foreach ($this->filters as $filter) {

			$filterSlug = $filter['slug'];
			$filterValue = $_GET[$filterSlug] ?? false;

			if ($filterValue) {
				$queryWhere[] = $filter['sql'] ?? $filterSlug . '=?';
				$queryValues[] = $filterValue;
			}
		}

		// fetch products
		$queryWhere = implode(' AND ', $queryWhere);
		if ($queryWhere) $queryWhere = 'WHERE ' . $queryWhere;

		$limit = $start . ', ' . $this->size;

		$productsQuery = '
			' . Product::TABLE . '.' . Product::INDEX . '
			FROM ' . Product::TABLE . '
			' . $queryWhere . '
			ORDER BY ' . $queryOrder . '
			LIMIT ' . $limit;

		$productCountQuery = Product::TABLE . ' ' . $queryWhere;

		$this->products = rows_to_objects(\Legacy\System\Classes\DB::select($productsQuery, $queryValues), Product::class);
		$this->productCount = \Legacy\System\Classes\DB::count($productCountQuery, $queryValues);

		// fetch price range
		if (!ecommerce_config('dynamic-product-price')) {
			$priceMin = \Legacy\System\Classes\DB::find('price FROM ' . Product::TABLE . ' WHERE status=1 ORDER BY price ASC');
			$priceMax = \Legacy\System\Classes\DB::find('price FROM ' . Product::TABLE . ' WHERE status=1 ORDER BY price DESC');

			$this->priceRange = ['min' => floor($priceMin), 'max' => ceil($priceMax)];
			if (!$this->currentPriceRange) $this->currentPriceRange = $this->priceRange;
		}
	}

	/*
	* Get methods
	*/
	private function getLayout() {
		return new ViewManager($this);
	}
}
