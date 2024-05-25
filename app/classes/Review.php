<?php

use Structure\DatabaseObject;

class Review {

	use DatabaseObject;

	public const TABLE = 'global_reviews';
	public const INDEX = 'id';

	public $id;
	public $location;
	public $text;
	public $rating;
	public $contactUrl;
	public $time;
	public $name;

	/*
	* Get methods
	*/
	// cover image
	private function getImage() {
		return '/uploads/reviews/' . $this->id;
	}

	private function getClientImage() {
		return public_client_path($this->image);
	}

	private function getServerImage() {
		return public_server_path($this->image);
	}

	private function getHasImage() {
		return file_exists($this->serverImage);
	}

	// icon
	private function getIcon() {
		return '/uploads/reviews/' . $this->id . '-icon';
	}

	private function getClientIcon() {
		return public_client_path($this->icon);
	}

	private function getServerIcon() {
		return public_server_path($this->icon);
	}

	private function getHasIcon() {
		return file_exists($this->serverIcon);
	}
}
