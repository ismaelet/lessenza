<?php

namespace App\Models;

use App\Helpers\FileHelper;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	/**
	 * Get the date the post was created in a human-readable format.
	 * 
	 * @return string
	 */
	public function date(): string {
		return $this->created_at->translatedFormat('j F Y');
	}

	/**
	 * Get the URL of the post.
	 * 
	 * @return string
	 */
	public function url(): string {
		return route('posts.show', ['post' => $this->id]);
	}

	/**
	 * Get the URL for the post image.
	 * 
	 * @param string $size The size of the image ['full', 'thumbnail'].
	 * @return string 
	 */
	public function image(string $size = 'full'): ?string {
		$imagePath = 'blog/' . $this->id . '-' . $size . '.webp';

		if (!FileHelper::exists($imagePath)) {
			return null;
		}

		return '/storage/app/public/' . $imagePath;
	}

	/**
	 * Get a short version of the post text.
	 * 
	 * @param int $charLimit The character limit for the text.
	 * @return string
	 */
	public function snippet(int $charLimit = 100): string {
		if (strlen($this->text) > $charLimit + 3) {
			return substr($this->text, 0, $charLimit) . '...';
		}

		return $this->text;
	}

	/**
	 * Get the related posts.
	 * This method retrieves the latest 5 posts excluding the current one.
	 * 
	 * @return Collection
	 */
	public function relatedPosts(): Collection {
		return self::where('id', '!=', $this->id)
			->latest()
			->take(5)
			->get();
	}
}
