<?php

namespace Item;

class Category
{
    public $id = 0;

    public $name;

    public function __construct($id)
    {
        if ($id && $row = \Legacy\System\Classes\DB::row('name FROM items_categories WHERE id=?', [$id])) {

            $this->id = $id;
            $this->name = $row['name'];
        }
    }
}
