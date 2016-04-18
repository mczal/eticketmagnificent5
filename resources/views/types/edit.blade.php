@extends('layouts.app')

@section('title', 'Create Type')
@section('header', 'Create New')
@section('subheader', 'Create New Type')

@section('content')
    <p>
        <a href="{{ url('/types') }}" class="btn btn-primary"><i class="fa fa-bars"></i> View List</a>
    </p>
    <div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title">General</h3>
        </div>
        <div class="box-body text-left">
            <form class="form-horizontal" action="{{ url('/types/' . $type->id) }}" method="post">
                {!! csrf_field() !!}
                {!! method_field('PATCH') !!}
                @include('types._form')

                <div class="form-group">
                    <div class="col-sm-3 col-sm-offset-1">
                        <button type="submit" name="button" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
            </form>
        </div><!-- /.box-body -->
    </div>
@endsection
