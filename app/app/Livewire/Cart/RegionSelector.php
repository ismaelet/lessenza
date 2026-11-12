<?php

namespace App\Livewire\Cart;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Modelable;
use Livewire\Component;

class RegionSelector extends Component
{
    public Address $address;

    #[Modelable]
    public ?string $region = null;

    public Order $cart;

    /**
     * Lifecycle hook: Bootstraps the component
     */
    public function boot()
    {
        $this->cart = Order::find(cart()->id);
        $address = $this->cart->address ?: Auth::user()?->main_address;

        if (! $address) {
            $address = Address::create([
                'user_id' => Auth::id(),
            ]);
        }

        $this->cart->update([
            'address_id' => $address->id,
        ]);

        $this->address = $address;
        $this->region = $address->region;
    }

    /**
     * Lifecycle hook: Renders the component
     */
    public function render()
    {
        return view('livewire.cart.region-selector');
    }

    public function updatedRegion(): void
    {
        $this->address->update([
            'region' => $this->region,
        ]);

        $this->cart->recalculatePrices();

        $this->dispatch('updateCart', showSidebar: false);
    }
}
