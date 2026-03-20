<?php

namespace App\Models\Newsletter;

use Illuminate\Database\Eloquent\Model;

class NewsletterSubscriber extends Model {

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
    ];
}
