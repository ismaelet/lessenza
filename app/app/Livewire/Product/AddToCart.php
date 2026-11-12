<?php

namespace App\Livewire\Product;

use App\Models\Order;
use App\Models\Product;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class AddToCart extends Component
{
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
     * Property: Whether the product is extra concentrated
     */
    public bool $extraConcentrated = false;

    /**
     * Lifecycle hook: Render the component view
     */
    public function render(): View
    {
        return view('livewire.product.add-to-cart');
    }

    /**
     * Event: Add the product to the cart
     */
    public function addToCart(): void
    {
        // Validate the quantity
        $this->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Add the product to the cart
        $newCart = cart() === null;
        $cart = cart() ?? Order::createCart();
        $cart->add($this->product, $this->quantity, $this->extraConcentrated);

        // Dispatch an event to update the cart
        $this->dispatch('updateCart');

        // Dispatch an event for analytics tracking
        if ($newCart) {
            $this->dispatch('meta-initiate-checkout', [
                'cart_id' => $cart->id,
            ]);
        }

        $this->dispatch('meta-add-to-cart', [
            'product_id' => $this->product->id,
            'quantity' => $this->quantity,
            'name' => $this->product->name,
            'price' => $this->product->price($this->quantity, $this->extraConcentrated),
        ]);

        // Reset the quantity to 1 after adding to cart
        $this->quantity = 1;
    }

    /**
     * Event: Handle updates to the extra concentrated option
     */
    #[On('extraConcentratedUpdated')]
    public function extraConcentratedUpdated(bool $value): void
    {
        $this->extraConcentrated = $value;
    }
}
