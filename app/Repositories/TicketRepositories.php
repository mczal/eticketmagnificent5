<?php
  namespace App\Repositories;

  use App\Ticket;
  use App\Order;
  use App\Type;

  class TicketRepositories{

    public function forType(Type $type){
        return Ticket::where('type_id', $type->id)
                    ->orderBy('id', 'asc')
                    ->get();
    }

    public function forOrder(Order $order){
        return Ticket::where('order_id', $order->id)
                    ->orderBy('id', 'asc')
                    ->get();
    }

    public function forTypeNotOrdered(Type $type){
      return Ticket::where('type_id',$type->id)
                    ->whereNull('order_date')
                    ->orderBy('id', 'asc')
                    ->get();
    }

    public function findByUniqueCode($unique_code){
      return Ticket::where('unique_code', $unique_code)->first();
    }

    public function countTicketsRemaining($type_id){
        return Ticket::where('type_id', $type_id)
                    ->where('order_date', NULL)
                    ->count();
    }

    public function countTicketOrdered($type_id){
      return Ticket::where('type_id',$type_id)
                    ->whereNotNull('order_date')
                    ->count();
    }

    public function countTicketActived($type_id){
      return Ticket::where('type_id',$type_id)
                    ->whereNotNull('active_date')
                    ->count();
    }

    public function countTicketCheckedIn($type_id){
      return Ticket::where('type_id',$type_id)
                    ->whereNotNull('active_date')
                    ->count('check_in_date');
    }

    public function getAllFiltered($request){
      if($request->unique_code == null || $request->unique_code == ''){
        if($request->type == null || $request->type == ''){
          if($request->filter == 'all'){
            return Ticket::paginate(20);
          }else if($request->filter == 'not_ordered'){
            return Ticket::where('order_date' , null)->paginate(20);
          }else if($request->filter == 'ordered'){
            return Ticket::whereNotNull('order_date')
                          ->whereNotIn('order_date',[''])
                          ->paginate(20);
          }else if($request->filter == 'actived'){
            return Ticket::whereNotNull('active_date')
                          ->whereNotIn('active_date' , [''])
                          ->paginate(20);
          }else if($request->filter == 'checked_in'){
            return Ticket::whereNotNull('check_in_date')
                          ->whereNotIn('check_in_date' , [''])
                          ->paginate(20);
          }else{
            //DONE
            return Ticket::paginate(20);
          }
        }else{
          //dd($request->type);
          if($request->filter == 'all'){
            return Ticket::whereIn('type_id',$request->type)
                          ->paginate(20);
          }else if($request->filter == 'not_ordered'){
            return Ticket::where('order_date' , null)
                          ->whereIn('type_id',$request->type)
                          ->paginate(20);
          }else if($request->filter == 'ordered'){
            return Ticket::whereNotNull('order_date')
                          ->whereNotIn('order_date',[''])
                          ->whereIn('type_id',$request->type)
                          ->paginate(20);
          }else if($request->filter == 'actived'){
            return Ticket::whereNotNull('active_date')
                          ->whereNotIn('active_date' , [''])
                          ->whereIn('type_id',$request->type)
                          ->paginate(20);
          }else if($request->filter == 'checked_in'){
            return Ticket::whereNotNull('check_in_date')
                          ->whereNotIn('check_in_date' , [''])
                          ->whereIn('type_id',$request->type)
                          ->paginate(20);
          }else{
            return Ticket::whereIn('type_id',$request->type)
                          ->paginate(20);
          }
        }
      }else{
        if($request->type == null || $request->type == ''){
          if($request->filter == 'all'){
            //dd(2);
            return Ticket::where('unique_code' , 'like' , '%'.$request->unique_code.'%')
                          ->paginate(20);
          }else if($request->filter == 'not_ordered'){
            return Ticket::where('order_date' , null)
                          ->where('unique_code' , 'like' , '%'.$request->unique_code.'%')
                          ->paginate(20);
          }else if($request->filter == 'ordered'){
            return Ticket::whereNotNull('order_date')
                          ->where('unique_code' , 'like' , '%'.$request->unique_code.'%')
                          ->paginate(20);
          }else if($request->filter == 'actived'){
            return Ticket::whereNotNull('active_date')
                          ->where('unique_code' , 'like' , '%'.$request->unique_code.'%')
                          ->paginate(20);
          }else if($request->filter == 'checked_in'){
            return Ticket::whereNotNull('check_in_date')
                          ->where('unique_code', 'like' , '%'.$request->unique_code.'%')
                          ->paginate(20);
          }else{
            return Ticket::where('unique_code' , 'like' , '%'.$request->unique_code.'%')
                          ->paginate(20);
          }
        }else{
          if($request->filter == 'all'){
            return Ticket::whereIn('type_id',$request->type)
                          ->where('unique_code' , 'like' , '%'.$request->unique_code.'%')
                          ->paginate(20);
          }else if($request->filter == 'not_ordered'){
            return Ticket::where('order_date' , null)
                          ->whereIn('type_id',$request->type)
                          ->where('unique_code' , 'like' , '%'.$request->unique_code.'%')
                          ->paginate(20);
          }else if($request->filter == 'ordered'){
            return Ticket::whereNotNull('order_date')
                          ->whereIn('type_id',$request->type)
                          ->where('unique_code' , 'like' , '%'.$request->unique_code.'%')
                          ->paginate(20);
          }else if($request->filter == 'actived'){
            return Ticket::whereNotNull('active_date')
                          ->whereIn('type_id',$request->type)
                          ->where('unique_code' , 'like' , '%'.$request->unique_code.'%')
                          ->paginate(20);
          }else if($request->filter == 'checked_in'){
            return Ticket::whereNotNull('check_in_date')
                          ->whereIn('type_id',$request->type)
                          ->where('unique_code' , 'like' , '%'.$request->unique_code.'%')
                          ->paginate(20);
          }else{
            return Ticket::whereIn('type_id',$request->type)
                          ->where('unique_code' , 'like' , '%'.$request->unique_code.'%')
                          ->paginate(20);
          }
        }
      }
    }

  }

 ?>
