@extends('layouts.user')

@section('content')

<p style="text-align:center;"><img src=" {{asset("/assets/images/details.png")}}" width="140" height="auto"></p>
<div class="row">
  <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1" style="background:rgba(38,38,38,0.8); padding-bottom:20px;">
    <h6 align="center">Name: </h6>
    <h5 align="center">Ivan Tadeo Lestyana</h5>
    <h6 align="center">Email: </h6>
    <h5 align="center">ivan.tadeo@thismail.com</h5>
    <h6 align="center">No. ID: </h6>
    <h5 align="center">327705126199604</h5>
    <h6 align="center">Number of Tickets Ordered: </h6>
    <h5 align="center">2</h5>
    <h4 align="center">Is the information correct?</h4>
    <div class="btn-group">
       <p align="center"><a class="btn btn-small btn-primary" href="./thankyou.html" role="button" style="margin-left:100px">Yes, it is.</a> </p>
       <p align="center"><a class="btn btn-primary" href="./registration.html" style="margin-left:120px;" role="button">No, please get me back to fix it.</a></p>
    </div>
  </div>
 </div>

 @endsection
