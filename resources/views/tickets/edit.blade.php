@extends('layouts.app')

@section('content')
<p>
    <a href="{{ url('/tickets') }}" class="btn btn-primary"><i class="fa fa-bars"></i> View List</a>
</p>
<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title">General</h3>
    </div>
    <div class="box-body text-left">
        <form class="form-horizontal" action="{{ url('/tickets/' . $ticket->id) }}" method="post">
            {!! csrf_field() !!}
            {!! method_field('PATCH') !!}

            <!-- Ticket unique code -->
            <div class="form-group{{ $errors->has('unique_code') ? ' has-error' : '' }}">
                <label for="ticket-code" class="col-sm-2 control-label">Unique Code</label>
                <div class="col-sm-6">
                    <input type="text" name="unique_code" id="ticket-code" class="form-control" value="{{ isset($ticket->unique_code) ? $ticket->unique_code : '' }}">
                    @if ($errors->has('unique_code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('unique_code') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- ticket type -->
            <div class="form-group{{ $errors->has('type_id') ? ' has-error' : '' }}">
                <label for="type_id" class="col-sm-2 control-label">Type Id</label>

                <div class="col-sm-3">
                    <input type="text" name="type_id" id="type_id" class="form-control" value="{{ isset($ticket->type_id) ? $ticket->type_id : 0 }} ">
                    @if ($errors->has('type_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('type_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- ticket order -->
            <div class="form-group{{ $errors->has('order_id') ? ' has-error' : '' }}">
                <label for="order_id" class="col-sm-2 control-label">Order Id</label>

                <div class="col-sm-3">
                    <input type="text" name="order_id" id="order_id" class="form-control" value="{{ isset($ticket->order_id) ? $ticket->order_id : 0 }} ">
                    @if ($errors->has('order_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('order_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- ticket order date -->
            <div class="form-group{{ $errors->has('order_date') ? ' has-error' : '' }}">
                <label for="ticket-order-date" class="col-sm-2 control-label">Order Date</label>

                <div class="col-sm-3">
                    <input type="datetime" name="order_date" id="ticket-order-date" class="form-control" value="{{ isset($ticket->order_date) ? $ticket->order_date : '' }} ">
                    @if ($errors->has('order_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('order_date') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-sm-3">
                  <p> All Date Format : <br/>'YYYY-MM-DD HH:MM:SS''</p>
                </div>
            </div>

            <!-- ticket active date -->
            <div class="form-group{{ $errors->has('active_date') ? ' has-error' : '' }}">
                <label for="ticket-active-date" class="col-sm-2 control-label">Active Date</label>

                <div class="col-sm-3">
                    <input type="datetime" name="active_date" id="ticket-active-date" class="form-control" value="{{ isset($ticket->active_date) ? $ticket->active_date : '' }} ">
                    @if ($errors->has('active_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('active_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- ticket checkin date -->
            <div class="form-group{{ $errors->has('check_in_date') ? ' has-error' : '' }}">
                <label for="ticket-checkin-date" class="col-sm-2 control-label">Checkin Date</label>

                <div class="col-sm-3">
                    <input type="datetime" name="check_in_date" id="ticket-checkin-date" class="form-control" value="{{ isset($ticket->check_in_date) ? $ticket->check_in_date : '' }} ">
                    @if ($errors->has('check_in_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('check_in_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- Type Status
            <div class="form-group">
                <label for="type-active" class="col-sm-1 control-label">Active</label>
                <div class="col-sm-3">
                    <select class="form-control" name="active" id="type-active">
                        <option value="0"{{ (isset($type->active) && $type->active == 0) ? ' selected' : '' }}>Not Active</option>
                        <option value="1"{{ (isset($type->active) && $type->active == 1) ? ' selected' : '' }}>Active</option>
                    </select>
                </div>
            </div>
            -->
            <div class="form-group">
                <div class="col-sm-3 col-sm-offset-1">
                    <button type="submit" name="button" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>

        </form>
    </div><!-- /.box-body -->
</div>
@endsection
