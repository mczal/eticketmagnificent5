@extends('layouts.user')
@section('background',"url('/assets/images/background.jpg')no-repeat center center fixed;-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: cover;")
@section('content')
<p style="text-align:center; padding-top:30px"><img src="{{ asset("/assets/images/tickets.png" )}}" width="250" height="auto"></p>
<div class="row">
	<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1"  style="background: rgba(38,38,38,0.8); padding-top:10px; padding-bottom:20px;">
		<p style="font-size:13pt;" align="center">Input your personal details below</p>
		<form action="{{ url('/buy') }}" method="post" role="form">
			{!! csrf_field() !!}
			<div class="form-group">
				<div class="col-sm-12">
					@include('commons.success')
					@include('commons.error')
				</div>
			</div>
			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<div class="col-sm-12">
					<label for="name">Name:
					@if ($errors->has('name'))
			            <span class="help-block">
			                <strong>{{ $errors->first('name') }}</strong>
			            </span>
			        @endif</label>
					<input type="text" class="form-control" name="name" id="name" style="margin-bottom: 20px;" value="{{ old('name') }}">
				</div>
			</div>
			<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
				<div class="col-sm-12">
					<label for="email">Email:
					@if ($errors->has('email'))
			            <span class="help-block">
			                <strong>{{ $errors->first('email') }}</strong>
			            </span>
			        @endif</label>
					<input type="email" class="form-control" name="email" id="email" style="margin-bottom: 20px;" value="{{ old('email') }}">
				</div>
			</div>
			<div class="form-group{{ $errors->has('id_no') ? ' has-error' : '' }}">
				<div class="col-sm-12">
					<label for="id_no">No. ID (KTP, KTM, SIM):
					@if ($errors->has('id_no'))
			            <span class="help-block">
			                <strong>{{ $errors->first('id_no') }}</strong>
			            </span>
			        @endif</label>
					<input type="text" class="form-control" name="id_no" id="id_no" style="margin-bottom: 20px;" value="{{ old('id_no') }}">
				</div>
			</div>
			<div class="form-group{{ $errors->has('handphone') ? ' has-error' : '' }}">
				<div class="col-sm-12">
					<label for="handphone">Handphone:
					@if ($errors->has('handphone'))
			            <span class="help-block">
			                <strong>{{ $errors->first('handphone') }}</strong>
			            </span>
			        @endif</label>
					<input class="form-control" id="handphone" style="margin-bottom: 20px;" name="handphone" value="{{ old('handphone') }}">
				</div>
			</div>
			<div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
				<div class="col-sm-12">
					<label for="quantity">Number of tickets:</label>
					<select class="form-control" id="quantity" style="margin-bottom: 20px;" name="quantity">
						<option value="1"{{ old('quantity') == 1 ? ' selected' : '' }}>1</option>
						<option value="2"{{ old('quantity') == 2 ? ' selected' : '' }}>2</option>
						<option value="3"{{ old('quantity') == 1 ? ' selected' : '' }}>3</option>
					</select>
				</div>
			</div>
			<p align="center">
				<div class="col-sm-12">
					<label for="tiket sisa" >Number of tickets remaining:  </label>
					<label id="first" for="sisa">{{ $remaining_tickets }} (@Rp.{{number_format($price)}})</label>
				</div>
			</p>
			<div class="col-sm-12">
				<input type="hidden" value="{{ env('ACTIVE_TICKET_TYPE') }}" name="type_id">
				<button id="second" style="font-size:11pt;" class="btn btn-lg btn-primary pull-right" type="submit" role="button">Submit</button>
			</div>
		</form>
	</div>
</div>

@endsection
