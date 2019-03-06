
    <div class="form-group">
        {{ Form::label('name', 'Title *') }}
        {{ Form::text('name', null, ['class' => 'form-control'])}}
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('remarks', 'Remarks') }}
        {{ Form::textarea('remarks', null, ['class' => 'form-control', 'rows' => 4])}}
    </div><!--form-group-->

    <div class="form-group">
        <input name="status" value="1" type="checkbox" {{ isset($city) && $city->status ? 'checked' : '' }} id="status">
        <label for="stutus">Active</label>
    </div>

    <div class="form-group mb-0 clearfix">
        {{ Form::submit( 'Save', ['class' => 'btn btn-success btn-block']) }}
    </div><!--form-group-->


