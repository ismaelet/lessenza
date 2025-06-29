<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LogoutController extends Controller {

	/**
	 * Handle a logout request to the application
	 */
	public function index(Request $request): View {
		return view('auth.logout', [
			'title' => 'Logout',
			'location' => 'logout'
		]);
	}

	/**
	 * Log the user out of the application
	 */
	public function attempt(Request $request): RedirectResponse {
		// Log the user out
		Auth::logout();

		// Invalidate the session
		$request->session()->invalidate();

		// Regenerate the CSRF token
		$request->session()->regenerateToken();

		// Redirect to the home page with a success message
		return redirect(route('home'))->with('success', 'Sei stato disconnesso con successo.');
	}
}
