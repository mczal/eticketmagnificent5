@extends('layouts.app')

@section('title', 'Statistic Detail')
@section('header', 'Statistic')

@section('content')
<p>
    <a href="{{ url('/statistics' ) }}" class="btn btn-primary"><i class="fa fa-bars"></i> View List</a>
</p>
<div class="box box-solid">
    <div class="box-header">
        <h3 class="box-title">General</h3>
    </div>
    <div class="box-body text-left">
        <div class="container">

            <!-- Type ID -->
            <div class="row">
                <div class="form-group">
                    <label class="col-sm-2 control-label">ID</label>
                    <div class="col-sm-6">
                        {{  $type->id }}
                    </div>
                </div>
            </div>

            <!-- Type Name -->
            <div class="row">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-6">
                        {{ $type->name }}
                    </div>
                </div>
            </div>

            <!-- Type Price -->
            <div class="row">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Price</label>
                    <div class="col-sm-6">
                        {{ $type->price }}
                    </div>
                </div>
            </div>

            <!-- Type Status -->
            <div class="row">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-6">
                       {{ $type->active == 1 ? 'Active' : 'Not Active' }}
                    </div>
                </div>
            </div>

            <!-- Total Tickets -->
            <div class="row">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Total Tickets</label>
                    <div class="col-sm-6">
                        {{ $total }}
                    </div>
                </div>
            </div>

            <!-- Type Remaining Av. Ticket -->
            <div class="row">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Remaining Tickets</label>
                    <div class="col-sm-6">
                        {{ $remaining }}
                    </div>
                </div>
            </div>

            <!-- Type Total -->
            <div class="row">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Total Ticket</label>
                    <div class="col-sm-6">
                        {{ $total }}
                    </div>
                </div>
            </div>

            <!-- Ordered Tickets Count -->
            <div class="row">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Ordered Ticket Count</label>
                    <div class="col-sm-6">
                        {{ $ordered }}
                    </div>
                </div>
            </div>

            <!-- Actived Tickets Count -->
            <div class="row">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Actived Ticket Count</label>
                    <div class="col-sm-6">
                        {{ $actived }}
                    </div>
                </div>
            </div>

            <!-- CheckedIn Tickets Count -->
            <div class="row">
                <div class="form-group">
                    <label class="col-sm-2 control-label">CheckedIn Ticket Count</label>
                    <div class="col-sm-6">
                        {{ $checkedIn }}
                    </div>
                </div>
            </div>

            <!-- SLNDLMDLKSMDL TODO DELETE -->

        </div>
    </div>
</div>
@endsection
