@extends('layouts.app')

@section('title', 'Orders')
@section('header', 'Orders')
@section('subheader', 'Orders List')

@section('content')
    <p>
        <!-- <a href="{{ url('/orders/create-offline') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create new offline ticket</a> -->
    </p>
    <div class="box box-solid">
        <div class="box-body">
            @include('commons.success')
            <p>
                <form action="{{ url('/orders') }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="no_order" value="{{ $no_order }}" id="no_order" placeholder="Enter no order to search ....">
                        <input type="text" class="form-control" name="name" value="{{ $name }}" id="name" placeholder="Enter Name to search ....">
                        <select class="form-control" name="status">
                          <option value="-1"{{ app('request')->input('status') == -1 ? ' selected' : '' }}>All</option>
                          <option value="1"{{ app('request')->input('status') == 1 ? ' selected' : '' }}>Ordered</option>
                          <option value="2"{{ app('request')->input('status') == 2 ? ' selected' : '' }}>Confirmed</option>
                          <option value="3"{{ app('request')->input('status') == 3 ? ' selected' : '' }}>Paid</option>
                          <option value="0"{{ app('request')->input('status') == 0 ? ' selected' : '' }}>Expire</option>
                        </select>
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-flat" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </p>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No Order</th>
                        <th>Name</th>
                        <th>Handphone</th>
                        <th>Tgl Order</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($orders) == 0)
                        <tr>
                            <td colspan="5" align="center">No data found ...</td>
                        </tr>
                    @else
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->no_order }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->handphone }}</td>
                                <td>{{ date('d M Y H:i:s', strtotime($order->created_at)) }}</td>
                                <td>{{ App\Order::getStatusList($order->status) }}</td>
                                <td>IDR {{ number_format($order->total_price) }}</td>
                                <td>
                                    <a href="{{ url('/orders/'.$order->id) }}" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                  <!--
                                    <form action="{{ url('/orders/'.$order->id.'') }}" method="post" style="display:inline">
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}

                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this item?')"><i class="fa fa-trash-o"></i></button>
                                    </form>
                                  -->
                                  <!--
                                  <a href="{{ url('/orders/'.$order->id.'/edit') }}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                  -->
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    {!! $orders->links() !!}
@endsection
