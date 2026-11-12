<?php

namespace App\Legacy\Ecommerce\Product;

use Structure\DatabaseObject;

class Type
{
    use DatabaseObject;

    public const TABLE = 'ecommerce_product_types';

    public const INDEX = 'id';

    public $id = null;

    public $name;

    public $names;

    private $category;

    private $status;

    private $time;

    /*
    * Get methods
    */
    private function getPluralName()
    {
        return $this->names ?: $this->name;
    }
}
