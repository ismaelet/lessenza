<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileHelper {

	/**
	 * Move a file to the public storage directory
	 * 
	 * @param \Illuminate\Http\UploadedFile $file The file to move
	 * @param string $path The path to the file
	 * @return bool Whether the file was moved
	 */
	public static function upload(UploadedFile $file, string $filePath): bool {
		$fileDirectory = ArrayHelper::explodeLast('/', $filePath)[0];
		$fileName = ArrayHelper::explodeLast('/', $filePath)[1];

		if (Storage::disk('public')->exists($filePath)) {
			Storage::disk('public')->delete($filePath);
		}

		$storedFile = $file->storeAs($fileDirectory, $fileName, 'public');

		return (bool) $storedFile;
	}

	/**
	 * Check if a file exists in the storage
	 * 
	 * @param string $path The path to the file
	 * @return bool Whether the file exists
	 */
	public static function exists(string $path): bool {
		return Storage::disk('public')->exists($path);
	}

	/**
	 * Delete a file from the storage
	 * 
	 * @param string $path The path to the file
	 * @return bool Whether the file was deleted
	 */
	public static function delete(string $path): bool {
		return Storage::disk('public')->delete($path);
	}

	/**
	 * Get the versioned path of a file in the public storage directory.
	 * 
	 * @param string $path The path to the file
	 * @return string The versioned path to the file
	 */
	public static function publicAsset(string $path): string {
		$fullPath = asset('storage/' . $path);

		if (self::exists($path)) {
			return $fullPath . '?v=' . filemtime(storage_path('app/public/' . $path));
		}

		return $fullPath;
	}

	/**
	 * Import an icon and embed it in the HTML
	 * 
	 * @param string $fileName The name of the svg file
	 * @param array $customClasses The custom classes to add to the svg element
	 */
	public static function embedSvg(string $fileName, array $customClasses = []): string {
		$fileName = str_replace('.', '/', $fileName);

		$classes = implode(' ', $customClasses);

		$filePath = base_path() . '/resources/svg/' . $fileName . '.svg';

		$file = file_get_contents($filePath);

		return str_replace('<svg', '<svg class="' . $classes . '"', $file);
	}
}
