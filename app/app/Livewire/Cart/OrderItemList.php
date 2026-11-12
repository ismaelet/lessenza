<?php

namespace App\Livewire\Cart;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class OrderItemList extends Component
{
    /**
     * Property: The order items to display
     */
    public Collection $orderItems;

    /**
     * Property: The order associated with the order items
     */
    public Order $cart;

    /**
     * Property: Whether the order items are editable
     */
    public bool $editable = false;

    /**
     * Lifecycle hook: Initialize the component
     */
    public function boot(): void
    {
        $this->cart = cart();
        $this->orderItems = $this->orderItems->load(['product']);
        $this->editable = ! ((bool) $this->cart->status);
    }

    /**
     * Lifecycle hook: Render the component view
     */
    public function render(): View
    {
        return view('livewire.cart.order-item-list');
    }

    /**
     * Event: Remove an order item
     */
    public function removeOrderItem(int $orderItemId): void
    {
        $orderItem = $this->cart->order_items->find($orderItemId);

        if (! $orderItem) {
            return;
        }

        $this->cart->removeItem($orderItem);

        $this->orderItems = $this->cart->order_items()->with('product')->get();

        $this->dispatch('updateCart', false);
    }
}
