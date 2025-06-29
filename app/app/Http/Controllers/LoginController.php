<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller {

	/**
	 * Show the login form
	 */
	public function index(): View {
		return view('auth.login', [
			'title' => 'Login',
			'location' => 'login'
		]);
	}

	/**
	 * Handle a login request to the application
	 */
	public function attempt(Request $request): RedirectResponse {
		// Validate the form data
		$request->validate([
			'email' => 'required|email',
			'password' => 'required|min:6'
		]);

		// Attempt to log the user in
		if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
			return redirect()->intended(route('user-dashboard.index'));
		}

		// If the login attempt was unsuccessful, redirect back with an error
		return back()->withErrors([
			'email' => 'Le credenziali fornite non sono corrette.'
		]);
	}
}
