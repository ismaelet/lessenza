<?php

namespace App\Legacy\Traits;

use App\Legacy\System\DB;

trait ConstructFromDatabase
{
    public function __construct(?int $id = null)
    {
        if ($dbData = DB::row('* FROM '.self::TABLE.' WHERE '.self::INDEX.' = ?', [$id])) {
            foreach ($dbData as $field => $value) {
                $this->{$field} = $value;
            }
        }
    }
}
