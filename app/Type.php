<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use SoftDeletes;
    //ID constant (enum)
    const ID_FEST = 1;
    const ID_VIPA = 2;
    const ID_VIPB = 3;
    const ID_VVIP = 4;

    public $timestamps = false;

    /**
    * Relation to Ticket model
    */
    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}
