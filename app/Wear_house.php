<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wear_house extends Model
{
    public function warehouse(){
        return $this->hasMany('App\WearhouseProduct','wear_house_id');
    }
}
