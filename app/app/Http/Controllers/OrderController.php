<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller {

	/**
	 * Display the specified resource
	 */
	public function show(Request $request, Order $order) {
		$title = 'Ordine ' . $order->id_code;
		$location = 'order';
		$order->load(['order_items.product', 'address', 'payment_method', 'shipping_method']);

		return view('order.show', compact('order', 'title', 'location'));
	}
}
