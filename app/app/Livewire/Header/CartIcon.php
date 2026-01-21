<?php

namespace App\Livewire\Header;

use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CartIcon extends Component {

    /**
     * Property: The quantity of items in the cart
     */
    public int $quantity;

    /**
     * Lifecycle hook: Initialize the component
     */
    public function mount(): void {
        $this->quantity = cart()?->quantity() ?? 0;
    }

    /**
     * Lifecycle hook: Render the component view
     */
    public function render(): View {
        return view('livewire.header.cart-icon');
    }

    /**
     * Event: Update the cart quantity
     */
    #[On('updateCart')]
    public function updateCart(): void {
        $this->quantity = cart()?->quantity() ?? 0;
    }
}
