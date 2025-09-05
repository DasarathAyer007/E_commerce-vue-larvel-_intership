<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class OrderItem extends Model
{
    protected $fillable=[
        'id','order_id','product_id','quantity','price'
];

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
