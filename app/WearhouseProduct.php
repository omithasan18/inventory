<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WearhouseProduct extends Model
{
    public function warehouse()
    {
        return $this->belongsTo('App\Wear_house','wear_house_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Product','product_id');
    }
    public function color()
    {
        return $this->belongsTo('App\Color','color_id');
    }
}
