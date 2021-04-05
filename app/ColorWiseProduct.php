<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColorWiseProduct extends Model
{
    public function product_color(){
        return $this->belongsTo('App\Color','color_id');
    }
    public function product(){
        return $this->belongsTo('App\Product','product_id');
    }
}
