<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public  function customer(){
        return $this->belongsTo('App\Customer','customer_id');
    }
    public  function seller(){
        return $this->belongsTo('App\User','seller_id');
    }
    public  function head_customer(){
        return $this->belongsTo('App\Head_customer','head_customer_id');
    }
    public function order(){
        return $this->hasMany('App\OrderDetails','order_id')->where('order_status',2);
    }
    // public  function product(){
    //     return $this->belongsTo('App\Product','product_id');
    // }
}
