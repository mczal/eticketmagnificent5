Thank you for your order!

The following is your detailed ticket order. Payment must be made within 10 hours after
the purchase. After the 10 hours limit has been passed, data will be erased automatically and
the purchase will be canceled. <br>
<br>
Purchase by:<br>
Name : {{$order->name}}<br>
KTP/KTM : {{$order->id_no}}<br>
E-mail: {{$order->email}} <br>
No. Telp: {{$order->handphone}} <br>
<br>
Order Information :<br>
Order No. : {{$order->no_order}} <br>
Quantity : {{$order->quantity}} <br>
Total : Rp.{{number_format($order->total_price)}} ({{$order->quantity}} x Rp.{{number_format($atPrice)}}) <br>
<br>
Payment Method: <br>
Bank Tranfer <br>
BCA <br>
Account Name : 2861556508 <br>
Account Holder : Akbar Ibrahim Maulana <br>
 <br>
After the payment had been made, please follow the link below to confirm your payment:<br>
<a href="http://www.parahyanganfair.com/confirmation">confirmation payment page</a><br>
<br>
<strong>*If your payment had been made but did not confirm, the purchase will be <font color="red">CANCELED</font> </strong> <br>
<br>
Inquiries:<br>
For further information please contact <br>
081288533739 (Akbar) <br>
085921231626 (Andin) <br>
<br>
Thank you, <br>
Parahyangan Fair 2016 <br>
<br>
=========================================================== <br>
<br>
Terima kasih atas pemesanan anda!

Berikut detail pemesanan Ticket anda. Pembayaran paling lambat 10 jam setelah pemesanan. <br>
Lewat dari 10 jam, data akan terhapus secara otomatis dan pemesanan dianggap batal. <br>
<br>
Pemesanan Atas Nama : <br>
Nama : {{$order->name}}<br>
KTP/KTM : {{$order->id_no}}<br>
E-mail: {{$order->email}} <br>
No. Telp: {{$order->handphone}} <br>
<br>
Informasi Pemesanan :<br>
No. Order : {{$order->no_order}} <br>
Kuantitas : {{$order->quantity}} <br>
Total : Rp.{{number_format($order->total_price)}} ({{$order->quantity}} x Rp.{{number_format($atPrice)}}) <br>
<br>
Cara Pembayaran : <br>
Silahkan transfer ke rekening kami dibawah ini : <br>
BCA <br>
Account Name : 2861556508 <br>
Account Holder : Akbar Ibrahim Maulana <br>
 <br>
Setelah melakukan pembayaran klik URL beriut untuk konfirmasi :<br>
<a href="http://www.parahyanganfair.com/confirmation">confirmation payment page</a><br>
<br>
<strong>*Jika anda telah melakukan pembayaran namun belum melakuka konfirmasi,
   pemesanan dianggap <font color="red">BATAL</font> </strong> <br>
<br>
Bantuan:<br>
Jika ada pertanyaan silahka hubungi <br>
081288533739 (Akbar) <br>
085921231626 (Andin) <br>
<br>
Terima kasih, <br>
Parahyangan Fair 2016 <br>
<br>

<!--This is your order detail:<br>
no order    : {{ $order->no_order }}<br>
quantity    : {{ $order->quantity }}<br>
total       : {{ $order->total_price }}<br><br>

Your tickets send with this email attachments.
If you don't get it, please contact us on +xxx xxxx xxxx-->
