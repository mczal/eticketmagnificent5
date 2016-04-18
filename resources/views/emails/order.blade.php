<br>
Terima kasih atas pemesanan anda!

Berikut detail pemesanan Ticket anda. Pembayaran paling lambat 10 jam setelah pemesanan. <br>
Lewat dari 10 jam, data akan terhapus secara otomatis dan pemesanan dianggap batal. <br>
<br>
Pemesanan Atas Nama : <br>
Nama : {{$order->name}}<br>
E-mail: {{$order->email}} <br>
No. Telp: {{$order->handphone}} <br>
<br>
Informasi Pemesanan :<br>
    <p style="margin-left: 40px; font-family:'Arial'">
      Tickets Detail :<br><br>
      @foreach($tickets as $ticket)
        {{ $ticket->type->name }} 1 @Rp.{{number_format($ticket->type->price)}}<br>
      @endforeach
    </p><br>
No. Order : <b>{{$order->no_order}}</b> <br>
Total Kuantitas : {{$order->quantity}} <br>
Total Harga : Rp.{{number_format($order->total_price)}} <br>
<br>
Cara Pembayaran : <br>
Silahkan transfer ke rekening kami dibawah ini : <br>
BCA <br>
Account Name : 1391951034 <br>
Account Holder : Yayan Ardiansyah <br>
 <br>
Setelah melakukan pembayaran klik URL berikut untuk konfirmasi :<br>
<a href="http://www.parahyanganfair.com/confirmation">CONFIRMATION PAYMENT PAGE</a><br>
<br>
<strong>*Jika anda telah melakukan pembayaran namun belum melakuka konfirmasi,
   pemesanan dianggap <font color="red">BATAL</font> </strong> <br>
<br>
Bantuan:<br>
Jika ada pertanyaan silahkan hubungi <br>
081320007147 ( ilhammuliawanh) <br>
<br>
Terima kasih, <br>
Five Live Magnificent 2016 <br>
<br>
================================================================== <br>
<br>
Thank you for your order!

The following is your detailed ticket order. Payment must be made within 10 hours after
the purchase. After the 10 hours limit has been passed, data will be erased automatically and
the purchase will be canceled. <br>
<br>
Purchase by:<br>
Name : {{$order->name}}<br>
E-mail: {{$order->email}} <br>
No. Telp: {{$order->handphone}} <br>
<br>
Order Information :<br>
  <p style="margin-left: 40px; font-family:'Arial'">
    Tickets Detail :<br><br>
    @foreach($tickets as $ticket)
      {{ $ticket->type->name }} 1 @Rp.{{number_format($ticket->type->price)}}<br>
    @endforeach
  </p><br>
Order No. : <b>{{$order->no_order}}</b> <br>
Total Quantity : {{$order->quantity}} <br>
Total Price : Rp.{{number_format($order->total_price)}}<br>
<br>
Payment Method: <br>
Bank Tranfer <br>
BCA <br>
Account Name : 1391951034 <br>
Account Holder : Yayan Ardiansyah <br>
 <br>
After the payment had been made, please follow the link below to confirm your payment:<br>
<a href="#">CONFIRMATION PAYMENT PAGE</a><br>
<br>
<strong>*If your payment had been made but did not confirm, the purchase will be <font color="red">CANCELED</font> </strong> <br>
<br>
Inquiries:<br>
For further information please contact <br>
081320007147 ( ilhammuliawanh) <br>
<br>
Thank you, <br>
Five Live Magnificent 2016 <br>
<br>


<!--This is your order detail:<br>
no order    : {{ $order->no_order }}<br>
quantity    : {{ $order->quantity }}<br>
total       : {{ $order->total_price }}<br><br>

Your tickets send with this email attachments.
If you don't get it, please contact us on +xxx xxxx xxxx-->
