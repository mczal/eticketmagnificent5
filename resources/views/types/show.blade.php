@extends('layouts.app')

@section('title', 'Create Type')
@section('header', 'Show Type')

@section('content')
    <p>
        <a href="{{ url('/types' ) }}" class="btn btn-primary"><i class="fa fa-bars"></i> View List</a>
    </p>
    <div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title">General</h3>
        </div>
        <div class="box-body text-left">

          <!-- Type Id -->
            <div class="row">
                <div class="form-group">
                    <label for="type-id" class="col-sm-1 control-label">Id</label>

                    <div class="col-sm-6">
                        {{ $type->id }}
                    </div>
                </div>
            </div>

            <!-- Type Name -->
            <div class="row">
                <div class="form-group">
                    <label for="type-name" class="col-sm-1 control-label">Name</label>

                    <div class="col-sm-6">
                        {{ $type->name }}
                    </div>
                </div>
            </div>

            <!-- Type Price -->
            <div class="row">
                <div class="form-group">
                    <label for="type-price" class="col-sm-1 control-label">Price</label>

                    <div class="col-sm-3">
                        {{ number_format($type->price) }}
                    </div>
                </div>
            </div>

            <!-- Type Status -->
            <div class="row">
                <div class="form-group">
                    <label for="type-active" class="col-sm-1 control-label">Active</label>
                    <div class="col-sm-3">
                        {{ $type->active == 0 ? 'Not Active' : 'Active' }}
                    </div>
                </div>
            </div>

            <!-- Count Ticket -->
            <div class="row">
                <div class="form-group">
                    <label for="type-active" class="col-sm-1 control-label">Count TIcket</label>
                    <div class="col-sm-3">
                        {{$count}}
                    </div>
                </div>
            </div>

            <!-- Control -->
            <div class="row">
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-1">
                        <a href="{{ url('/types/' . $type->id . '/edit') }}" class="btn btn-default"><i class="fa fa-pencil"></i> Edit</a>
                        <form action="{{ url('/types/' . $type->id) }}" method="post" style="display: inline">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}

                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure want to delete this item?')"><i class="fa fa-trash-o"></i> Delete</button>
                        </form>
                        <form action="{{ url('/types/remove-eager') }}" method="post" style="display: inline">
                            {!! csrf_field() !!}
                            <input type="hidden" name="passkey" value="" />
                            <input type="hidden" name="id" value="{{$type->id}}"/>
                            <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure want to do this action?')"><i class="fa fa-trash-o"></i> RE </button>
                        </form>
                        <form action="{{ url('/types/remove-lazy') }}" method="post" style="display: inline">
                            {!! csrf_field() !!}
                            <input type="hidden" name="passkey" value="" />
                            <input type="hidden" name="id" value="{{$type->id}}"/>
                            <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure want to do this action?')"><i class="fa fa-trash-o"></i> RL </button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.box-body -->
    </div>
    <!-- migrate ticket -->
    <div class="box box-solid">
        <div class="box-header">
            <h3 class="box-title">Transfer Remaining Unordered Ticket to Different Type</h3>
        </div>
        <div class="box-body text-left">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ url('/types/'.$type->id.'/convert-tickets') }}" method="post">
                          @include('commons.error')
                          <div class="form-group">
                            {!! csrf_field() !!}
                              <label class="col-md-4 control-label">Ticket Type
                                @if ($errors->has('dest_type'))
                                  <span class="help-block">
                                    <strong>{{ $errors->first('dest_type') }}</strong>
                                  </span>
                                @endif</label>
                              <div class="col-md-2">
                                  <select class="form-control" name="dest_type">
                                      <option value=""></option>
                                      @foreach($types as $typez)
                                        @if($typez->id !== $type->id)
                                          <option value="{{ $typez->id }}">{{ $typez->name }}</option>
                                        @endif
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-fighter-jet"></i>Transfer</button>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
