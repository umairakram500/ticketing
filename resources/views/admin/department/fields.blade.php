
    <div class="form-group">
        {{ Form::label('title', 'Title *') }}
        {{ Form::text('title', null, ['class' => 'form-control'])}}
    </div><!--form-group-->

    <div class="form-group">
        {{ Form::label('code', 'Code') }}
        {{ Form::text('code', null, ['class' => 'form-control'])}}
    </div><!--form-group-->

    <div class="form-group">
        <input name="status" value="1" type="checkbox" {{ (isset($department) && $department->status) || !isset($department) ? 'checked' : '' }} id="status">
        <label for="stutus">Active</label>
    </div>

    <div class="form-group mb-0 clearfix">
        {{ Form::submit( 'Save', ['class' => 'btn btn-success btn-block']) }}
    </div><!--form-group-->


