<?php

namespace App;

use PDF;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public $timestamps = false;

    /**
    * Relation to Order model
    */
    public function order(){
        return $this->belongsTo(Order::class);
    }

    /**
    * Relation to Type model
    */
    public function type(){
        return $this->belongsTo(Type::class);
    }
    /**
     * Generate hashed barcode name
     */
    public function generateBarcode(){
        return $this->unique_code . '-' . md5($this->unique_code . '-' . $this->id);
    }

    /**
     * Generate hashed barcode name
     * @param boolean $empty is identity show or not, default is false
     * @return PDF
     */
    public function generatePDF($empty = false){
        $pdf = PDF::loadView('tickets.print', [
            'ticket' => $this,
            'empty' => $empty,
        ])->setPaper([0, 0, 595.28, 243], 'portrait');
        return $pdf;
    }

    public function generatePDFOnline(){
      $pdf = PDF::loadView('tickets.print-online', [
          'ticket' => $this,
      ])->setPaper([0, 0, 605, 850], 'portrait');
      return $pdf;
    }

    /**
    * Activate ticket paid
    *eloquent mutator magic
  *
  *  public function setActiveDate($value){
  *    $this->attributes['active_date'] = $value;
  *  }
    */
}
