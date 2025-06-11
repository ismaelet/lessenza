<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Product\ProductType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;

class Shop extends Component {

	/**
	 * The search query for products.
	 * 
	 * @var string|null
	 */
	#[Url(history: true)]
	public ?string $search = null;

	/**
	 * The ID of the product type to filter by.
	 * 
	 * @var int|null
	 */
	#[Url(history: true)]
	public ?int $typeId = null;

	/**
	 * The sorting method for products.
	 * 
	 * @var string
	 */
	#[Url(history: true)]
	public string $sort = 'popular';

	/**
	 * The current page number for pagination.
	 * 
	 * @var int
	 */
	#[Url(history: true)]
	public int $page = 1;

	/**
	 * The collection of products to display.
	 * 
	 * @var Collection
	 */
	public Collection $products;

	/**
	 * The total number of products matched by the filters.
	 * 
	 * @var int
	 */
	public int $productCount;

	/**
	 * The number of products to display per page.
	 * 
	 * @var int
	 */
	public int $size = 35;

	/**
	 * The total number of pages for pagination.
	 * 
	 * @var int
	 */
	public int $pageCount;

	public array $filters = [];

	/**
	 * Mount the component with initial data.
	 * 
	 * @param Request $request
	 * @return void
	 */
	public function mount(Request $request): void {
		$this->filters = [
			[
				'title' => 'Collezioni',
				'slug' => 'product_type_id',
				'opened-by-default' => true,
				'list' => ProductType::orderBy('names')
					->orderBy('name')
					->get(),
			],
		];

		$this->getProducts();
	}

	/**
	 * Update the search query and refresh the product list.
	 * 
	 * return void
	 */
	public function updatedSearch(): void {
		$this->getProducts();
	}

	/**
	 * Update the sorting method and refresh the product list.
	 * 
	 * @return void
	 */
	public function updatedSort(): void {
		$this->getProducts();
	}

	/**
	 * Update the type ID and refresh the product list.
	 * 
	 * @return void
	 */
	public function updatedTypeId(): void {
		$this->getProducts();
	}

	/**
	 * Get the products based on the current filters and sorting.
	 * 
	 * @return void
	 */
	private function getProducts(): void {
		// Get the products
		$products = Product::where('statusId', 1);

		// Filter by keywords
		if ($this->search) {
			$products = $products->where(function ($query) {
				$query->where('name', 'LIKE', '%' . $this->search . '%')
					->orWhereHas('product_type', function ($query) {
						$query->where('name', 'LIKE', '%' . $this->search . '%');
					});
			});
		}

		// Filter by type
		if ($this->typeId) {
			$products = $products->where('product_type_id', $this->typeId);
		}

		// Sort products
		$products = $this->sort == 'popular' ?
			$products->orderByDesc('inStock')
			->orderBy('product_type_id')
			->orderByDesc('recentSales')
			->orderByDesc('sales')
			->orderBy('id') :

			$products->orderByDesc('inStock')
			->orderBy('product_type_id')
			->orderByDesc('created_at')
			->orderByDesc('id');

		// Get the total number of products
		$this->productCount = $products->count();

		// Get the products for the current page
		$this->products = $products->get();

		$start = $this->page ? $this->size * ($this->page - 1) : 1;
		$this->pageCount = ceil($this->productCount / $this->size);
	}

	/**
	 * Render the component view.
	 * 
	 * @return \Illuminate\View\View
	 */
	public function render(): View {
		return view('livewire.shop');
	}
}
