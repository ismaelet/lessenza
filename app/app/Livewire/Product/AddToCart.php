<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Illuminate\View\View;
use Livewire\Component;

class AddToCart extends Component {

	/**
	 * Property: The product associated with the component
	 */
	public Product $product;

	/**
	 * Property: The quantity of the product to add to the cart
	 */
	public int $quantity = 1;

	/**
	 * Property: The maximum quantity allowed for the product
	 */
	public int $maxQuantity = 99;

	/**
	 * Lifecycle hook: Render the component view
	 */
	public function render(): View {
		return view('livewire.product.add-to-cart');
	}

	/**
	 * Update the quantity of the product
	 */
	public function updateQuantity(int $quantity): void {
		if ($quantity < 1) {
			$quantity = 1;
		} else if ($quantity > $this->maxQuantity) {
			$quantity = $this->maxQuantity;
		}

		$this->quantity = $quantity;
	}

	/**
	 * Event: Add the product to the cart
	 */
	public function addToCart(): void {
		// Validate the quantity
		$this->validate([
			'quantity' => 'required|integer|min:1',
		]);

		// Add the product to the cart
		cart()->add($this->product, $this->quantity);

		// Reset the quantity to 1 after adding to cart
		$this->quantity = 1;

		// Dispatch an event to update the cart
		$this->dispatch('updateCart');
	}
}
