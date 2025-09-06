<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Order extends Model
{
    protected $fillable = [
        'user_id','status','payment_status','total_price'
    ];

    public function orderItems(){
        return $this->hasMany('App\Models\OrderItem');
    }
    

    public function shippingAddress(){
        return $this->hasOne('App\Models\ShippingAddress');
    }

     public function user(){
        return $this->belongsTo('App\Models\User');
    }
    
}
