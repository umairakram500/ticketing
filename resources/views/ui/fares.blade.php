@extends('admin.layouts.app')

@section('title', 'fares')
@section('content')
    <div class="row gutter">
        <div class="col-sm-12 col-xs-12">
            <div class="panel">
                <div class="panel-body pb-0">

                    <div class="row gutter">
                        <div class="col-md-6 col-sm-12">
                            <?php $routes = \App\Models\Route\Route::Selection(); ?>
                            <div class="form-group">
                                {{ Form::label('route_id', 'Route *') }}
                                {{ Form::select('route_id', $routes, null, ['class' => 'form-control', 'placeholder' => ''])}}
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <div class="form-group clearfix">
                                {{ Form::label('', '&nbsp;') }}
                                {{ Form::button( 'Get', ['class' => 'btn btn-info btn-block py-3']) }}
                            </div><!--form-group-->
                        </div>
                    </div>


                    <div id="stopovers" class="my-5">
                        <div class="bg-default">
                            {{ Form::button( 'Deawoo', ['class' => 'btn btn-info btn-block py-3 text-left']) }}
                        </div>
                        <table class="table table-striped table-bordered ">
                            <thead>
                            <tr>
                                <th>From</th>
                                <th>To</th>
                                <th width="150">Fare</th>
                                <th width="150">KM's</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Lahore</td>
                                <td>Shekhupura</td>
                                <td><input type="text" class="form-control"></td>
                                <td><input type="text" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Lahore</td>
                                <td>Manawala</td>
                                <td><input type="text" class="form-control"></td>
                                <td><input type="text" class="form-control"></td>
                            </tr>
                            <tr>
                                <td>Lahore</td>
                                <td>Faisalabad</td>
                                <td><input type="text" class="form-control"></td>
                                <td><input type="text" class="form-control"></td>
                            </tr>
                            </tbody>
                        </table>
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
