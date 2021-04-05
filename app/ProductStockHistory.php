<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductStockHistory extends Model
{
    public  function product_S(){
        return $this->belongsTo('App\Product','product_id');
    }
    public  function color(){
        return $this->belongsTo('App\Color','color_id');
    }
    public  function supplier(){
        return $this->belongsTo('App\Suplier','supplier_id');
    }
}
