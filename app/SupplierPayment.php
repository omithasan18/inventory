<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    public function supllier()
    {
        return $this->belongsTo('App\Suplier','supplier_id');
    }
}
