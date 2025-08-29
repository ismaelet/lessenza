<?php

namespace App\Livewire\Cart;

use App\Models\Order;
use Livewire\Attributes\On;
use Livewire\Component;

class Recap extends Component {

	/**
	 * Property: The cart order
	 */
	public Order $cart;

	/**
	 * Lifecycle hook: Render the component view
	 */
	public function render() {
		return view('livewire.cart.recap');
	}

	/**
	 * Event: Update the cart information for refresh
	 */
	#[On('updateCart')]
	public function updateCart(): void {
		$this->cart = Order::find($this->cart->id);

		if (!$this->cart->quantity()) {
			$this->redirectRoute('cart.empty');
		}
	}
}
