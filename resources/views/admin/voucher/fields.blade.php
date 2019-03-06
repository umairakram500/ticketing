
    <div class="form-group">
        <div class="row">
            <div class="col-sm-6">
                {{ Form::label('name', 'Title *') }}
            </div>
            <div class="col-sm-6 text-right">
                @lang('urdu.title')
            </div>
        </div>                
        {{ Form::text('name', null, ['class' => 'form-control'])}}
    </div><!--form-group-->

    <div class="form-group">
        <div class="row">
            <div class="col-sm-6">
                {{ Form::label('remarks', 'Remarks') }}
            </div>
            <div class="col-sm-6 text-right">
                @lang('urdu.remark')
            </div>
        </div>
        
        {{ Form::textarea('remarks', null, ['class' => 'form-control', 'rows' => 4])}}
    </div><!--form-group-->

    <div class="form-group">
        <div class="row">
            <div class="col-sm-6">
                    <input name="status" value="1" type="checkbox" {{ (isset($city) && $city->status) || !isset($city) ? 'checked' : '' }} id="status">
                    <label for="stutus">Active</label>
            </div>
            <div class="col-sm-6 text-right">
                    @lang('urdu.active')
            </div>
        </div>
    </div>

    <div class="form-group mb-0 clearfix">
        
        <button class="btn btn-success btn-block" type="submit">
            <div class="row">
                <div class="col-sm-6">
                    Save
                </div>
                <div class="col-sm-6 text-center">
                    @lang('urdu.save')
                </div>
            </div>
            
        </button>
    </div><!--form-group-->


