<?php

namespace App\Http\Controllers;

use App\Helpers\EcommerceHelper;
use App\Models\Address;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\ShippingMethod;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CartController extends Controller {

    /**
     * Display the cart page
     */
    public function addressIndex(Request $request) {
        $title = 'Carrello';
        $location = 'cart';
        $cart = Order::find(cart()->id);

        $shippingMethods = ShippingMethod::all();

        // Get the address from the cart
        $address = $cart->address;
        $address = $address ? $address : Auth::user()?->main_address;

        return view('cart.address', compact('cart', 'address', 'shippingMethods', 'title', 'location'));
    }

    /**
     * Update the cart address and confirm the order
     */
    public function addressStore(Request $request): RedirectResponse {
        $cart = cart();

        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'vat_number' => 'nullable|string|max:11|required_if:is_company,1',
            'cu' => 'nullable|string|max:6|required_if:is_company,1',
            'cf' => 'nullable|string|max:16|required_if:is_company,0',
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'region' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pec' => 'nullable|email|max:255|required_if:is_company,1',
            'phone' => 'nullable|string|max:20',
            'notes' => 'nullable|string|max:500',
            'is_company' => 'required|boolean',
        ]);

        $data['cf'] = $data['cf'] ? strtoupper($data['cf']) : null;

        $addressId = $cart->address_id ?? null;

        $address = Address::updateOrCreate(
            ['id' => $addressId],
            $data + ['user_id' => Auth::id()],
        );

        $cart->update(['address_id' => $address->id]);

        return redirect()->route('cart.payment');
    }

    /**
     * Display the cart payment page
     */
    public function paymentIndex(Request $request): View {
        $location = 'cart.payment';
        $cart = cart();
        $paymentMethods = PaymentMethod::all();

        return view('cart.payment', compact('cart', 'location', 'paymentMethods'));
    }

    /**
     * Update the cart payment method and confirm the order
     */
    public function paymentStore(Request $request): RedirectResponse {
        $cart = cart();

        $request->validate([
            'payment_method_id' => 'required|exists:payment_methods,id',
        ]);

        $cart->update([
            'payment_method_id' => $request->payment_method_id,
        ]);

        $paymentMethod = PaymentMethod::find($request->payment_method_id);

        if ($paymentMethod->slug === 'paypal') {
            return redirect()->route('paypal.orders.create', ['order_id' => $cart->id]);
        }

        $cart->load('order_items.product');
        $cart->confirm();

        return redirect()->route('cart.success');
    }

    /**
     * Display the cart success page
     */
    public function success(Request $request) {
        $title = 'Ordine completato';
        $location = 'cart.success';
        $cart = cart();

        return view('cart.success', compact('cart', 'title', 'location'));
    }

    /**
     * Display the order's email
     */
    public static function displayEmail(int $cartId): View {
        $order = Order::find($cartId);
        $user = Auth::user();

        if (!$order) {
            abort(404);
        }

        return view('emails.order-status', compact('order', 'user'));
    }

    /**
     * Display the empty cart page
     */
    public function empty(): View {
        $title = 'Carrello';
        $location = 'cart';

        return view('cart.empty', compact('title', 'location'));
    }
}
