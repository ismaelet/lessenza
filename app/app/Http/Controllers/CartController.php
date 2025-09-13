<?php

namespace App\Http\Controllers;

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

		$request->validate([
			'full_name' => 'required|string|max:255',
			'street' => 'required|string|max:255',
			'number' => 'required|string|max:255',
			'city' => 'required|string|max:255',
			'zip' => 'required|string|max:20',
			'region' => 'required|string|max:255',
			'email' => 'required|email|max:255',
			'phone' => 'required|string|max:20',
			'notes' => 'nullable|string|max:500',
		]);

		$address = $cart->address ?: Auth::user()?->main_address;

		if (!$address) {
			$address = Address::create([
				'user_id' => Auth::id(),
				'full_name' => $request->full_name,
				'street' => $request->street,
				'number' => $request->number,
				'city' => $request->city,
				'zip' => $request->zip,
				'region' => $request->region,
				'email' => $request->email,
				'phone' => $request->phone,
				'notes' => $request->notes,
			]);
		} else {
			$address->update($request->only([
				'full_name',
				'street',
				'number',
				'city',
				'zip',
				'region',
				'email',
				'phone',
				'notes',
			]));
		}

		$cart->update([
			'address_id' => $address->id,
		]);

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
