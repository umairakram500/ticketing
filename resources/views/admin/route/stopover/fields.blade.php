<?php
$hrs = array();
for ($i = 0; $i <= 20; $i++)
    $hrs[$i] = $i . ' hr' . ($i > 1 ? 's' : '');
$mins = array();
for ($i = 0; $i <= 59; $i = $i + 5)
    $mins[$i] = $i . ' min';

?>

<div class="row gutter">
    <div class="col-xs-6">
        <div class="form-group">
            {{ Form::label('from_stop_id', 'From Stop *') }}
            {{ Form::select('from_stop_id', array(), null, ['class' => 'form-control', 'placeholder' => 'Select'])}}
        </div><!--form-group-->
    </div>
    <div class="col-xs-6">
        <div class="form-group">
            {{ Form::label('to_stop_id', 'To Stop*') }}
            {{ Form::select('to_stop_id', array(), null, ['class' => 'form-control', 'placeholder' => 'Select'])}}
        </div><!--form-group-->
    </div>
</div>


<div class="row gutter">
    <div class="col-md-6 col-sm-12">
        {{ Form::label('Travel_time', 'Travel Time *') }}
        <div class="row gutter">
            <div class="col-xs-6">
                {{ Form::select('hrs', $hrs, (isset($route)?$route->travel_hrs:null), ['class' => 'form-control col-sm-6', 'placeholder' => 'Hour\'s'])}}
            </div>
            <div class="col-xs-6">
                {{ Form::select('mins', $mins, (isset($route)?$route->travel_mins:null), ['class' => 'form-control col-sm-6', 'placeholder' => 'Mint\'s'])}}
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="form-group">
            {{ Form::label('fare', 'Fare *') }}
            {{ Form::text('fare', null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="form-group">
            {{ Form::label('kms', 'KMs *') }}
            {{ Form::text('kms', null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>
</div>



    <div class="form-group">
        <input name="status" value="1" type="checkbox" {{ isset($city) && $city->status ? 'checked' : '' }} id="status">
        <label for="stutus">Active</label>
    </div>

    <div class="form-group mb-0 clearfix">
        {{ Form::submit( 'Save', ['class' => 'btn btn-success btn-block']) }}
    </div><!--form-group-->


