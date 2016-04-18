<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

// use PDF;
// use QrCode;
// use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ticket;
use App\Repositories\TicketRepositories;
use App\Repositories\TypeRepositories;
use App\Repositories\OrderRepositories;
//API to Android SECTION
class TicketController extends Controller{
  public $tickets;
  public function __construct(TicketRepositories $tickets){
    // Apply the jwt.auth middleware to all methods in this controller
    // except for the authenticate method. We don't want to prevent
    // the user from retrieving their token if they don't already have it
    $this->middleware('jwt.auth');
    $this->tickets = $tickets;
  }

  /**
	 * set check in attribute on ticket specified by given unique_code to datenow
	 *
	 * @return Response::json (ticket data)
	 */
  public function checkIn(Request $request){
    //dd('ijal');
    // $this->validate($request, [
    //   'token' => 'required',
    //   'unique_code' => 'required',
    // ]);

    $ticket = $this->tickets->findByUniqueCode($request->unique_code);
    if($ticket == null ||  $ticket == ''){
      return response()->json([
        'error' => 'error',
        'status' => 404,
        'message' => 'ticket not found',
      ]);
    }else{
      $order = $ticket->order;
      if($ticket->order_date == null || $ticket->order_date == ''){
        return response()->json([
          'error' => 'error',
          'status' => 406,
          'message' => 'ticket hasn\'t been ordered',
        ]);
      }else{
        if($ticket->active_date == null  || $ticket->active_date == ''){
          return response()->json([
            'error' => 'error',
            'status' => 402,
            'message' => 'ticket hasn\'t been activated',
            'data' => $order,
          ]);
        }else{
          if($ticket->check_in_date == null || $ticket->check_in_date == ''){
            $ticket->check_in_date = date('Y-m-d H:i:s');
            //dd($order);
            $ticket->save();
            return response()->json([
              'error' => 'success',
              'status' => 200,
              'message' => 'ticket has been activated',
              'data' => $order,
            ]);
          }else{
            return response()->json([
              'error' => 'error',
              'status' => 403,
              'message' => 'someone has already using your ticket',
              'data' => $order,
            ]);
          }
        }
      }
    }
  }

  // /**
	//  * get ticket data from unique_code
	//  * @param $unique_id
	//  * @return Response::json
	//  */
  //  public function getTicketData($code){
  //    //dd('ijal');
  //    $ticket = $this->tickets->findByUniqueCode($code);
  //    if($ticket==null || $ticket==''){
  //      return response()->json([
  //        'error' => 'error',
  //      ]);
  //    }else{
  //      return response()->json($ticket);
  //    }
  //  }

}
