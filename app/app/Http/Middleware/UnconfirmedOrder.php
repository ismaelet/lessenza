<?php

namespace App\Http\Middleware;

use App\Helpers\EcommerceHelper;
use App\Models\Order;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UnconfirmedOrder {

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse {
        $order = null;

        if ($request->order) {
            $order = $request->order;
        }

        if ($request->order_id) {
            $order = Order::find($request->order_id);
        }

        if ($order && in_array($order->status, [EcommerceHelper::status('open'), EcommerceHelper::status('payment_pending')])) {
            return $next($request);
        }

        return redirect()->route('cart');
    }
}
