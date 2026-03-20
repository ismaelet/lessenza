<?php

namespace App\Http\Controllers;

use App\Models\Newsletter\NewsletterSubscriber;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    /**
     * Show the registration form
     */
    public function register(): View {
        return view('auth.register', [
            'title' => 'Registrazione',
            'location' => 'register'
        ]);
    }

    /**
     * Handle a registration request to the application
     */
    public function registerAttempt(Request $request): RedirectResponse {
        // Validate the form data
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'marketing_opt_in' => 'boolean'
        ]);

        // Create the user
        $user = User::create([
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);

        // Subscribe the user to the newsletter if they opted in
        if ($request->boolean('marketing_opt_in') && !NewsletterSubscriber::where('email', $request->input('email'))->exists()) {
            NewsletterSubscriber::create([
                'email' => $request->input('email'),
            ]);
        }

        // Log the user in
        Auth::login($user);

        return redirect()->intended(route('user-dashboard.index'))
            ->with('meta_complete_registration', true);
    }
}
