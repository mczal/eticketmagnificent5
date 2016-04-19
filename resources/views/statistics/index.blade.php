@extends('layouts.app')

@section('title', 'Statistics')
@section('header', 'Statistics')
@section('subheader', 'Type List')

@section('content')
    <p>
        <a href="{{ url('/statistics' ) }}" class="btn btn-primary"><i class="fa fa-bars"></i> View List</a>
    </p>
    <div class="box box-solid">
        <div class="box-body">
            @include('commons.success')
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Active</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($types) == 0)
                        <tr>
                            <td colspan="4" align="center">No data found ...</td>
                        </tr>
                    @endif
                    @foreach($types as $type)
                        <tr>
                            <td>{{ $type->id }}</td>
                            <td>{{ $type->name }}</td>
                            <td>{{ number_format($type->price) }}</td>
                            <td>{{ $type->active == 1 ? 'Active' : 'Not Active' }}</td>
                            <td>
                                <a href="{{ url('/statistics/'.$type->id) }}" class="btn btn-default"><i class="fa fa-eye"></i> View Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div>
@endsection
