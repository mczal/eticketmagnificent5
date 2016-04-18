<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    //status constant
    const STATUS_EXPIRE = 0;
    const STATUS_ORDERED = 1;
    const STATUS_CONFIRMED = 2;
    const STATUS_PAID = 3;

    //id_type constant
    // const ID_KTP = 'ktp';
    // const ID_SIM = 'sim';
    // const ID_KTM = 'ktm';
    // const ID_KP = 'kartu_pelajar';
    // const ID_LAINNYA = 'lainnya';

    protected $fillable = ['name', 'address', 'email', 'handphone', 'id_type', 'id_no', 'quantity', 'type_id'];

    /**
    * Relation to Ticket model
    */
    public function tickets(){
        return $this->hasMany(Ticket::class);
    }

    /**
    * Relation to Confirmation model
    */
    public function confirmation(){
        return $this->hasOne(Confirmation::class);
    }

    // /**
    // * Relation to Type model
    // */
    // public function type(){
    //     return $this->belongsTo(Type::class);
    // }

    /**
    * Static function to get id_type options
    *
    * @param $index integer
    * @return array|string
    */
    // public static function getIdTypeList($index = ''){
    //     $arr = [
    //         self::ID_KTP => 'KTP',
    //         self::ID_SIM => 'SIM',
    //         self::ID_KTM => 'SIM',
    //         self::ID_KP => 'Kartu Pelajar',
    //         self::ID_LAINNYA => 'Lainnya',
    //     ];
    //
    //     return ($index === '') ? $arr : (isset($arr[$index]) ? $arr[$index] : null);
    // }

    /**
    * Static function to get status options
    *
    * @param $index integer
    * @return array|string
    */
    public static function getStatusList($index = ''){
        $arr = [
            self::STATUS_EXPIRE => 'Expire',
            self::STATUS_ORDERED => 'Belum Bayar',
            self::STATUS_CONFIRMED => 'Sudah Konfirmasi',
            self::STATUS_PAID => 'Sudah Bayar',
        ];

        return ($index === '') ? $arr : (isset($arr[$index]) ? $arr[$index] : null);
    }
}
