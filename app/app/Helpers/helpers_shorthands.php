<?php

use App\Helpers\ArrayHelper;
use App\Helpers\FileHelper;
use App\Helpers\SettingsHelper;
use Illuminate\Support\Facades\Auth;

/**
 * Check if the user is an admin
 * 
 * @return bool Whether the user is an admin
 */
function is_admin(): bool {
	return Auth::check() && Auth::user()->is_admin;
}

/**
 * Check if the user is a superadmin
 * 
 * @return bool Whether the user is a superadmin
 */
function is_superadmin(): bool {
	return Auth::check() && Auth::user()->is_superadmin;
}

/**
 * Explode a string by the last occurrence of a separator
 * 
 * @param string $separator The separator to explode the string by
 * @param string|null $string The string to explode
 */
function explode_last($separator, $string): array {
	return ArrayHelper::explodeLast($separator, $string);
}

/**
 * Get the versioned path of a file in the public storage directory
 * 
 * @param string $path The path to the file
 * @return string The versioned path to the file
 */
function public_asset(string $path): string {
	return FileHelper::publicAsset($path);
}

/**
 * Import an SVG and embed it in the HTML
 * 
 * @param string $fileName
 * @param array $customClasses
 */
function embed_svg(string $fileName, array $customClasses = []): ?string {
	return FileHelper::embedSvg($fileName, $customClasses);
}

/**
 * Import an icon and embed it in the HTML
 * 
 * @param string $fileName
 * @param array $customClasses
 */
function embed_icon(string $fileName, array $customClasses = []): ?string {
	return FileHelper::embedIcon($fileName, $customClasses);
}

/**
 * Get the app color scheme
 * 
 * @return string
 */
function get_color_scheme(): string {
	return SettingsHelper::getColorScheme();
}
