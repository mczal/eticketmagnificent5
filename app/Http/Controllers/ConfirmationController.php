<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DNS1D;
use Mail;
use PDF;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ConfirmationRepositories;
use App\Repositories\OrderRepositories;
use App\Confirmation;
use App\Order;

class ConfirmationController extends Controller
{
    protected $confirmations;
    protected $orders;

    public function __construct(ConfirmationRepositories $confirmations, OrderRepositories $orders){
        $this->middleware('auth');
        $this->confirmations = $confirmations;
        $this->orders = $orders;
        //dd($this->orders->getAllActive());
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
        //$confirmation = Confirmation::where(['id' => 2])->first();

        //dd($confirmation->order->tickets);
        //dd($confirmation);
        //--
        $status = $request->status;
        $confirmations = $this->confirmations->getAllFiltered($status);
        //dd($confirmations);
        return view('confirmations.index',[
            'confirmations' => $confirmations,
        ]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('confirmations.create',[
          'orders' => $this->orders->getAllActive(),
        ]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $this->validate($request,[
            'no_rekening' => 'required',
            'nama_bank' => 'required',
            'name' => 'required',
            'total_transfer' => 'required',
            'no_order' => 'required',
        ]);

        $order = $this->orders->findByNo($request->no_order);

        if($order === null){
            return redirect('/confirmations/create')->with('error_message', 'Order <b>#' . $request->no_order . '</b> not found');
        }elseif($order->status == Order::STATUS_EXPIRE){
            return redirect('/confirmations/create')->with('error_message', 'Order <b>#' . $request->no_order . '</b> was expire');
        }elseif($order->status == Order::STATUS_PAID){
            return redirect('/confirmations/create')->with('error_message', 'Order <b>#' . $request->no_order . '</b> was paid');
        }

        $confirmation = new Confirmation;
        $confirmation->order_id = $order->id;
        $confirmation->no_rekening = $request->no_rekening;
        $confirmation->nama_bank = $request->nama_bank;
        $confirmation->total_transfer = $request->total_transfer;
        $confirmation->save();

        /*Mail::send('emails.order', ['order' => $order], function($m) use ($order){
            $m->from('wilianto.indra@gmail.com', 'Parahyangan Fair');
            $m->to($order->email, $order->name);
            $m->subject('Thank you for order');
        });*/

        return redirect('/confirmations')->with('success_message', 'Confirmation was created');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $confirmation = Confirmation::where(['id' => $id])->first();
        return view('confirmations.show',[
            'confirmation' => $confirmation,
        ]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $confirmation = Confirmation::where(['id' => $id])->first();
        return view('confirmations.edit',[
            'confirmation' => $confirmation,
        ]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $request)
	{
        $this->validate($request,[
            'no_rekening' => 'required',
            'nama_bank' => 'required',
            'total_transfer' => 'required',
        ]);

        $confirmation = Confirmation::where(['id' => $id])->first();
        $confirmation->no_rekening = $request->no_rekening;
        $confirmation->nama_bank = $request->nama_bank;
        $confirmation->total_transfer = $request->total_transfer;
        $confirmation->save();

        return redirect('/confirmations')->with('success_message', 'Confirmation id:<b>' . $confirmation->id . '</b> was saved.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $confirmation = Confirmation::where(['id' => $id])->first();
        $order = $confirmation->order;
        //
        $order->email = $order->email."exp".rand(1, 999);
        //dd($order->email); //debug
        //
        $confirmation->order()->dissociate();
        foreach($order->tickets as $ticket){
          $ticket->order()->dissociate();
          $ticket->order_date = null;
          $ticket->active_date = null;
          $ticket->save();
        }
        //here
        $order->status = Order::STATUS_EXPIRE;
        $order->no_order = null;
        $order->save();
        $order->delete();
        $confirmation->delete();

        return redirect('/confirmations')->with('success_message', 'Confirmation id:<b>' . $confirmation->id . '</b> was deleted.');
	}

  /**
	 * Validate Order (set )
	 *
	 * @param  int  $id
	 * @return Response
	 */
   public function validateOrder(Request $request){
     $confirmation = Confirmation::where(['id' => $request->id])->first();
     $order = $confirmation->order;
     $order->status = \App\Order::STATUS_PAID;
     $order->save();
     //dd($order);
     foreach($confirmation->order->tickets as $ticket){
       $ticket->active_date = date('Y-m-d H:i:s');
       $ticket->save();
     }
     $confirmation->status = Confirmation::STATUS_PAID;
     $confirmation->save();

     //sent ticket to customer by email
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

     return redirect('/confirmations')->with('success_message', 'Confirmation id:<b>' . $confirmation->id . '</b> was active.');

   }

   public function resendMail(Request $request){
     $confirmation = Confirmation::where(['id' => $request->id])->first();
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
     return redirect('/confirmations')->with('success_message', 'Email Confirmation id:<b>' . $confirmation->id . '</b> with all of its ticket registered was sent.');
   }

}
