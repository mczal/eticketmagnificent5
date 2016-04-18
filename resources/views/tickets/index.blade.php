@extends('layouts.app')

@section('title', 'Tickets')
@section('header', 'Tickets')
@section('subheader', 'Ticket List')

@section('content')
<!--
  <p>
      <a class="btn btn-primary" href={{url('/tickets/create')}} role="button"><i class="fa fa-plus"></i>  Create New</a>
  </p>
-->

  <div class="box box-solid">
      <div class="box-body">
        <p>
            <form action="{{ url('/tickets') }}" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="unique_code" value="{{ app('request')->input('unique_code') }}" id="keyword" placeholder="Enter ticket code here to search ...."/>
                    {{--*/ $i = 0 /*--}}
                    <div class="row">

                    </div>
                    @foreach ($types as $type)
                      <div class="checkbox">
                        <label>
                          <input id="ordered" type="checkbox" name="type[]" value="{{$type->id}}"{{ app('request')->input('type.'.$i.'') == $type->id ? ' checked '.$i++ : '' }}/>{{$type->name}}
                        </label>
                      </div>
                    @endforeach
                    <select class="form-control" name="filter">
                      <option value="all"{{ app('request')->input('filter') == 'all' ? ' selected' : '' }}>All</option>
                      <option value="not_ordered"{{ app('request')->input('filter') == 'not_ordered' ? ' selected' : '' }}>Not Ordered</option>
                      <option value="ordered"{{ app('request')->input('filter') == 'ordered' ? ' selected' : '' }}>Ordered</option>
                      <option value="actived"{{ app('request')->input('filter') == 'actived' ? ' selected' : '' }}>Actived</option>
                      <option value="checked_in"{{ app('request')->input('filter') == 'checked_in' ? ' selected' : '' }}>Checked In</option>
                    </select>
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-flat btn-lg" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
        </p>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Code</th>
                <th>Order</th>
                <th>Type</th>
                <th>Order Date</th>
                <th>Active Date</th>
                <th>Check-in Date</th>
                <th></th>
              </tr>
            </thead>
            @if ( count($tickets) > 0 )
            <tbody>
              @foreach($tickets as $ticket)
                  <tr>
                    <td>{{$ticket->unique_code}}</td>
                    <td>{!! $ticket->order ? ($ticket->order->no_order.'<br>'.$ticket->order->name) : '' !!}</td>
                    <td>{{$ticket->type->name}}</td>
                    <td>{{$ticket->order_date}}</td>
                    <td>{{$ticket->active_date}}</td>
                    <td>{{$ticket->check_in_date}}</td>
                    <!--view edit delete-->
                    <td>
                      <a href="{{url('/tickets/print/'.$ticket->id)}}" class="btn btn-default btn-primary" target="_blank"><i class="fa fa-print"></i></a>
                      <a href="{{url('/tickets/'.$ticket->id)}}" class="btn btn-default"><i class="fa fa-eye"></i></a>
                      <!--
                      <a href="{{url('/tickets/'.$ticket->id.'/edit')}}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                      <form action="{{ url('/tickets/'.$ticket->id) }}" method="post" style="display:inline">
                          {!! csrf_field() !!}
                          {!! method_field('DELETE') !!}

                          <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this item?')"><i class="fa fa-trash-o"></i></button>
                      </form>
                    -->
                    </td>
                  </tr>
              @endforeach
            </tbody>
          @endif

          </table>
      </div>
  </div>
  {!! $tickets->links() !!}
@endsection
