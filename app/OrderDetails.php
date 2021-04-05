<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    // public function product(){
    //     return $this->hasMany('App\Product','product_id');
    // }
    public  function product_S(){
        return $this->belongsTo('App\Product','product_id');
    }
    public  function order(){
        return $this->belongsTo('App\Order','order_id');
    }
    
}
