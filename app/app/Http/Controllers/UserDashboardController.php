<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    /**
     * Action: Index, display the user dashboard
     */
    public function index(Request $request): View
    {
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
    public function orders(Request $request): View
    {
        $user = Auth::user();
        $orders = $user->orders?->load('order_items', 'order_items.product')->sortByDesc('created_at');

        return view('user-dashboard.orders', [
            'title' => 'Ordini',
            'location' => 'user-dashboard',
            'user' => $user,
            'orders' => $orders,
        ]);
    }

    /**
     * Show the user's settings
     */
    public function settings(Request $request): View
    {
        $user = Auth::user();

        return view('user-dashboard.settings', [
            'title' => 'Impostazioni',
            'location' => 'user-dashboard',
            'user' => $user,
        ]);
    }

    /**
     * Update the user's settings
     */
    public function updateSettings(Request $request)
    {
        $user = User::find(Auth::id());

        // Validate the form data
        $validatedData = $request->validate([
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
        ]);

        // Update user information
        $user->update($validatedData);

        return redirect()->back()->with('success', 'Impostazioni aggiornate con successo.');
    }

    /**
     * Update the user's password
     */
    public function updatePassword(Request $request)
    {
        $user = User::find(Auth::id());

        // Validate the form data
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        // Check if the current password matches
        if (! password_verify($validatedData['current_password'], $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'La password corrente non è corretta.']);
        }

        // Update the user's password
        $user->password = Hash::make($validatedData['new_password']);
        $user->save();

        return redirect()->back()->with('success_password', 'Password aggiornata con successo.');
    }
}
