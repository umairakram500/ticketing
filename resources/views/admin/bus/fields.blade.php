
<div class="row gutter">
    <div class="col-sm-12">
        <div class="form-group">
            {{ Form::label('title', 'Title *') }}
            {{ Form::text('title', null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>
</div>

<div class="row gutter">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            {{ Form::label('route_id', 'Route') }}
            {{ Form::select('route_id', $routes, null, ['class' => 'form-control', 'placeholder' => 'Select'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="row gutter">
            <div class="col-xs-6">
                <div class="form-group">
                    {{ Form::label('bus_type_id', 'Bus Type *') }}
                    {{ Form::select('bus_type_id', $bus_types, null, ['class' => 'form-control'])}}
                </div><!--form-group-->
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    {{ Form::label('luxury_type_id', 'Luxury Type *') }}
                    {{ Form::select('luxury_type_id', $luxury_types, null, ['class' => 'form-control'])}}
                </div><!--form-group-->
            </div>
        </div>
    </div>
</div>



<div class="row gutter">
    <div class="col-md-6 col-sm-12">
        <div class="form-group row gutter">
            <div class="col-xs-4">
                {{ Form::label('seats', 'Total Seats *') }}
                {{ Form::text('seats', null, ['class' => 'form-control'])}}
            </div>
            <div class="col-xs-4">
                {{ Form::label('foldings', 'Foldings') }}
                {{ Form::text('foldings', null, ['class' => 'form-control'])}}
            </div>
            <div class="col-xs-4">
                {{ Form::label('standees', 'Standees') }}
                {{ Form::text('standees', null, ['class' => 'form-control'])}}
            </div>

        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="row gutter">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('number', 'Bus Number') }}
                    {{ Form::text('number', null, ['class' => 'form-control'])}}
                </div><!--form-group-->
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('refcode', 'Reference Number') }}
                    {{ Form::text('refcode', null, ['class' => 'form-control',])}}
                </div>
            </div>

            </div>
    </div>
</div>


<div class="row gutter">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            {{ Form::label('driver_id', 'Driver') }}
            {{ Form::select('driver_id', $drivers, null, ['class' => 'form-control', 'placeholder' => 'Select'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            {{ Form::label('conductor_id', 'Conductor') }}
            {{ Form::select('conductor_id', $conductors, null, ['class' => 'form-control', 'placeholder' => 'Select'])}}
        </div><!--form-group-->
    </div>
</div>


<div class="row gutter">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            {{ Form::label('', 'Status') }}
            <div class="clearfix"><p></p></div>
            <input name="status" value="1" type="checkbox"
                   {{ (isset($route) && $route->status) || !isset($route) ? 'checked' : '' }} id="status">
            <label for="stutus">Active</label>
        </div>
    </div>
</div>




<div class="row gutter">
    <div class="col-md-6 col-sm-12">
        <div class="form-group clearfix">
            {{ Form::submit( 'Save', ['class' => 'btn btn-success btn-block']) }}
        </div><!--form-group-->
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group clearfix">
            <a href="{{ route('admin.route.index') }}" class="btn btn-default btn-block">Cancel</a>
        </div><!--form-group-->
    </div>
</div>













