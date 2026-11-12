<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable
     */
    protected $fillable = [
        'user_id',
        'full_name',
        'vat_number',
        'cu',
        'cf',
        'street',
        'number',
        'city',
        'zip',
        'region',
        'email',
        'pec',
        'phone',
        'notes',
        'is_company',
    ];

    /**
     * Get the full address as a formatted string
     */
    public function fullAddress(): Attribute
    {
        return new Attribute(
            get: fn () => [
                $this->full_name,
                $this->street.', '.$this->number,
                $this->zip.' '.$this->city.' ('.$this->region.')',
            ]
        );
    }
}
