This is your ticket detail:<br>
@foreach($tickets as $ticket)
  Ticket Code : {{$ticket->unique_code}}<br>
  Tipe : {{$ticket->type->name}}<br>
  <br><br>
@endforeach
