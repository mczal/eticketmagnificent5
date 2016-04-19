<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\Confirmation;
use App\Ticket;
use App\Repositories\OrderRepositories;
use App\Repositories\TypeRepositories;
use App\Repositories\TicketRepositories;
use App\Repositories\ConfirmationRepositories;

class FrontendController extends Controller
{
    protected $orders;
    protected $types;
    protected $tickets;
    protected $confirmations;

    /**
    * Create a new controller instance.
    *
    * @param  OrderRepositories  $orders
    * @return void
    */
    public function __construct(ConfirmationRepositories $confirmations,OrderRepositories $orders, TypeRepositories $types, TicketRepositories $tickets){
        $this->orders = $orders;
        $this->types = $types;
        $this->tickets = $tickets;
        $this->confirmations = $confirmations;
    }

    public function welcome(){
        return view('frontend.welcome');
    }

    public function buy(){
        $remaining_tickets = $this->tickets->countTicketsRemaining(env('ACTIVE_TICKET_TYPE'));
        $price = $this->types->findById(env('ACTIVE_TICKET_TYPE'))->price;
        return view('frontend.register', [
            'remaining_tickets' => $remaining_tickets,
            'price' => $price,
        ]);
    }

    public function confirmation(){
        return view('frontend.confirmation');
    }

    public function buyStore(Request $request){

      $this->validate($request, [
          'ctfest1' => 'required|integer|min:0|max:4',
          'ctvipa2' => 'required|integer|min:0|max:4',
          'ctvipb3' => 'required|integer|min:0|max:4',
          'ctvvip4' => 'required|integer|min:0|max:4',
          'name' => 'required',
          'email' => 'required|unique:orders|email',
          'handphone' => 'required',
      ]);

      $sumAll = (1*$request->ctfest1) + (1*$request->ctvipa2) + (1*$request->ctvipb3) + (1*$request->ctvvip4);
      //dd($sumAll.' '.$request->ctfest1);
      if($sumAll <= 0 ){
        return redirect('/orders/create')->with('error_message','Tidak ada tiket yang ingin dipesan');
      }

      //this is validate count ticket left section with countordered
      if($this->tickets->countTicketsRemaining(Type::ID_FEST) < $request->ctfest1){
        //TYPE 1 FESTIVAL
        return redirect('/orders/create')->with('error_message','Jumlah Tiket Festival Tidak Cukup');
      }else if($this->tickets->countTicketsRemaining(Type::ID_VIPA) < $request->ctvipa2){
        //TYPE 2 VIP A
        // dd($this->tickets->countTicketsRemaining(Type::ID_VIPA).' '.$request->ctvipa2);
        return redirect('/orders/create')->with('error_message','Jumlah Tiket VIP A Tidak Cukup');
      }else if($this->tickets->countTicketsRemaining(Type::ID_VIPB) < $request->ctvipb3){
        //TYPE 3 VIP B
        return redirect('/orders/create')->with('error_message','Jumlah Tiket VIP B Tidak Cukup');
      }else if($this->tickets->countTicketsRemaining(Type::ID_VVIP) < $request->ctvvip4){
        //TYPE 4 VVIP
        return redirect('/orders/create')->with('error_message','Jumlah Tiket VVIP Tidak Cukup');
      }

      $order = new Order;
      $order->fill($request->all());
      $order->no_order = $this->orders->generateNoOrder();
      $order->expired_date = date('Y-m-d H:i:s', time() + (3600 * 10)); //10 hours
      $order->status = Order::STATUS_ORDERED;
      $order->save();

      $sumPrice = 0;
      $quantity = 0;

      if($request->ctfest1 > 0){
        $tickets = Ticket::where('type_id', Type::ID_FEST)
                        ->where('order_date', NULL)
                        ->limit($request->ctfest1)
                        ->get();
        foreach ($tickets as $ticket ) {
          $ticket->order()->associate($order);
          $ticket->order_date = date('Y-m-d H:i:s');
          $ticket->save();
          $sumPrice += $ticket->type->price;
          $quantity++;
        }
      }

      if($request->ctvipa2 > 0){
        $tickets = Ticket::where('type_id', Type::ID_VIPA)
                        ->where('order_date', NULL)
                        ->limit($request->ctvipa2)
                        ->get();
        foreach ($tickets as $ticket ) {
          $ticket->order()->associate($order);
          $ticket->order_date = date('Y-m-d H:i:s');
          $ticket->save();
          $sumPrice += $ticket->type->price;
          $quantity++;
        }
      }

      if($request->ctvipb3 > 0){
        $tickets = Ticket::where('type_id', Type::ID_VIPB)
                        ->where('order_date', NULL)
                        ->limit($request->ctvipb3)
                        ->get();
        foreach ($tickets as $ticket ) {
          $ticket->order()->associate($order);
          $ticket->order_date = date('Y-m-d H:i:s');
          $ticket->save();
          $sumPrice += $ticket->type->price;
          $quantity++;
        }
      }

      if($request->ctvvip4 > 0){
        $tickets = Ticket::where('type_id', Type::ID_VVIP)
                        ->where('order_date', NULL)
                        ->limit($request->ctvvip4)
                        ->get();
        foreach ($tickets as $ticket) {
          $ticket->order()->associate($order);
          $ticket->order_date = date('Y-m-d H:i:s');
          $ticket->save();
          $sumPrice += $ticket->type->price;
          $quantity++;
        }
      }

      $order->total_price = $sumPrice;
      $order->quantity = $quantity;
      $order->save();

      $tickets = $order->tickets;
      Mail::send('emails.order', ['order' => $order , 'tickets' => $tickets], function($m) use ($order){
          $m->from('no-reply@fivelivemagnificent.com', 'Five Live Magnificent 2016');
          $m->to($order->email, $order->name);
          $m->subject('Order Five Live Magnificent');
      });

        return view('frontend.register_success', [
            'email' => $order->email,
        ]);
    }

    public function confirmationStore(Request $request){
        $this->validate($request,[
            'no_rekening' => 'required',
            'nama_bank' => 'required',
            'name' => 'required',
            'total_transfer' => 'required',
            'no_order' => 'required',
        ]);

        $order = $this->orders->findByNo($request->no_order);

        if($order === null){
            return redirect('/confirmation')->with('error_message', 'Order <b id="fourth">#' . $request->no_order . '</b> not found');
        }elseif($order->status == Order::STATUS_EXPIRE){
            return redirect('/confirmation')->with('error_message', 'Order <b id="fourth">#' . $request->no_order . '</b> was expire');
        }elseif($order->status == Order::STATUS_PAID){
            return redirect('/confirmation')->with('error_message', 'Order <b id="fourth">#' . $request->no_order . '</b> was paid');
        }elseif(count($this->confirmations->forOrder($order)) > 0){
           return redirect('/confirmation')->with('error_message', 'Confirmation for order <b id="fourth">#' . $request->no_order . '</b> was already received');
        }

        $order->status = Order::STATUS_CONFIRMED;
        $order->save();

        $confirmation = new Confirmation;
        $confirmation->name = $request->name;
        $confirmation->order_id = $order->id;
        $confirmation->no_rekening = $request->no_rekening;
        $confirmation->nama_bank = $request->nama_bank;
        $confirmation->total_transfer = $request->total_transfer;
        $confirmation->save();

        return view('frontend.confirmation_success', [
            'email' => $confirmation->order->email,
        ]);
    }
}
