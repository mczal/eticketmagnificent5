@extends('layouts.app')

@section('title', 'Edit Confirmation ID ' . $confirmation->id)
@section('header', 'Edit Confirmation')
@section('subheader', 'ID ' . $confirmation->id)

@section('content')
<p>
    <a href="{{ url('/confirmations') }}" class="btn btn-primary"><i class="fa fa-bars"></i> View List</a>
</p>
<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title">General</h3>
    </div>
    <div class="box-body text-left">
        <form class="form-horizontal" action="{{ url('/confirmations/' . $confirmation->id) }}" method="post">
            {!! csrf_field() !!}
            {!! method_field('PATCH') !!}

            <!--ID LABEL-->
            <div class="form-group">
                <label for="confirmation-id" class="col-sm-2 control-label">ID</label>
                <div class="col-sm-6">
                    <input readonly type="text" name="id" id="confirmation-id" class="form-control" value="{{ $confirmation->id }}">
                </div>
            </div>

            <!-- Nama Bank -->
            <div class="form-group{{ $errors->has('nama_bank') ? ' has-error' : '' }}">
                <label for="nama_bank" class="col-sm-2 control-label">Bank</label>
                <div class="col-sm-6">
                    <input type="text" name="nama_bank" id="nama_bank" class="form-control" value="{{ isset($confirmation->nama_bank) ? $confirmation->nama_bank : '' }}">
                    @if ($errors->has('nama_bank'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nama_bank') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- No Rekening -->
            <div class="form-group{{ $errors->has('no_rekening') ? ' has-error' : '' }}">
                <label for="no_rekening" class="col-sm-2 control-label">No. Rekening</label>
                <div class="col-sm-6">
                    <input type="text" name="no_rekening" id="no_rekening" class="form-control" value="{{ isset($confirmation->no_rekening) ? $confirmation->no_rekening : '' }}">
                    @if ($errors->has('no_rekening'))
                        <span class="help-block">
                            <strong>{{ $errors->first('no_rekening') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- Nama Bank -->
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-sm-2 control-label">Nama di Bank</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="name" class="form-control" value="{{ isset($confirmation->name) ? $confirmation->name : '' }}">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <!-- Total Transfer -->
            <div class="form-group{{ $errors->has('total_transfer') ? ' has-error' : '' }}">
                <label for="total_transfer" class="col-sm-2 control-label">Total Transfer</label>
                <div class="col-sm-6">
                    <input type="text" name="total_transfer" id="total_transfer" class="form-control" value="{{ isset($confirmation->total_transfer) ? $confirmation->total_transfer : '' }}">
                    @if ($errors->has('total_transfer'))
                        <span class="help-block">
                            <strong>{{ $errors->first('total_transfer') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-3 col-sm-offset-2">
                    <button type="submit" name="button" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>

        </form>
    </div><!-- /.box-body -->
</div>
@endsection
