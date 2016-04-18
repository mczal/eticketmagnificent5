@extends('layouts.app')
@section('title', 'Confirmation ID ' . $confirmation->id)
@section('header', 'Confirmation')
@section('subheader', 'ID ' . $confirmation->id)
@section('content')
<p>
    <a href="{{ url('/confirmations' ) }}" class="btn btn-primary"><i class="fa fa-bars"></i> View List</a>
</p>
<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title">General</h3>
    </div>
    <div class="box-body text-left">
        <!-- ID -->
        <div class="row">
            <div class="form-group">
                <label for="id" class="col-sm-2 control-label">Id</label>

                <div class="col-sm-6">
                    {{ $confirmation->id }}
                </div>
            </div>
        </div>

        <!-- Order Id -->
        <div class="row">
            <div class="form-group">
                <label for="order-id" class="col-sm-2 control-label">Order Id</label>

                <div class="col-sm-6">
                    <a href="{{ url('/orders/' . $confirmation->order->id) }}">{{ $confirmation->order->no_order }}</a>
                </div>
            </div>
        </div>

        <!-- Nama Bank -->
        <div class="row">
            <div class="form-group">
                <label for="nama-bank" class="col-sm-2 control-label">Bank</label>

                <div class="col-sm-6">
                    {{ $confirmation->nama_bank }}
                </div>
            </div>
        </div>

        <!-- No Rekening -->
        <div class="row">
            <div class="form-group">
                <label for="no_rekening" class="col-sm-2 control-label">No Rekening</label>

                <div class="col-sm-6">
                    {{ $confirmation->no_rekening }}
                </div>
            </div>
        </div>

        <!-- Nama di Bank -->
        <div class="row">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Nama Pemilik Bank</label>
                <div class="col-sm-6">
                    {{ $confirmation->name }}
                </div>
            </div>
        </div>

        <!-- Total Transfer -->
        <div class="row">
            <div class="form-group">
                <label for="total-transfer" class="col-sm-2 control-label">Total Transfer</label>

                <div class="col-sm-6">
                    IDR {{ number_format($confirmation->total_transfer) }}
                </div>
            </div>
        </div>

        <!-- Created At -->
        <div class="row">
            <div class="form-group">
                <label for="created-at" class="col-sm-2 control-label">Created At</label>

                <div class="col-sm-6">
                    {{ $confirmation->created_at }}
                </div>
            </div>
        </div>

        <!-- Updated At -->
        <div class="row">
            <div class="form-group">
                <label for="updated-at" class="col-sm-2 control-label">Updated At</label>

                <div class="col-sm-6">
                    {{ $confirmation->updated_at }}
                </div>
            </div>
        </div>

        <!-- Control -->
        <div class="row">
          <!--delete-->
            <div class="form-group">
                <div class="col-sm-6 col-sm-offset-2">
                  <!-- validate -->
                  @if ($confirmation->status == 0)
                    <form style="display:inline" action="{{url('/confirmations/validate')}}" method="post">
                      {!! csrf_field() !!}
                      <input readOnly type="hidden" type="number" name="id" value="{{ $confirmation->id }}">
                      <button type="submit" class="btn btn-success" onclick="return confirm('All tickets registered will be active !')">Validate</button>
                    </form>
                  @else
                  <button class="btn btn-default" disabled>Valid</button>
                  @endif
                    <a href="{{ url('/confirmations/' . $confirmation->id . '/edit') }}" class="btn btn-default"><i class="fa fa-pencil"></i> Edit</a>
                    <form action="{{ url('/confirmations/' . $confirmation->id) }}" method="post" style="display: inline">
                        {!! csrf_field() !!}
                        {!! method_field('DELETE') !!}

                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this item?')"><i class="fa fa-trash-o"></i> Delete</button>
                    </form>
                </div>
                <div class="col-sm-6 col-sm-offset-2">
                    <form style="display:inline" action="{{url('/confirmations/resendMail')}}" method="post">
                      {!! csrf_field() !!}
                      <input readOnly type="hidden" type="number" name="id" value="{{ $confirmation->id }}">
                      <button type="submit" class="btn btn-primary" onclick="return confirm('Send email contain its ticket again?')"><i class="fa fa-share">Send Mail</i></button>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.box-body -->
</div>
@endsection
