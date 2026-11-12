<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    /**
     * Get the default payment method
     */
    public static function default(): PaymentMethod
    {
        return PaymentMethod::orderBy('id')->first();
    }
}
