@extends('layouts.user')
@section('background', "url('/assets/images/background_home.jpg')center center fixed;-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;")
@section('content')
    <div class = "container">
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12" style="background: rgba(76,76,76,0.9); padding-bottom:15px;">
                <p style="text-align:center;"><img src="{{ asset('/assets/images/unnamed.png') }}" width="120" height="120"></p>
                <hr style="width:80%">
                <h3 align="center" style="font-size:14pt">PARAHYANGAN FAIR</h3>
                <p style="font-size:9.8pt;" align="center">is the biggest music and art event of Catholic University of Parahyangan.
                We are here to bring you one of a kind experience by presenting out selected collaborations, indie music performances, and our hand-picked nation-wide vendors.
                Get ready to have the time of your life.</p>
                <p align="center">And let's rebuild
                the ultimate interactive experience!</p>
                <hr style="width:80%">
                <a style="font-size:9pt;" class="btn btn-primary btn-block btn-custom" id="second" href="{{ url('/buy') }}" role="button">GET YOUR TICKET!</a>
            </div>
        </div>
    </div>
<h5 align='center' style="color:black;font-size:9pt;">CONTACT US: 081288533739 (AKBAR) / 085921231626 (ANDIN)</h5>
@endsection
