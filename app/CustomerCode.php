<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerCode extends Model
{
    public  function products(){
        return $this->belongsTo('App\Product','product_id');
    }
    public  function head_customer(){
        return $this->belongsTo('App\Head_customer','head_customer_id');
    }
}
