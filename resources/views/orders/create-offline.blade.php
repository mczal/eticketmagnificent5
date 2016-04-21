@extends('layouts.app')

@section('title', 'Create Order Offline Tickets')
@section('header', 'Create New Order Offline Tickets')
@section('subheader', 'Create New')

@section('content')
    <p>
        <a href="{{ url('/orders' ) }}" class="btn btn-primary"><i class="fa fa-bars"></i> View List</a>
    </p>
    <div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title">General</h3>
        </div>
        <div class="box-body text-left">
            <form class="form-horizontal" action="{{ url('/orders/store-offline') }}" method="post">
                {!! csrf_field() !!}
                @include('commons.error')
                @include('commons.success')

                <!-- beginning of my form TODO: -->
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          				<div class="col-sm-12">
          					<label for="name">Name:(exactly as in Bank):
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

          			      <label class="col-sm-12 control-label">FESTIVAL &nbsp; &nbsp; <span style="font-weight:normal;">@Rp.{{number_format($priceFest)}}</span></label>
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
          						</select><br>

          			      <label style="padding-top:10px;" class="col-sm-12 control-label">VIP B &nbsp; &nbsp; <span style="font-weight:normal;">@Rp.{{number_format($priceVipB)}}</span></label>
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
          						</select><br>

          						<label style="padding-top:10px;" class="col-sm-12 control-label">VIP A &nbsp; &nbsp; <span style="font-weight:normal;">@Rp.{{number_format($priceVipA)}}</span></label>
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
          						</select><br>

          						<label style="padding-top:10px;" class="col-sm-12 control-label">VVIP &nbsp; &nbsp; <span style="font-weight:normal;"><i>-SOLD OUT-</i></span></label>
          			      @if ($errors->has('ctvvip4'))
          			          <span class="help-block">
          			              <strong>{{ $errors->first('ctvvip4') }}</strong>
          			          </span>
          			      @endif
          						<input type="hidden" name="ctvvip4" value="0">
          			    </div>
          			</div>
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

          			<div class="col-sm-12">
          				<button id="second" style="font-size:11pt;" class="btn btn-lg btn-primary pull-right" type="submit" role="button">Submit</button>
          			</div>
                <!-- end of myform -->
            </form>
        </div><!-- /.box-body -->
    </div>
@endsection
