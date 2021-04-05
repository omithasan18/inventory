<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
     public function head_customer()
    {
        return $this->belongsTo('App\Head_customer','head_customer_id');
    }
}
