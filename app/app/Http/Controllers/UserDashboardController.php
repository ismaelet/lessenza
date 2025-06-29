<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserDashboardController extends Controller {

	/**
	 * Action: Index, display the user dashboard
	 */
	public function index(Request $request): View {
		$user = Auth::user();

		return view('user-dashboard.index', [
			'title' => 'Profilo',
			'location' => 'user-dashboard',
			'user' => $user,
			'address' => $user->main_address,
		]);
	}

	/**
	 * Show the user's orders
	 */
	public function orders(Request $request): View {
		$user = Auth::user();
		$orders = $user->orders?->load('order_items', 'order_items.product')->sortByDesc('created_at');

		return view('user-dashboard.orders', [
			'title' => 'Ordini',
			'location' => 'user-dashboard',
			'user' => $user,
			'orders' => $orders,
		]);
	}
}
