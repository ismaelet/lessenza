<?php

use Illuminate\Support\Facades\Auth;

/**
 * Check if the user is an admin
 */
function is_admin(): bool
{
    return Auth::check() && Auth::user()->is_admin;
}

/**
 * Check if the user is a superadmin
 */
function is_superadmin(): bool
{
    return Auth::check() && Auth::user()->is_superadmin;
}

/**
 * Get the path to a public asset
 */
function public_asset(string $path): string
{
    return asset('storage/'.$path);
}
