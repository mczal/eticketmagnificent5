<?php
namespace App\Repositories;

use App\Order;

class OrderRepositories{
    /**
    * Generate no_order
    * @return string
    */
    public function generateNoOrder(){
        $order = Order::where('created_at', 'like', date('Y-m-d').'%')->count();
        $number = date('ymd') . str_pad($order + 1, 4, '0', STR_PAD_LEFT);
        return $number;
    }

    /**
    * Find order by id
    * @param $id integer
    * @return Order
    */
    public function findById($id){
        $order = Order::where(['id' => $id])->first();
        return $order;
    }

    /**
    * Find order by number
    * @param $no string
    * @return Order
    */
    public function findByNo($no){
        $order = Order::where(['no_order' => $no])->first();
        return $order;
    }

    /**
    * Get all data by selected filter and pagination
    * @return Order[]
    */
    public function getAllFiltered($request){
        /*if(!empty($keyword)){
            $orders = Order::where('no_order', $keyword)->orderBy('id', 'DESC')->paginate(10);
        }else{
            $orders = Order::orderBy('id', 'DESC')->paginate(10);
        }*/
        if($request->no_order == null || $request->no_order == ''){
          if($request->name == null || $request->name == ''){
            if($request->status == null || $request->status == '' || $request->status == -1){
              $orders = Order::orderBy('id', 'DESC')->paginate(10);
            }else{
              $orders = Order::where('status',$request->status)
                              ->paginate(10);
            }
          }else{
            if($request->status == null || $request->status == '' || $request->status == -1){
              $orders = Order::where('name', 'like', $request->name.'%')
                              ->orderBy('id', 'DESC')
                              ->paginate(10);
            }else{
              $orders = Order::where('name', 'like', $request->name.'%')
                              ->where('status',$request->status)
                              ->orderBy('id', 'DESC')
                              ->paginate(10);
            }
          }
        }else{
          if($request->name == null || $request->name == ''){
            if($request->status == null || $request->status == '' || $request->status == -1){
              $orders = Order::where('no_order', 'like', $request->no_order.'%')
                              ->orderBy('id', 'DESC')->paginate(10);
            }else{
              $orders = Order::where('no_order', 'like', $request->no_order.'%')
                              ->where('status',$request->status)
                              ->orderBy('id', 'DESC')->paginate(10);
            }
          }else{
            if($request->status == null || $request->status == '' || $request->status == -1){
              $orders = Order::where('no_order', 'like', $request->no_order.'%')
                              ->where('name', 'like', $request->name.'%')
                              ->orderBy('id', 'DESC')
                              ->paginate(10);
            }else{
              $orders = Order::where('no_order', 'like', $request->no_order.'%')
                              ->where('name', 'like', $request->name.'%')
                              ->where('status',$request->status)
                              ->orderBy('id', 'DESC')
                              ->paginate(10);
            }
          }
        }

        return $orders;
    }

    /**
    * Get all datas which are expire
    * @return Order[]
    */
    public function getAllExpire(){
        $orders = Order::where('expired_date', '<=', date('Y-m-d H:i:s'))
                    ->where('status', Order::STATUS_ORDERED)
                    ->get();
        return $orders;
    }

    /**
    *Get all datas that not expire
    *@return Order[]
    */
    public function getAllActive(){
      $orders = Order::where('expired_date', '>', date('Y-m-d H-i-s'))
                    ->where('status', Order::STATUS_ORDERED)
                    ->get();
      return $orders;
    }

    public function getAllNoOrderNull(){
      $orders = Order::where('no_order',null)
                      ->orWhere('no_order','')
                      ->get();
      //dd($orders);
      return $orders;
    }
}
