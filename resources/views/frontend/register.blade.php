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

			<!-- TICKET TYPE -->
			<div class="form-group{{ $errors->has('ctfest1') ? ' has-error' : '' }}">
			    <label for="order-ctfest1" class="col-sm-12 col-md-12 col-lg-12 control-label">Ticket Type</label>
			    <div class="col-sm-12 col-md-12" style="margin-top:25px;">

			      <label class="col-sm-12 control-label">FESTIVAL</label>
			      @if ($errors->has('ctfest1'))
			          <span class="help-block">
			              <strong>{{ $errors->first('ctfest1') }}</strong>
			          </span>
			      @endif
			      <select style="color:black;" type="number" name="ctfest1" id="order-ctfest1" class="col-sm-4 form-control">
							<option value="0" style="color:black;">0</option>
							<option value="1" style="color:black;">1</option>
							<option value="2" style="color:black;">2</option>
							<option value="3" style="color:black;">3</option>
							<option value="4" style="color:black;">4</option>
						</select>
						<label for="tiket sisa" class="col-sm-8" style="padding-bottom: 20px; padding-top: 10px;">Number of tickets remaining:  </label><hr width="80%">
						<label class="col-sm-12 control-label">VIP A</label>
			      @if ($errors->has('ctvipa2'))
			          <span class="help-block">
			              <strong>{{ $errors->first('ctvipa2') }}</strong>
			          </span>
			      @endif
			      <select style="color:black;" type="number" name="ctvipa2" id="order-ctvipa2" class="col-sm-4 form-control">
							<option value="0" style="color:black;">0</option>
							<option value="1" style="color:black;">1</option>
							<option value="2" style="color:black;">2</option>
							<option value="3" style="color:black;">3</option>
							<option value="4" style="color:black;">4</option>
						</select>
						<label for="tiket sisa" class="col-sm-8" style="padding-bottom: 20px; padding-top: 10px;">Number of tickets remaining:  </label><hr width="80%">
			      <label class="col-sm-12 control-label">VIP B</label>
			      @if ($errors->has('ctvipb3'))
			          <span class="help-block">
			              <strong>{{ $errors->first('ctvipb3') }}</strong>
			          </span>
			      @endif
			      <select style="color:black;" type="number" name="ctvipb3" id="order-ctvipb3" class="col-sm-4 form-control">
							<option value="0" style="color:black;">0</option>
							<option value="1" style="color:black;">1</option>
							<option value="2" style="color:black;">2</option>
							<option value="3" style="color:black;">3</option>
							<option value="4" style="color:black;">4</option>
						</select>
						<label for="tiket sisa" class="col-sm-8" style="padding-bottom: 20px; padding-top: 10px;">Number of tickets remaining:  </label><hr width="80%">
			      <label class="col-sm-12 control-label">VVIP</label>
			      @if ($errors->has('ctvvip4'))
			          <span class="help-block">
			              <strong>{{ $errors->first('ctvvip4') }}</strong>
			          </span>
			      @endif
			      <select style="color:black;" type="number" name="ctvvip4" id="order-ctvvip4" class="col-sm-4 form-control">
							<option value="0" style="color:black;">0</option>
							<option value="1" style="color:black;">1</option>
							<option value="2" style="color:black;">2</option>
							<option value="3" style="color:black;">3</option>
							<option value="4" style="color:black;">4</option>
						</select>
						<label for="tiket sisa" class="col-sm-8" style="padding-bottom: 20px; padding-top: 10px;">Number of tickets remaining:  </label>
			    </div>
			</div>

			<div class="col-sm-12">
				<input type="hidden" value="{{ env('ACTIVE_TICKET_TYPE') }}" name="type_id">
				<button id="second" style="font-size:11pt;" class="btn btn-lg btn-primary pull-right" type="submit" role="button">Submit</button>
			</div>
		</form>
	</div>
</div>

<div class="img-seatplan">
	<img src="{{ asset('/assets/images/seat-plan-WEB.jpg') }}" alt="" />
</div>

@endsection
