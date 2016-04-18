@extends('layouts.user')
@section('background',"url('/assets/images/background.jpg')no-repeat center center fixed;-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;")
@section('content')
<div class = "container" style="padding-top:100px">
    <p style="text-align:center;"><img src="{{ asset('assets/images/payment.png') }}" width="300" height="auto"></p>
    <div class = "row">
        <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1" style="background:rgba(38,38,38,0.7); padding-bottom: 20px;">
            @include('commons.error')
            <form method="post" action="{{ url('/confirmation') }}" role="form">
                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('nama_bank') ? ' has-error' : '' }}">
                    <div class="col-sm-12">
                        <label for="nama_bank">Bank:
    					@if ($errors->has('nama_bank'))
    			            <span class="help-block">
    			                <strong>{{ $errors->first('nama_bank') }}</strong>
    			            </span>
    			        @endif</label>
                        <input type="text" class="form-control" id="nama_bank" name="nama_bank" value="{{ old('nama_bank') }}">
                    </div>
                </div>
                <div class="form-group{{ $errors->has('no_rekening') ? ' has-error' : '' }}">
                    <div class="col-sm-12">
                        <label for="no_rekening">Bank Account Number:
    					@if ($errors->has('no_rekening'))
    			            <span class="help-block">
    			                <strong>{{ $errors->first('no_rekening') }}</strong>
    			            </span>
    			        @endif</label>
                        <input type="text" class="form-control" id="no_rekening" name="no_rekening" value="{{ old('no_rekening') }}">
                    </div>
                </div>
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <div class="col-sm-12">
                        <label for="name">Name (exactly as in Bank):
    					@if ($errors->has('name'))
    			            <span class="help-block">
    			                <strong>{{ $errors->first('name') }}</strong>
    			            </span>
    			        @endif</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    </div>
                </div>
                <div class="form-group{{ $errors->has('total_transfer') ? ' has-error' : '' }}">
                    <div class="col-sm-12">
                        <label for="total_transfer">Transfer Amount:
    					@if ($errors->has('total_transfer'))
    			            <span class="help-block">
    			                <strong>{{ $errors->first('total_transfer') }}</strong>
    			            </span>
    			        @endif</label>
                        <input type="number" class="form-control" id="total_transfer" name="total_transfer" value="{{ old('total_transfer') }}">
                    </div>
                </div>
                <div class="form-group{{ $errors->has('no_order') ? ' has-error' : '' }}">
                    <div class="col-sm-12">
                        <label for="no_order">No Order:
    					@if ($errors->has('no_order'))
    			            <span class="help-block">
    			                <strong>{{ $errors->first('no_order') }}</strong>
    			            </span>
    			        @endif</label>
                        <input type="text" class="form-control" id="no_order" name="no_order" value="{{ old('no_order') }}">
                    </div>
                </div>
                <div class="col-sm-12">
                    <br>
                    <button id ="second" style="font-size:11pt;" class="btn btn-small btn-primary btn-block" type="submit" role="button">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
