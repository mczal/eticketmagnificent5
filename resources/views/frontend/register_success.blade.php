@extends('layouts.user')
@section('background',"url('/assets/images/background.jpg')no-repeat center center fixed;-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;")
@section('content')
    <div class = "container" style="padding-top:100px">
        <p style="text-align:center;"><img src="{{ asset('assets/images/thankyou.png') }}" width="200" height="auto"></p>
            <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1" style="background:rgba(38,39,41,0.8); padding-top:20px; padding-bottom:20px;">
                <p style="font-size:13pt;" id="fifth" align="center">Your order is being processed. An E-mail will be sent into: </p> <p id="third" align="center"><span id="fourth">{{ $email }}</span></p> <p id="fifth" style="font-size:13pt;" align="center"> Payment information will be sent to your E-mail.</p>
            </div>
        </div>
    </div>
@endsection
