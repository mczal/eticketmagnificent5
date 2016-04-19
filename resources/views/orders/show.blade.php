@extends('layouts.app')

@section('title', 'Order Detail #' . $order->no_order)
@section('header', 'Order Detail')
@section('subheader', '#' . $order->no_order)

@section('content')
    <p>
        <a href="{{ url('/orders/create-offline') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create new offline ticket</a>
        <a href="{{ url('/orders' ) }}" class="btn btn-success"><i class="fa fa-bars"></i> View List</a>
    </p>
    <div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title">General</h3>
        </div>
        <div class="box-body text-left">
            <div class="container">

                <!-- TICKET TYPE -->
                <div class="row">
                    <div class="form-group">
                        <label for="order-type_id" class="col-sm-2 control-label">Ticket Type</label>

                        <div class="col-sm-6">
                            {{ $order->type != null ? $order->type->name : '' }}
                        </div>
                    </div>
                </div>

                <!-- Quantity -->
                <div class="row">
                    <div class="form-group">
                        <label for="order-quantity" class="col-sm-2 control-label">Quantity</label>

                        <div class="col-sm-6">
                            {{ $order->quantity }} PCS
                        </div>
                    </div>
                </div>

                <!-- Total -->
                <div class="row">
                    <div class="form-group">
                        <label for="order-total" class="col-sm-2 control-label">Total</label>

                        <div class="col-sm-6">
                            IDR {{ number_format($order->total_price) }}
                        </div>
                    </div>
                </div>

                <!-- Name -->
                <div class="row">
                    <div class="form-group">
                        <label for="order-name" class="col-sm-2 control-label">Name</label>

                        <div class="col-sm-6">
                            {{ $order->name }}
                        </div>
                    </div>
                </div>

                <!-- Email -->
                <div class="row">
                    <div class="form-group">
                        <label for="order-email" class="col-sm-2 control-label">Email</label>

                        <div class="col-sm-6">
                            {{ $order->email }}
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="row">
                    <div class="form-group">
                        <label for="order-status" class="col-sm-2 control-label">Status</label>

                        <div class="col-sm-6">
                            {{ App\Order::getStatusList($order->status) }}
                        </div>
                    </div>
                </div>

                <!-- Created At -->
                <div class="row">
                    <div class="form-group">
                        <label for="order-created" class="col-sm-2 control-label">Created At</label>

                        <div class="col-sm-6">
                            {{ $order->created_at }}
                        </div>
                    </div>
                </div>

                <!-- Expired Date -->
                <div class="row">
                    <div class="form-group">
                        <label for="expired-date" class="col-sm-2 control-label">Expired Date</label>

                        <div class="col-sm-2">
                            {{$order->expired_date}}
                        </div>
                        @if($order->status == App\Order::STATUS_ORDERED)
                        <div class="col-sm-4">
                            {{$timeLeft}} Minutes Left to Canceled
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Control -->
                <div class="row">
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-2">
                          <!--
                            <form action="{{ url('/orders/' . $order->id) }}" method="post" style="display: inline">
                                {!! csrf_field() !!}
                                {!! method_field('DELETE') !!}

                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this item?')"><i class="fa fa-trash-o"></i> Delete</button>
                            </form>
                          -->
                        </div>
                            <div class="col-sm-6 col-sm-offset-2">
                                <form action="{{ url('/orders/resend-mail-online-order') }}" method="post" style="display: inline">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="id" value="{{$order->id}}">
                                    <button type="submit" class="btn btn-primary" onclick="return confirm('Are you sure want resend email online order?')"><i class="fa fa-share"></i> Resend Mail</button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($order->status == App\Order::STATUS_PAID)
    <div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title">Tickets</h3>
        </div>
        <div class="box-body text-left">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="10px">No.</th>
                                    <th width="200px">Code</th>
                                    <th width="200px">Type</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--*/ $i = 1 /*--}}
                                @foreach($order->tickets as $ticket)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $ticket->unique_code }}</td>
                                        <td>{{ $ticket->type->name }}</td>
                                        <td>
                                            <a href="{{ url('/tickets/print/' . $ticket->id) }}" target="_blank"><span class="btn btn-primary fa fa-print"></span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
