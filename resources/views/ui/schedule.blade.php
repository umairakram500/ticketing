@extends('admin.layouts.app')

@section('title', 'Schedule')

@section('content')

    <div class="row gutter">
        <div class="col-sm-12 col-xs-12">
            <div class="panel">
                <div class="panel-body">




                    <div class="row gutter">
                        <div class="col-md-8 col-sm-12">
                            <?php $routes = \App\Models\Route\Route::Selection(); ?>
                            <div class="form-group">
                                {{ Form::label('route_id', 'Route *') }}
                                {{ Form::select('route_id', $routes, null, ['class' => 'form-control', 'placeholder' => ''])}}
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <?php $types = \App\Models\Bus\LuxuryType::Selection(); ?>
                            <div class="form-group">
                                {{ Form::label('luxury_type', 'Luxury Type *') }}
                                {{ Form::select('luxury_type', $types, null, ['class' => 'form-control', 'placeholder' => ''])}}
                            </div><!--form-group-->
                        </div>
                    </div>

                    <div class="row gutter">
                        <div class="col-md-4 col-sm-12">
                            <?php $types = \App\Models\Bus\LuxuryType::Selection(); ?>
                            <div class="form-group">
                                {{ Form::label('type', 'Type *') }}
                                {{ Form::select('type', array('Permanent', 'Range', 'Specific Date', 'Drop' ), null, ['class' => 'form-control'])}}
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <?php $routes = \App\Models\Route\Route::Selection(); ?>
                            <div class="form-group">
                                {{ Form::label('from_date', 'From Date *') }}
                                {{ Form::text('from_date', null, ['class' => 'form-control'])}}
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <?php $routes = \App\Models\Route\Route::Selection(); ?>
                            <div class="form-group">
                                {{ Form::label('to_date', 'To Date *') }}
                                {{ Form::text('to_date', null, ['class' => 'form-control'])}}
                            </div><!--form-group-->
                        </div>
                    </div>

                    <div class="row gutter pb-5">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('note', 'Note') }}
                                {{ Form::text('note', null, ['class' => 'form-control'])}}
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <?php $cities= \App\Models\City::Select('name'); ?>
                            <div class="form-group">
                                {{ Form::label('from_date', 'From Date *') }}
                                {{ Form::select('from_date', $cities, null, ['class' => 'form-control'])}}
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-4 col-sm-12 pt-2">
                            <div class="form-group mt-5">
                                {{ Form::checkbox('reverse', null, ['class' => 'form-control'])}}
                                {{ Form::label('reverse', 'Reverse Order *') }}
                            </div><!--form-group-->
                        </div>
                    </div>

                    <div class="row gutter">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <h4 class="mt-5 text-muted">Lahore</h4>
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('departure', 'Departure *') }}
                                {{ Form::text('departure', null, ['class' => 'form-control', 'placeholder'=>'Departure'])}}
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('arrival', 'Arrival *') }}
                                {{ Form::text('arrival', null, ['class' => 'form-control', 'placeholder'=>'Departure'])}}
                            </div><!--form-group-->
                        </div>
                    </div>
                    <div class="row gutter">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <h4 class="mt-5 text-muted">Shekhupura</h4>
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('departure', 'Departure *') }}
                                {{ Form::text('departure', null, ['class' => 'form-control', 'placeholder'=>'Departure'])}}
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('arrival', 'Arrival *') }}
                                {{ Form::text('arrival', null, ['class' => 'form-control', 'placeholder'=>'Departure'])}}
                            </div><!--form-group-->
                        </div>
                    </div>
                    <div class="row gutter">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <h4 class="mt-5 text-muted">Manawala</h4>
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('departure', 'Departure *') }}
                                {{ Form::text('departure', null, ['class' => 'form-control', 'placeholder'=>'Departure'])}}
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('arrival', 'Arrival *') }}
                                {{ Form::text('arrival', null, ['class' => 'form-control', 'placeholder'=>'Departure'])}}
                            </div><!--form-group-->
                        </div>
                    </div>
                    <div class="row gutter">
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <h4 class="mt-5 text-muted">Faisalabad</h4>
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('departure', 'Departure *') }}
                                {{ Form::text('departure', null, ['class' => 'form-control', 'placeholder'=>'Departure', 'disable'])}}
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                {{ Form::label('arrival', 'Arrival *') }}
                                {{ Form::text('arrival', null, ['class' => 'form-control', 'placeholder'=>'Departure', 'disable'])}}
                            </div><!--form-group-->
                        </div>
                    </div>
                </div>

                <div class="row gutter">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group clearfix">
                            {{ Form::submit( 'Save', ['class' => 'btn btn-success btn-block py-3']) }}
                        </div><!--form-group-->
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group clearfix">
                            <a href="{{ route('admin.route.index') }}" class="btn btn-default btn-block py-3">Cancel</a>
                        </div><!--form-group-->
                    </div>
                </div>





            </div>
            </div>

        </div>
    </div>


@endsection

