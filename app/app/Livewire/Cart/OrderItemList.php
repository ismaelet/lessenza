<?php

namespace App\Livewire\Cart;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class OrderItemList extends Component {

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
	public function boot(): void {
		$this->orderItems = $this->orderItems->load(['order', 'product']);
		$this->cart = $this->orderItems->first()->order ?? cart();
		$this->editable = !((bool) $this->cart->status);
	}

	/**
	 * Lifecycle hook: Render the component view
	 */
	public function render(): View {
		return view('livewire.cart.order-item-list');
	}

	/**
	 * Event: Remove an order item
	 */
	public function removeOrderItem(int $orderItemId): void {
		$this->cart->removeItem($this->orderItems->find($orderItemId));

		$this->orderItems = $this->cart->order_items;

		$this->dispatch('updateCart');
	}
}
