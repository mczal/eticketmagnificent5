@extends('layouts.app')

@section('title', 'Types')
@section('header', 'Types')
@section('subheader', 'Type List')

@section('content')
    <p>
        <a href="{{ url('/types/create' ) }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create new</a>
    </p>
    <div class="box box-solid">
        <div class="box-body">
            @include('commons.success')
            <p>
                <form action="{{ url('/types') }}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="name" value="{{ $name }}" id="name" placeholder="Enter name to search ....">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-flat" type="submit"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </p>
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
                                <a href="{{ url('/types/'.$type->id) }}" class="btn btn-default"><i class="fa fa-eye"></i></a>
                                <a href="{{ url('/types/'.$type->id.'/edit') }}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                                <a href="{{ url('/types/print/'.$type->id) }}" class="btn btn-default"><i class="fa fa-print"></i></a>
                                <form action="{{ url('/types/'.$type->id.'') }}" method="post" style="display:inline">
                                    {!! csrf_field() !!}
                                    {!! method_field('DELETE') !!}

                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this item?')"><i class="fa fa-trash-o"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $types->appends(['name' => $name])->links() !!}
        </div><!-- /.box-body -->
    </div>
@endsection
