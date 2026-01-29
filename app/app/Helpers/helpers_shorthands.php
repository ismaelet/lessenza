<?php

use App\Helpers\ArrayHelper;
use App\Helpers\FileHelper;
use App\Helpers\SettingsHelper;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

/**
 * Check if the user is an admin
 */
function is_admin(): bool {
    return Auth::check() && Auth::user()->is_admin;
}

/**
 * Check if the user is a superadmin
 */
function is_superadmin(): bool {
    return Auth::check() && Auth::user()->is_superadmin;
}

/**
 * Get the path to a public asset
 */
function public_asset(string $path): string {
    if (env('APP_ENV') === 'local') {
        return asset('storage/' . $path);
    }

    return '/public/storage/' . $path;
}
