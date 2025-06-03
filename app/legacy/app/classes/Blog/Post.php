<?php

namespace Blog;

use DB;
use Structure\DatabaseObject;

class Post {

	use DatabaseObject;

	public const TABLE = 'blog_posts';
	public const INDEX = 'id';

	public $id;
	public $title;
	public $text;
	public $time;
	public $video_url;

	/*
	* Misc methods
	*/
	public function text(int $charLimit = 100) {
		$text = $this->text;

		if (strlen($text) > $charLimit + 3) {
			$text = substr($text, 0, $charLimit) . '...';
		}

		return $text;
	}

	/*
	* Get methods
	*/
	private function getUrl() {
		return '/blog/post?id=' . $this->id;
	}

	private function getClientUrl() {
		return client_url($this->url);
	}

	private function getDate() {
		return strtolower(translate_date(format_date($this->time, 'd F Y')));
	}

	public function getImage(string $size = 'full') {
		return '/uploads/blog/' . $this->id . '-' . $size;
	}

	private function getClientImage(string $size = 'full') {
		return public_client_path($this->getImage($size));
	}

	private function getServerImage(string $size = 'full') {
		return public_server_path($this->getImage($size));
	}

	private function getHasImage() {
		return file_exists($this->serverImage);
	}

	/**
	 * Transform the video URL into an embedded URL
	 */
	public function embeddedVideoUrl(): ?string {
		$queryParams = [];
		$parsedUrl = parse_url($this->video_url);

		parse_str($parsedUrl['query'], $queryParams);

		$videoId = $queryParams['v'] ?? null;

		return $videoId ? 'https://www.youtube.com/embed/' . $videoId : null;
	}

	// related posts
	private function getRelatedPosts() {
		return rows_to_objects(\Legacy\System\Classes\DB::select(self::INDEX . ' FROM ' . self::TABLE . ' WHERE ' . self::INDEX . ' <> ? ORDER BY ' . self::INDEX . ' DESC', [$this->id]), self::class);
	}
}
