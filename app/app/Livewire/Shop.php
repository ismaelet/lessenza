<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Product\ProductType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;

class Shop extends Component
{
    /**
     * The search query for products
     */
    #[Url(history: true)]
    public ?string $search = null;

    /**
     * The ID of the product type to filter by
     */
    #[Url(history: true)]
    public $typeId = null;

    /**
     * The sorting method for products
     */
    #[Url(history: true)]
    public string $sort = 'popular';

    /**
     * The current page number for pagination
     */
    #[Url(history: true)]
    public int $page = 1;

    /**
     * The collection of products to display
     */
    public Collection $products;

    /**
     * The total number of products matched by the filters
     */
    public int $productCount;

    /**
     * The number of products to display per page
     */
    public int $size = 35;

    /**
     * The total number of pages for pagination
     */
    public int $pageCount;

    public array $filters = [];

    /**
     * Mount the component with initial data
     */
    public function mount(Request $request): void
    {
        $this->typeId = is_numeric($request->typeId) ? (int) $request->typeId : null;

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
    public function updatedSearch(): void
    {
        $this->page = 1;
        $this->getProducts();

        if ($this->search && strlen($this->search) > 2) {
            $this->dispatch('meta-search', query: $this->search);
        }
    }

    /**
     * Update the sorting method and refresh the product list.
     */
    public function updatedSort(): void
    {
        $this->page = 1;
        $this->getProducts();
    }

    /**
     * Update the type ID and refresh the product list.
     */
    public function updatedTypeId(): void
    {
        $this->page = 1;
        $this->getProducts();
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
        $this->getProducts();
    }

    public function updatedPage(): void
    {
        $this->getProducts();
    }

    /**
     * Get the products based on the current filters and sorting.
     */
    private function getProducts(): void
    {
        // Get the products
        $products = Product::where('statusId', 1);

        // Filter by keywords
        if ($this->search) {
            $products = $products->where(function ($query) {
                $query->where('name', 'LIKE', '%'.$this->search.'%')
                    ->orWhereHas('product_type', function ($query) {
                        $query->where('name', 'LIKE', '%'.$this->search.'%');
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

        $this->pageCount = max(1, (int) ceil($this->productCount / $this->size));
        $this->page = max(1, min($this->page, $this->pageCount));
        $this->products = $products->forPage($this->page, $this->size)->get();
    }

    /**
     * Render the component view.
     */
    public function render(): View
    {
        $firstPage = max(1, min($this->page - 2, $this->pageCount - 4));

        return view('livewire.shop', [
            'pages' => range($firstPage, min($this->pageCount, $firstPage + 4)),
        ]);
    }
}
