<style>
@page { margin: 0px; }
body {
    margin: 0px;
    font-family: helvetica;
    background: url('{{ asset('img/bg-ticket.png') }}')
}
</style>

@if($empty === false)
    <span style="position: absolute; left: 18px; top: 48px;">{{ $ticket->order ? $ticket->order->name : '' }}</span>
    <span style="position: absolute; left: 18px; top: 106px;">{{ $ticket->order ? $ticket->order->id_no : '' }}</span>
    <span style="position: absolute; left: 18px; top: 168px;">{{ $ticket->order ? $ticket->order->email : '' }}</span>
    <span style="position: absolute; left: 18px; top: 228px;">{{ $ticket->order ? $ticket->order->handphone : '' }}</span>
@endif
<b style="position: absolute; left: 275px; top: 284px;">{{ $ticket->unique_code }}</b>
<b style="position: absolute; left: 150px; top: 284px;">{{ $ticket->unique_code }}</b>
<img src="{{ asset('/qrcodes/' . $ticket->generateBarcode() . '.png') }}" alt="Barcode here" style="position: absolute; right: 7px; top: 137.5px; width: 175px"/>
<!--<span style="position: absolute; left: 275px; top: 8px; color: #FFFFFF; text-transform: uppercase">{{ $ticket->type->name }}</span>-->
