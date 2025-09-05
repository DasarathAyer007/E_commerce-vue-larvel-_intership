<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
     protected $fillable = [
           'order_id',
            'phone',
            'address',
            'city',
            'postal_code'
    ];
}
