<?php

namespace API;

use \DB;
use \Item;

class Items {

	// GET request
	public static function get($requestContent, $id = false) {
		$results = [];
		$scope = explode(',', $requestContent['scope']);
		$searchFor = $requestContent['search'];
		$resultRows = DB::select("id FROM items WHERE id=? OR name LIKE CONCAT('%',?,'%') LIMIT ?", [$searchFor, $searchFor, $requestContent['limit']]);

		while ($resultRow = $resultRows->fetch_assoc()) {
			$result = [];
			$item = new Product($resultRow['id']);

			foreach ($scope as $field) {
				$result[$field] = $item->$field;
			}

			$results[] = $result;
		}

		$response['content'] = $results;

		return $response;
	}
}
