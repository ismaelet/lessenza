<?php

namespace App\Livewire\Cart;

use App\Models\Order;
use App\Models\ShippingMethod as ModelsShippingMethod;
use Livewire\Attributes\On;
use Livewire\Component;

class ShippingMethod extends Component
{
    public ModelsShippingMethod $shippingMethod;

    public Order $cart;

    public function boot()
    {
        $this->cart = Order::find($this->cart->id)->load('address');
    }

    public function render()
    {
        return view('livewire.cart.shipping-method');
    }

    /**
     * Event: Update the cart information for refresh
     */
    #[On('updateCart')]
    public function updateCart(): void {}
}
