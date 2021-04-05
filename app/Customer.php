<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public  function head_customer(){
        return $this->belongsTo('App\Head_customer','parent_id');
    }
}
