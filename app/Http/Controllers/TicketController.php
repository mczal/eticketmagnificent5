<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PDF;
use QrCode;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ticket;
use App\Repositories\TicketRepositories;
use App\Repositories\TypeRepositories;
use App\Repositories\OrderRepositories;

class TicketController extends Controller
{
    protected $tickets;
    protected $types;
    protected $orders;

    public function __construct(OrderRepositories $orders,TicketRepositories $tickets, TypeRepositories $types){
        $this->middleware('auth');
        $this->tickets = $tickets;
        $this->types = $types;
        $this->orders = $orders;
    }

    public function index(Request $request)
	{
        $tickets = $this->tickets->getAllFiltered($request);
        $types = $this->types->getAll();

        return view('tickets.index', [
          'tickets' => $tickets,
          'types' => $types,
        ]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('tickets.create', [
            'types' => $this->types->getAllActive(),
        ]);
	}

    /**
    * My Function GENERATOR UNIQUE
    *
    */
    private function generateCode(){
        $code = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $result = "";
        for($i=0;$i<10;$i++){
            $result.=$code[rand(0,35)];
        }
        return $result;
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $ticketType = $request->type;
        $amount = $request->amount;

        $this->validate($request, [
            'type' => 'required',
            'amount' => 'required',
        ]);

        for($i=0;$i<$amount;$i++){
            $ticket = new Ticket;
            $ticket->unique_code = $this->generateCode();
            $ticket->type_id = $ticketType;
            $ticket->order_id = 'null';
            $ticket->save();
            QrCode::format('png')->size(400)->generate($ticket->unique_code, '../public/qrcodes/'.$ticket->generateBarcode().'.png');
        }

        return redirect('/tickets')->with('success_message', '<b>'.$amount.'</b> tickets was created.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        //$ticket = Ticket::find($id);
        $ticket = Ticket::where(['id' => $id])->first();
        return view('tickets.show',[
            'ticket' => $ticket,
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
        //$ticket = Ticket::find($id);
        $ticket = Ticket::where(['id' => $id])->first();
        return view('tickets.edit',[
            'ticket' => $ticket,
        ]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
        $this->validate($request, [
            'unique_code' => 'required',
            'type_id' => 'required',
        ]);

        $ticket = Ticket::where(['id' => $id])->first();

        $ticket->unique_code = $request->unique_code;
        $ticket->order_id = $request->order_id;
        $ticket->type_id = $request->type_id;
        // echo "a".$request->active_date."a ".$request->order_date;
        // exit();
        if($request->order_date > '0000-00-00'){
            $ticket->order_date = $request->order_date;
        }
        if($request->active_date > '0000-00-00'){
            $ticket->active_date = $request->order_date;
        }
        if($request->check_in_date > '0000-00-00'){
            $ticket->check_in_date = $request->check_in_date;
        }
        $ticket->save();

        return redirect('/tickets')->with('success_message', 'Ticket id:<b>' . $ticket->id . '</b> was saved.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $ticket = Ticket::where(['id' => $id])->first(); //apa bedanya dengan find($id) ??
        $ticket->delete();

        return redirect('/tickets')->with('success_message', 'Ticket id:<b>' . $ticket->id . '</b> was deleted.');
	}

    /**
     * Print e-ticket
     *
     * @param Request $request
	 * @return Response
     */
    public function printTicket(Request $request){
        $ticket = Ticket::find($request->unique_code);

        return $ticket->generatePDF()->stream();

        // $tickets = Ticket::paginate(10);
        // foreach($tickets as $ticket){
        //     echo $ticket->generatePDF()->stream();
        // }

        // Mail::send('emails.order', ['order' => $ticket->order], function($m) use ($pdf, $ticket){
        //     $m->from('wilianto.indra@gmail.com', 'Ticket Parahyangan Fair');
        //     $m->to($ticket->order->email, $ticket->order->name);
        //     $m->subject('Thank you for order');
        //     $m->attachData($pdf->output(), 'test.pdf');
        // });

        // return view('tickets.print', [
        //     'ticket' => $ticket,
        // ]);
    }

}
