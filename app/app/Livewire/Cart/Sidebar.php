<?php

namespace App\Livewire\Cart;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Sidebar extends Component
{
    /**
     * Property: The current cart
     */
    public ?Order $cart;

    /**
     * Property: The order items in the cart
     */
    public ?Collection $orderItems = null;

    /**
     * Property: Whether the sidebar is shown
     */
    public bool $show = false;

    /**
     * Lifehook cycle: Boot the component
     */
    public function boot(): void
    {
        $this->cart = cart();
        $this->orderItems = $this->cart?->order_items;
    }

    /**
     * Lifehook cycle: Render the component view
     */
    public function render(): View
    {
        return view('livewire.cart.sidebar');
    }

    /**
     * Event: Update the cart when an order item is added, removed, or updated
     */
    #[On('updateCart')]
    public function updateCart($showSidebar = true): void
    {
        if ($this->cart->quantity > 0 && $showSidebar) {
            $this->show = true;
        }
    }
}
