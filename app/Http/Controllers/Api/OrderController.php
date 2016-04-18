<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\Ticket;
use App\Type;
use App\Repositories\OrderRepositories;
use App\Repositories\TypeRepositories;
use App\Repositories\TicketRepositories;

class OrderController extends Controller
{

    protected $orders;
    protected $types;
    protected $tickets;

    /**
    * Create a new controller instance.
    *
    * @param  OrderRepositories  $orders
    * @return void
    */
    public function __construct(OrderRepositories $orders, TypeRepositories $types, TicketRepositories $tickets){
        $this->orders = $orders;
        $this->types = $types;
        $this->tickets = $tickets;
    }
    /**
    * Cancel every order which expire and detach their tickets
    */
    public function cancel(){
      //dd("1");
        //TODO: find more effisien query technique
        $orders = $this->orders->getAllExpire();
        //dd($orders);
        foreach($orders as $order){
            $order->status = Order::STATUS_EXPIRE;
            $order->email = $order->email."exp".rand(1, 999);
            foreach($order->tickets as $ticket){
                $ticket->order_date = NULL;
                $ticket->order()->dissociate();
                $ticket->save();
            }
            echo "ID #{$order->no_order} is expire. <br>";
            $order->no_order = null;
            $order->save();


            //TODO: send email to customer, is it need?
        }
    }
}
