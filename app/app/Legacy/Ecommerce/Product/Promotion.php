<?php

namespace App\Legacy\Ecommerce\Product;

class Promotion
{
    public $id = null;

    public $price;

    public $start;

    public $end;

    public function __construct($id)
    {
        if ($data = \Legacy\System\Classes\DB::row('* FROM ecommerce_promotions WHERE id=?', [$id])) {
            $this->id = $id;
            $this->price = $data['price'];
            $this->end = $data['end'];
            $this->start = $data['start'];
        }
    }

    public function __get($name)
    {
        switch ($name) {
            case 'priceStr':
                return $this->priceStr = format_price($this->price);
        }
    }
}
