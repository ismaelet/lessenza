<?php

namespace Blog;

use Structure\DatabaseObject;

class Video {

	use DatabaseObject;

	public const TABLE = 'videos';
	public const INDEX = 'id';

	public $id;
	public $url;

	/**
	 * Transform the video URL into an embedded URL
	 */
	public function embeddedVideoUrl(): ?string {
		$queryParams = [];
		$parsedUrl = parse_url($this->url);

		parse_str($parsedUrl['query'], $queryParams);

		$videoId = $queryParams['v'] ?? null;

		return $videoId ? 'https://www.youtube.com/embed/' . $videoId : null;
	}
}
