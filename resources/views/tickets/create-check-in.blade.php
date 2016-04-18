@extends('layouts.app')

@section('title', 'THIS IS JUST TEST')
@section('header', 'JUST TEST')

@section('content')
<div class="box box-solid">
    <div class="box-body">
        <form class="form-horizontal" action={{url('/tickets/check-in')}} role="form" method="POST">
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="unique-code" class="col-md-4 control-label">Ticket Code</label>
                <div class="col-md-6">
                    <input type="text" id="unique-code" name="unique_code" class="form-control" value=""/>
                </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-danger col-md-offset-6">CHECK IN</button>
            </div>

        </form>
    </div>
</div>
@endsection
