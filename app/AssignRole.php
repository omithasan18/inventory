<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssignRole extends Model
{
    public  function role_name(){
        return $this->belongsTo('App\Role','role_id');
    }
}
