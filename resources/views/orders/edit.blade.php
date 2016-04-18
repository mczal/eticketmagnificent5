@extends('layouts.app')

@section('content')
<p>
    <a href="{{ url('/orders') }}" class="btn btn-primary"><i class="fa fa-bars"></i> View List</a>
</p>
<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title">General</h3>
    </div>
    <div class="box-body text-left">
        <form class="form-horizontal" action="{{ url('/orders/' . $order->id) }}" method="post">
            {!! csrf_field() !!}
            {!! method_field('PATCH') !!}
            @include('commons.error')
            @include('commons.success')

            <!-- Order Name -->
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="order-name" class="col-sm-2 control-label">Name</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="order-name" class="form-control" value="{{ isset($order->name) ? $order->name : old('name') }}">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- Order Address -->
            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                <label for="order-address" class="col-sm-2 control-label">Address</label>

                <div class="col-sm-6">
                    <input type="text" name="address" id="order-address" class="form-control" value="{{ isset($order->address) ? $order->address : old('address') }}">
                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- Email -->
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="order-email" class="col-sm-2 control-label">Email</label>

                <div class="col-sm-6">
                    <input type="email" name="email" id="order-email" class="form-control" value="{{ isset($order->email) ? $order->email : old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- Handphone -->
            <div class="form-group{{ $errors->has('handphone') ? ' has-error' : '' }}">
                <label for="order-handphone" class="col-sm-2 control-label">Handphone</label>

                <div class="col-sm-6">
                    <input type="text" name="handphone" id="order-handphone" class="form-control" value="{{ isset($order->handphone) ? $order->handphone : old('handphone') }}">
                    @if ($errors->has('handphone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('handphone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- Control -->
            <div class="form-group">
                <div class="col-sm-3 col-sm-offset-2">
                    <button type="submit" name="button" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>

        </form>
    </div><!-- /.box-body -->
</div>
@endsection
