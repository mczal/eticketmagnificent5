<style>
@page { margin: 0px; }
@font-face {
    font-family: neoteric-bold;
    src: {{asset('assets/fonts/NEOTERIC-Bold.ttf')}};
}
body {
    margin: 0px;
    font-family: neoteric-bold;
    background: url('{{ asset('img/bg-ticket-online.png') }}');
    font-size: 12px;
}

</style>
    <span style="position: absolute; right: 220px; top: 174px;">{{ $ticket->order ? $ticket->order->name : ' - ' }}</span>
    <span style="position: absolute; right: 220px; top: 190px;">{{ $ticket->order ? $ticket->order->id_no : ' - ' }}</span>
    <span style="position: absolute; right: 220px; top: 206px;">{{ $ticket->order ? $ticket->order->email : ' - ' }}</span>
    <span style="position: absolute; right: 220px; top: 222px;">{{ $ticket->order ? $ticket->order->handphone : ' - ' }}</span>
<b style="position: absolute; right: 100px; top: 255px; font-size:13px; z-index:3;">{{ $ticket->unique_code }}</b>
<img src="{{ asset('/qrcodes/' . $ticket->generateBarcode() . '.png') }}" alt="Barcode here" style="position: absolute; right: 80px; top: 154px; width: 120px ; height:100px; z-index:0;"/>
