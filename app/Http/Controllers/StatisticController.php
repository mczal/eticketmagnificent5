<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\TypeRepositories;
use App\Repositories\TicketRepositories;
use App\Repositories\OrderRepositories;
use App\Repositories\ConfirmationRepositories;

class StatisticController extends Controller
{
    //
    protected $orders;
    protected $types;
    protected $tickets;
    protected $confirmations;

    public function __construct(TypeRepositories $types, TicketRepositories $tickets, OrderRepositories $orders, ConfirmationRepositories $confirmations){
      $this->middleware('auth');
      $this->orders = $orders;
      $this->types = $types;
      $this->tickets = $tickets;
      $this->confirmations = $confirmations;
    }

    public function index(){
      $types = $this->types->getAllActive();
      return view('statistic.index',[
        'types' => $types,
      ]);
    }

    public function show($id){
      $type = $this->types->findById($id);
      $remaining = $this->tickets->countTicketsRemaining($id);
      $total = count($types->tickets);
      $ordered = $this->tickets->countTicketOrdered($id);
      $actived = $this->tickets->countTicketActived($id);
      $checkedIn = $this->tickets->countTicketCheckedIn($id);
      return view('statistic.show',[
        'type' => $type,
        'remaining' => $remaining,
        'total' => $total,
        'ordered' => $ordered,
        'actived' => $actived,
        'checkedIn' => $checkedIn,
      ]);
    }

}
