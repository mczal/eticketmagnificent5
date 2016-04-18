<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    //

    const STATUS_NOT_PAID = 0;
    const STATUS_PAID = 1;

    public function order(){
      return $this->belongsTo(Order::class);
    }
}
