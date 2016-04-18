@extends('layouts.app')
@section('title', 'Confirmations')
@section('header', 'Confirmations')

@section('content')

<!--
  <p>
      <a class="btn btn-primary" href={{url('/confirmations/create')}} role="button"><i class="fa fa-plus"></i> Create New</a>
  </p>
-->
  <div class="box box-solid">
  <div class="box-body">
    <p>
        <form action="{{ url('/confirmations') }}" method="get">
            <div class="input-group">
              <select class="form-control" name="status">
                <option value="-1"{{ app('request')->input('status') == -1 ? ' selected' : '' }}>Semua</option>
                <option value="0"{{ app('request')->input('status') == 0 ? ' selected' : '' }}>Belum divalidasi</option>
                <option value="1"{{ app('request')->input('status') == 1 ? ' selected' : '' }}>Sudah tervalidasi</option>
              </select>
                <span class="input-group-btn">
                    <button class="btn btn-info btn-flat" type="submit"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
    </p>
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Validate</th>
        <th>Order</th>
        <th>No Rekening</th>
        <th>Nama Pemilik Bank</th>
        <th>Nama Bank</th>
        <th>Total Transfer</th>
        <th>Total Must Paid</th>
        <th>Created At</th>
        <th></th>
      </tr>
    </thead>
    @if( count($confirmations) > 0)
      <tbody>
        @foreach($confirmations as $confirmation)
          <tr>
            <td>
              @if ($confirmation->status == 0)
                <form style="display:inline" action="{{url('/confirmations/validate')}}" method="post">
                  {!! csrf_field() !!}
                  <input readOnly type="hidden" type="number" name="id" value="{{ $confirmation->id }}">
                  <button type="submit" class="btn btn-success" onclick="return confirm('All tickets registered will be active !')">Validate</button>
                </form>
              @else
              <button class="btn btn-default" disabled>Valid</button>
              @endif
            </td>
            <td><a href="{{ url('/orders/' . $confirmation->order->id) }}" target="_blank">{!! $confirmation->order->no_order . '<br>' . $confirmation->order->name !!}</a></td>
            <td>{{$confirmation->no_rekening}}</td>
            <td>{{$confirmation->name}}</td>
            <td>{{$confirmation->nama_bank}}</td>
            <td>{{number_format($confirmation->total_transfer)}}</td>
            <td>{{number_format($confirmation->order->total_price)}}</td>
            <td>{{$confirmation->created_at}}</td>
            <td>
              <a href="{{url('/confirmations/'.$confirmation->id)}}" class="btn btn-default"><i class="fa fa-eye"></i></a>
            <!--
              <a href="{{url('/confirmations/'.$confirmation->id.'/edit')}}" class="btn btn-default"><i class="fa fa-pencil"></i></a>
            -->
              <form style="display:inline" action="{{url('/confirmations/'.$confirmation->id)}}" method="post">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}

                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this item?')"><i class="fa fa-trash-o"></i></button>

              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    @endif
  </table>
</div>
</div>
  {!! $confirmations->render() !!}
@endsection
