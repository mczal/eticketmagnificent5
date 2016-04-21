@extends('layouts.app')

@section('content')
  <p>
    <a href="{{ url('/tickets' ) }}" class="btn btn-primary"><i class="fa fa-bars"></i> View List</a>
  </p>
  <div class="box box-solid">
      <div class="box-header">
          <h3 class="box-title">General</h3>
      </div>
      <div class="box-body text-left">
          <!-- Ticket Code -->
          <div class="row">
              <div class="form-group">
                  <label for="ticket-code" class="col-sm-2 control-label">unique code</label>

                  <div class="col-sm-6">
                      {{ $ticket->unique_code }}
                  </div>
              </div>
          </div>

          <!-- SIGNATURE -->
          <!-- <div class="row">
              <div class="form-group">
                  <label for="order-signature" class="col-sm-2 control-label">Signature</label>

                  <div class="col-sm-6">
                  </div>
              </div>
          </div> -->

          <!-- Ticket order id -->
          <div class="row">
              <div class="form-group">
                  <label for="ticket-order-id" class="col-sm-2 control-label">Order Id</label>

                  <div class="col-sm-3">
                    {!! $ticket->order ? ($ticket->order->no_order.'<br>'.$ticket->order->name) : '' !!}
                  </div>
              </div>
          </div>

          <!-- Ticket type id -->
          <div class="row">
              <div class="form-group">
                  <label for="ticket-type-id" class="col-sm-2 control-label">Type Id</label>
                  <div class="col-sm-3">
                      {{ $ticket->type->name }}
                  </div>
              </div>
          </div>

          <!-- Ticket order date -->
          <div class="row">
              <div class="form-group">
                  <label for="ticket-order-date" class="col-sm-2 control-label">Order Date</label>
                  <div class="col-sm-3">
                      {{ $ticket->order_date }}
                  </div>
              </div>
          </div>

          <!-- Ticket active date -->
          <div class="row">
              <div class="form-group">
                  <label for="ticket-active-date" class="col-sm-2 control-label">Active Date</label>
                  <div class="col-sm-3">
                      {{ $ticket->active_date }}
                  </div>
              </div>
          </div>

          <!-- Ticket check in date -->
          <div class="row">
              <div class="form-group">
                  <label for="ticket-check-in-date" class="col-sm-2 control-label">Check In Date</label>
                  <div class="col-sm-3">
                      {{ $ticket->check_in_date }}
                  </div>
              </div>
          </div>

          <!-- Control -->
          <div class="row">
              <div class="form-group">
                  <div class="col-sm-6 col-sm-offset-2">
                      <!--
                      <a href="{{ url('/tickets/' . $ticket->id . '/edit') }}" class="btn btn-default"><i class="fa fa-pencil"></i> Edit</a>
                      <form action="{{ url('/tickets/' . $ticket->id) }}" method="post" style="display: inline">
                          {!! csrf_field() !!}
                          {!! method_field('DELETE') !!}

                          <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this item?')"><i class="fa fa-trash-o"></i> Delete</button>
                      </form>
                    -->
                  </div>
              </div>
          </div>
      </div><!-- /.box-body -->
  </div>
@endsection
