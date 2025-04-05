<?php

namespace Legacy\System\Traits;

use DB;

trait ConstructFromDatabase {
	function __construct(int $id = null) {
		if ($dbData = \Legacy\System\Classes\DB::row('* FROM ' . self::TABLE . ' WHERE ' . self::INDEX . ' = ?', [$id])) {
			foreach ($dbData as $field => $value) {
				$this->{$field} = $value;
			}
		}
	}
}
