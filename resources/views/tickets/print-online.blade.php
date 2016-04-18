<style>
@page { margin: 0px; }
@font-face {
    font-family: neoteric-bold;
    src: {{asset('assets/fonts/NEOTERIC-Bold.ttf')}};
}
body {
    margin: 0px;
    font-family: neoteric-bold;
    background: url('{{ asset('img/bg-ticket-online.png') }}') no-repeat;
    font-size: 12px;
}

</style>
    <span style="position: absolute; left: 66px; top: 220px; font-size:23.5px; font-weight:bold; ">{{ $ticket->type ? $ticket->type->name : '' }}</span>
    <span style="position: absolute; left: 66px; top: 341px; font-size:15px; ">{{ $ticket->order ? $ticket->order->name : '' }}</span>
    <span style="position: absolute; left: 66px; top: 383.5px; font-size:15px; ">{{ $ticket->order ? $ticket->order->no_order : '' }}</span>

    <span style="position: absolute; left: 455px; top: 383.5px; font-size:15px; ">{{ $ticket->type ? 'Rp.'.number_format($ticket->type->price) : '' }}</span>
    <!-- <span style="position: absolute; right: 220px; top: 190px;">{{ $ticket->order ? $ticket->order->id_no : ' - ' }}</span>
    <span style="position: absolute; right: 220px; top: 206px;">{{ $ticket->order ? $ticket->order->email : ' - ' }}</span>
    <span style="position: absolute; right: 220px; top: 222px;">{{ $ticket->order ? $ticket->order->handphone : ' - ' }}</span> -->
<!-- <b style="position: absolute; right: 100px; top: 255px; font-size:13px; z-index:3;">{{ $ticket->unique_code }}</b> -->
<img src="{{ asset('/qrcodes/' . $ticket->generateBarcode() . '.png') }}" alt="Barcode here" style="position: absolute; right: 100px; top: 194.95px; width: 170px ; height:160px; z-index:0;"/>
<span style="position: absolute; left: 564px; top: 343.68px; font-size:15px; font-weight:bold; z-index:3; ">{{ $ticket->order ? $ticket->unique_code : '' }}</span>

<span style="position: absolute; right: 10px; top: 1060px; font-size:12.5px; ">{{ $ticket->type ? $ticket->type->name : '' }}</span>
<span style="position: absolute; right: 10px; top: 1078px; font-size:12.5px; ">{{ $ticket->order ? $ticket->unique_code : '' }}</span>
<span style="position: absolute; right: 10px; top: 1094px; font-size:12.5px; ">{{ $ticket->type ? 'Rp.'.number_format($ticket->type->price) : '' }}</span>
