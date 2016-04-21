<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;
use DNS1D;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Order;
use App\Ticket;
use App\Type;
use App\Confirmation;
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
        $this->middleware('auth');
        $this->orders = $orders;
        $this->types = $types;
        $this->tickets = $tickets;
    }

    /**
    * Types list view
    * @param Request
    */
    public function index(Request $request){
        $no_order = $request->no_order;
        $name = $request->name;
        $orders = $this->orders->getAllFiltered($request);

        return view('orders.index', [
            'no_order' => $no_order,
            'name' => $name,
            'orders' => $orders,
        ]);
    }

    /**
    * Show create form
    */
    public function create(){
        $types = $this->types->getAllActive();
        return view('orders.create', [
            'types' => $types,
        ]);
    }

    /**
    * Show data id
    */
    public function show($id){
        $order = $this->getModel($id);
        $timeLeft = "";
        if($order->expired_date != null){
          $timeLeft = round((strtotime($order->expired_date) - strtotime(date('Y-m-d H:i:s')))/60);
          //dd($timeLeft);
        }
        //dd($timeLeft);
        return view('orders.show', [
            'order' => $order,
            'timeLeft' => $timeLeft,
        ]);
    }

    public function edit($id){
        //saat ini belum dibutuhkan
        $order = $this->orders->findById($id);
        return view('orders.edit',[
          'order' => $order,
        ]);
    }

    public function update(Request $request,$id){
      $order = $this->orders->findById($id);
      $this->validate($request, [
        'name' => 'required',
        'handphone' => 'required',
        'email' => 'required',
      ]);
      $order->fill($request->all());
      $order->save();
      return redirect('/orders')->with('success_message', 'Order no_order : <b>' . $order->no_order . '</b> was saved.');
    }

    /**
    * Delete the selected data
    */
    public function destroy($id){

        $order = $this->getModel($id);
        $order->delete();

        return redirect('/orders')->with('success_message', 'Order <b>#' . $order->no_order . '</b> was deleted.');
    }

    /**
    * Process create form
    */
    public function store(Request $request){
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
        $countTicketsFest = $this->tickets->countTicketsRemaining(Type::ID_FEST);
        $countTicketsVipA = $this->tickets->countTicketsRemaining(Type::ID_VIPA);
        $countTicketsVipB = $this->tickets->countTicketsRemaining(Type::ID_VIPB);
        $countTicketsVvip = $this->tickets->countTicketsRemaining(Type::ID_VVIP);
        if($countTicketsFest < $request->ctfest1){
          //TYPE 1 FESTIVAL
          return redirect('/orders/create')->with('error_message','Jumlah Tiket Festival Tidak Cukup');
        }else if($countTicketsVipA < $request->ctvipa2){
          //TYPE 2 VIP A
          // dd($this->tickets->countTicketsRemaining(Type::ID_VIPA).' '.$request->ctvipa2);
          return redirect('/orders/create')->with('error_message','Jumlah Tiket VIP A Tidak Cukup');
        }else if($countTicketsVipB < $request->ctvipb3){
          //TYPE 3 VIP B
          return redirect('/orders/create')->with('error_message','Jumlah Tiket VIP B Tidak Cukup');
        }else if($countTicketsVvip < $request->ctvvip4){
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

        return redirect('/orders')->with('success_message', 'Order #<b>' . $order->no_order . '</b> was created.');
    }

    /**
    * Cancel every order which expire and detach their tickets
    */
    // public function cancel(){
    //     //TODO: find more effisien query technique
    //     $orders = $this->orders->getAllExpire();
    //     foreach($orders as $order){
    //         $order->status = Order::STATUS_EXPIRE;
    //         foreach($order->tickets as $ticket){
    //             $ticket->order_date = NULL;
    //             $ticket->order()->dissociate();
    //             $ticket->save();
    //         }
    //         $order->save();
    //         echo "ID #{$order->no_order} is expire. <br>";
    //
    //         //TODO: send email to customer, is it need?
    //     }
    // }

    /**
    * Get order model by Id
    * @return Order
    */
    private function getModel($id){
        $model = $this->orders->findById($id);

        if($model === null){
            abort(404);
        }

        return $model;
    }

    /**
    * store order offline ticks
    *     --order stored with this method with automatically activate the ticket
    *
    */
    public function storeOfflineOrder(Request $request){

      $this->validate($request, [
          'ctfest1' => 'required|integer|min:0|max:4',
          'ctvipa2' => 'required|integer|min:0|max:4',
          'ctvipb3' => 'required|integer|min:0|max:4',
          'ctvvip4' => 'required|integer|min:0|max:4',
          'name' => 'required',
          'email' => 'required|email',
          'handphone' => 'required',
          'no_rekening' => 'required',
          'nama_bank' => 'required',
          'total_transfer' => 'required',
      ]);

      $sumAll = (1*$request->ctfest1) + (1*$request->ctvipa2) + (1*$request->ctvipb3) + (1*$request->ctvvip4);
      //dd($sumAll.' '.$request->ctfest1);
      if($sumAll <= 0 ){
        return redirect('/orders/create-offline')->with('error_message','Tidak ada tiket yang ingin dipesan');
      }

      //this is validate count ticket left section with countordered
      $countTicketsFest = $this->tickets->countTicketsRemaining(Type::ID_FEST);
      $countTicketsVipA = $this->tickets->countTicketsRemaining(Type::ID_VIPA);
      $countTicketsVipB = $this->tickets->countTicketsRemaining(Type::ID_VIPB);
      $countTicketsVvip = $this->tickets->countTicketsRemaining(Type::ID_VVIP);
      if($countTicketsFest < $request->ctfest1){
        //TYPE 1 FESTIVAL
        return redirect('/orders/create-offline')->with('error_message','Jumlah Tiket Festival Tidak Cukup');
      }else if($countTicketsVipA < $request->ctvipa2){
        //TYPE 2 VIP A
        // dd($this->tickets->countTicketsRemaining(Type::ID_VIPA).' '.$request->ctvipa2);
        return redirect('/orders/create-offline')->with('error_message','Jumlah Tiket VIP A Tidak Cukup');
      }else if($countTicketsVipB < $request->ctvipb3){
        //TYPE 3 VIP B
        return redirect('/orders/create-offline')->with('error_message','Jumlah Tiket VIP B Tidak Cukup');
      }else if($countTicketsVvip < $request->ctvvip4){
        //TYPE 4 VVIP
        return redirect('/orders/create-offline')->with('error_message','Jumlah Tiket VVIP Tidak Cukup');
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
          $ticket->active_date = date('Y-m-d H:i:s');
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
          $ticket->active_date = date('Y-m-d H:i:s');
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
          $ticket->active_date = date('Y-m-d H:i:s');
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
          $ticket->active_date = date('Y-m-d H:i:s');
          $ticket->save();
          $sumPrice += $ticket->type->price;
          $quantity++;
        }
      }

      $order->total_price = $sumPrice;
      $order->quantity = $quantity;
      $order->status = Order::STATUS_PAID;
      $order->save();

      $confirmation = new Confirmation;
      $confirmation->name = $request->name;
      $confirmation->order_id = $order->id;
      $confirmation->no_rekening = $request->no_rekening;
      $confirmation->nama_bank = $request->nama_bank;
      $confirmation->total_transfer = $request->total_transfer;

      $confirmation->status = Confirmation::STATUS_PAID;
      $confirmation->save();

       //Mail
       Mail::send('emails.ticket-send', ['confirmation' => $confirmation], function($m) use ($confirmation){
           $m->from('no-reply@fivelivemagnificent.com', 'Five Live Magnificent 2016');
           $m->to($confirmation->order->email, $confirmation->order->name);
           $m->subject('Ticket Five Live Magnificent');

           foreach($confirmation->order->tickets as $ticket){
               $barcode =  "data:image/png;base64,".DNS1D::getBarcodePNG($ticket->unique_code, "C128");
               $pdf = $ticket->generatePDFOnline($barcode);
               $m->attachData($pdf->output(), $ticket->unique_code.'.pdf');
           }
       });

      //EOF Confirmation
        return redirect('/orders/create-offline')->with('success_message','Success creating actived(PAID) order online and send ticket to email input');
    }
    //
    public function createOffline(){
      //dd('ijal'); //debug section
      $remainingTicketsFest = $this->tickets->countTicketsRemaining(Type::ID_FEST);
      $remainingTicketsVipA = $this->tickets->countTicketsRemaining(Type::ID_VIPA);
      $remainingTicketsVipB = $this->tickets->countTicketsRemaining(Type::ID_VIPB);
      $remainingTicketsVvip = $this->tickets->countTicketsRemaining(Type::ID_VVIP);
      $countTicketsFest = $this->tickets->countTicketsRemaining(Type::ID_FEST);
      $countTicketsVipA = $this->tickets->countTicketsRemaining(Type::ID_VIPA);
      $countTicketsVipB = $this->tickets->countTicketsRemaining(Type::ID_VIPB);
      $countTicketsVvip = $this->tickets->countTicketsRemaining(Type::ID_VVIP);
      $priceFest = $this->types->findById(Type::ID_FEST)->price;
      $priceVipA = $this->types->findById(Type::ID_VIPA)->price;
      $priceVipB = $this->types->findById(Type::ID_VIPB)->price;
      $priceVvip = $this->types->findById(Type::ID_VVIP)->price;

      return view('orders.create-offline', [
          'countTicketsFest' => $countTicketsFest,
          'countTicketsVipA' => $countTicketsVipA,
          'countTicketsVipB' => $countTicketsVipB,
          'countTicketsVvip' => $countTicketsVvip,
          'remainingTicketsFest' => $remainingTicketsFest,
          'remainingTicketsVipA' => $remainingTicketsVipA,
          'remainingTicketsVipB' => $remainingTicketsVipB,
          'remainingTicketsVvip' => $remainingTicketsVvip,
          'priceFest' => $priceFest,
          'priceVipA' => $priceVipA,
          'priceVipB' => $priceVipB,
          'priceVvip' => $priceVvip,
      ]);
    }

    public function resendMailOnlineOrder(Request $request){
      $order = $this->orders->findById($request->id);
      // dd($order);
      $tickets = $order->tickets;
      Mail::send('emails.order', ['order' => $order , 'tickets' => $tickets], function($m) use ($order){
          $m->from('no-reply@fivelivemagnificent.com', 'Five Live Magnificent 2016');
          $m->to($order->email, $order->name);
          $m->subject('Order Five Live Magnificent');
      });

      return redirect('/orders');
    }


}
