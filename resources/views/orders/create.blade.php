@extends('layouts.app')

@section('title', 'Create Order')
@section('header', 'Create New')
@section('subheader', 'Create New Order')

@section('content')
    <p>
        <a href="{{ url('/orders' ) }}" class="btn btn-primary"><i class="fa fa-bars"></i> View List</a>
    </p>
    <div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title">General</h3>
        </div>
        <div class="box-body text-left">
            <form class="form-horizontal" action="{{ url('/orders') }}" method="post">
                {!! csrf_field() !!}
                @include('commons.error')
                @include('orders._form')

                <div class="form-group">
                    <div class="col-sm-3 col-sm-offset-2">
                        <button type="submit" name="button" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </form>
        </div><!-- /.box-body -->
    </div>
@endsection
