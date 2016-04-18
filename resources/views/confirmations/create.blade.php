@extends('layouts.app')

@section('title', 'Add Confirmation')
@section('header', 'Add Confirmation')
@section('subheader', 'Adding confirmation manual')

@section('content')
<div class="box box-solid">
    <div class="box-body">
        @include('commons.error')
        <form class="form-horizontal" action={{url('/confirmations')}} role="form" method="POST">
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="bank" class="col-md-4 control-label">Bank</label>
                <div class="col-md-6">
                    <input id="bank" type="text" class="form-control" name="nama_bank">
                </div>
            </div>

            <div class="form-group">
                <label for="no-rek" class="col-md-4 control-label">Nomor Rekening</label>
                <div class="col-md-6">
                    <input id="no-rek" type="text" class="form-control" name="no_rekening"/>
                </div>
            </div>

            <div class="form-group">
                <label for="name" class="col-md-4 control-label">Nama di Bank</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name">
                </div>
            </div>

            <div class="form-group">
                <label for="total-transfer" class="col-md-4 control-label">Total Transfer</label>
                <div class="col-md-6">
                    <input id="total-transfer" type="number" class="form-control" name="total_transfer"/>
                </div>
            </div>

            <div class="form-group">
                <label for="no-order" class="col-md-4 control-label">Nomor Order</label>
                <div class="col-md-6">
                  <input type="text" id="no-order" name="no_order" class="form-control"/>
                </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-danger col-md-offset-6">Create</button>
            </div>

        </form>
    </div>
</div>
@endsection
