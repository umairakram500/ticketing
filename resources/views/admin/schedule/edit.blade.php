@extends('admin.layouts.app')

@section('title', 'Schedule Update')

@section('content')
    @if ($errors->any() || Session::has( 'flash_error' ))
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                @if(Session::has( 'flash_error' ))
                    <li>{{ Session::get( 'flash_error' ) }}</li>
                @endif
            </ul>
        </div>
    @endif
    <div class="row gutter">
        <div class="col-sm-12 col-xs-12">
            <div class="panel">
                <div class="panel-body">

                    {{ Form::model($schedule, ['route' => ['admin.schedule.update', $schedule->id], 'method' => 'PUT']) }}

                    <div class="row gutter">
                        <div class="col-sm-12">
                            <div class="form-group">
                                {{ Form::label('bus_id', 'Bus Title & Number') }}
                                {{ Form::select('bus_id', $buses, null, ['class' => 'form-control'])}}
                                {{ Form::hidden('href', \Illuminate\Support\Facades\Request::server('HTTP_REFERER')) }}
                            </div><!--form-group-->
                        </div>
                    </div>

                    <div class="row gutter">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('depart_time', 'Departure Time *') }}

                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                    {{ Form::text('depart_time', $depart_time, ['class' => 'form-control .datepicker', 'placeholder' => 'Date & Time', 'id' => 'datefrom', 'readonly' ])}}
                                </div>
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('reach_time', 'Reach time *') }}
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                    {{ Form::text('reach_time', $reach_time, ['class' => 'form-control', 'placeholder' => 'Date & Time', 'id' => 'dateto', 'readonly'])}}
                                </div>
                            </div><!--form-group-->
                        </div>
                    </div>

                    <div class="row gutter">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('fare', 'Fare *') }}

                                <div class="input-group">
                                    <span class="input-group-addon">Rs.</span>
                                    {{ Form::number('fare', null, ['class' => 'form-control', 'placeholder' => 'Amount', 'min' => 1, 'max' => 1000])}}
                                </div>
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('route_id', 'Route *') }}
                                {{ Form::select('route_id', $routes, null, ['class' => 'form-control', 'placeholder' => 'Select'])}}
                            </div><!--form-group-->
                        </div>
                    </div>

                    <div class="row gutter">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('driver_id', 'Driver *') }}
                                {{ Form::select('driver_id', $drivers, null, ['class' => 'form-control', 'placeholder' => 'Select'])}}
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('conductor_id', 'Conductor *') }}
                                {{ Form::select('conductor_id', $conductors, null, ['class' => 'form-control', 'placeholder' => 'Select'])}}
                            </div><!--form-group-->
                        </div>
                    </div>

                    <div class="row gutter mt-3">
                        <div class="col-md-6 col-sm-12">
                            {{ Form::submit( 'Save', ['class' => 'btn btn-success btn-block']) }}
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <a href="{{ route('admin.route.index') }}" class="btn btn-default btn-block">Cancel</a>
                        </div>
                    </div>

                    {{ Form::close() }}

                </div>
            </div>

        </div>
    </div>

@endsection

