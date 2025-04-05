<?php

namespace API;

use \DB as DB;

class Wishlist {

	static function put($parameters) {

		global $user;


		if (!DB::exists('item_likes WHERE userId=? AND itemId=?', [$user->id, $parameters['itemId']])) {
			$wishId = DB::add('item_likes (userId, itemId)', [$user->id, $parameters['itemId']]);
			$result['content'] = $wishId;
		} else {
			$result['content']['error'] = 'Already exists';
		}

		return $result;
	}

	static function delete($parameters) {

		global $user;

		if (DB::exists('item_likes WHERE userId=? AND itemId=?', [$user->id, $parameters['itemId']])) {
			DB::delete('item_likes WHERE userId=? AND itemId=?', [$user->id, $parameters['itemId']]);
			$result['content'] = 'Deleted';
		} else {
			$result['content']['error'] = 'Not found';
		}

		return $result;
	}
}
