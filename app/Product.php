<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Product extends Model
{
    public function supllier()
    {
        return $this->belongsTo('App\Suplier','supplier_id');
    }
    public function color()
    {
        return $this->belongsTo('App\Color','color_id');
    }
    public function product_color(){
        return $this->hasMany('App\ColorWiseProduct','product_id')->with('product_color');
    }
    public function product_s(){
        return $this->hasMany('App\OrderDetails','product_id');
    }
}
