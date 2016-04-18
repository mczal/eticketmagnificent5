<?php
  namespace App\Repositories;

  use App\Order;
  use App\Confirmation;

  class ConfirmationRepositories{

    public function getAllFiltered($keyword = ''){
      if(!empty($keyword)){
        if($keyword == '-1'){

          $confirmations = Confirmation::orderBy('created_at','asc')->paginate(15);
        }else{
          $confirmations = Confirmation::where(['status' => $keyword])
                                    ->orderBy('created_at' , 'asc')
                                    ->paginate(15);
        }
      }else{
        if($keyword == '0'){
          $confirmations = Confirmation::where(['status' => $keyword])
                                    ->orderBy('created_at' , 'asc')
                                    ->paginate(15);
        }else{
          $confirmations = Confirmation::orderBy('created_at','asc')->paginate(15);
        }
      }
      return $confirmations;
    }

    public function forOrder(Order $order){
        return Confirmation::where('order_id', $order->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }

  }

 ?>
