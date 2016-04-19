@extends('layouts.user')
@section('background', "url('/assets/images/background_home.jpg')center center fixed;-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;")
@section('content')
    <div class = "container">
        <div class="img-line-up">
            <img src="{{ asset('/assets/images/line-up.jpg') }}" alt="" width="75%" height="200px" style="opacity: 0.3; filter:alpha(opacity=30); z-index:5;"  />
        </div>
        <div class="row">
            <div class="col-lg-4col-md-6 col-sm-8 col-xs-12" style="background: rgba(100,76,52,0.9); width: 100%; z-index: -5;margin-top:-170px; padding-bottom: 15px;">
                <p style="text-align:center;"><img src="{{ asset('/assets/images/unnamed.png') }}" width="120" height="120"></p>

                <h3 align="center" style="font-size:18pt">Five Live Magnificent</h3>
                <p style="font-size:12pt;" align="center">Welcome to The Five Live Magnificent <i>E-ticket</i> Booking Page</p>
                <p align="center">Feel The Experiences</p>
            </div>
        </div>
        <a style="font-size:9pt;margin-top:20px;" class="btn btn-primary btn-block btn-custom" id="second" href="{{ url('/buy') }}" role="button">GET YOUR TICKET!</a>
    </div>
<!-- <h5 align='center' style="color:black;font-size:9pt;">CONTACT US: 081288533739 (AKBAR) / 085921231626 (ANDIN)</h5> -->
@endsection
