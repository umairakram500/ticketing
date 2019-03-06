@extends('admin.layouts.app')

@section('title', 'Schedule')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row gutter">
        <div class="col-sm-12 col-xs-12">
            <div class="panel">
                <div class="panel-body">

                    {{ Form::open(['route' => ['admin.schedule.store', $bus->id]]) }}

                    <div class="row gutter">
                        <div class="col-sm-12">
                            <div class="form-group">
                                {{ Form::label('title', 'Bus Title & Number') }}
                                {{ Form::text('title', $title, ['class' => 'form-control', 'readonly'])}}
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
                                    {{ Form::text('depart_time',  \Carbon\Carbon::now()->format('Y-m-d h:i a'), ['class' => 'form-control .datepicker', 'placeholder' => 'Date & Time', 'id' => 'datefrom', 'readonly' ])}}
                                </div>
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('reach_time', 'Reach time *') }}
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                    {{ Form::text('reach_time', \Carbon\Carbon::now()->format('Y-m-d h:i a'), ['class' => 'form-control', 'placeholder' => 'Date & Time', 'id' => 'dateto', 'readonly'])}}
                                </div>
                            </div><!--form-group-->
                        </div>
                    </div>

                    <div class="row gutter">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('route_id', 'Route *') }}
                                {{ Form::select('route_id', $routes, $bus->route_id, ['class' => 'form-control', 'placeholder' => 'Select', 'id' => 'route'])}}
                            </div><!--form-group-->
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('fare', 'Fare *') }}

                                <div class="input-group">
                                    <span class="input-group-addon">Rs.</span>
                                    {{ Form::number('fare', $fare, ['class' => 'form-control', 'placeholder' => 'Amount', 'min' => 1, 'max' => 1000, 'id' => 'fare'])}}
                                </div>
                            </div><!--form-group-->
                        </div>

                    </div>

                    <div class="row gutter">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('driver_id', 'Driver *') }}
                                {{ Form::select('driver_id', $drivers, $bus->driver_id, ['class' => 'form-control', 'placeholder' => 'Select'])}}
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('conductor_id', 'Conductor *') }}
                                {{ Form::select('conductor_id', $conductors, $bus->conductor_id, ['class' => 'form-control', 'placeholder' => 'Select'])}}
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

@push('after-js')
<script>
    $(document).ready(function () {
        $('#route').change(function(){
             var route = $(this, 'option:selected').val();
            $.get('{{url('/admin/schedule/getRouteFare/'.$bus->luxury->id)}}/'+route, function(res){
                $('#fare').val(res)
            })
        })
    })
</script>
@endpush

