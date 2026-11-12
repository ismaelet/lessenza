<?php

namespace App\Legacy\Ecommerce;

class PaymentMethod
{
    public $id = null;

    public $name;

    public $slug;

    public function __construct($id)
    {
        if ($data = \Legacy\System\Classes\DB::row('* FROM ecommerce_payments WHERE id=?', [$id])) {
            $this->id = $id;
            $this->name = $data['name'];
            $this->slug = $data['slug'];
            $this->info = $data['info'];
        }
    }
}
