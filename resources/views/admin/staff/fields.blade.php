
<div class="row gutter">
    <div class="col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    {{ Form::label('name', 'Name *') }}
                </div>
                <div class="col-sm-6 text-right">
                        @lang('urdu.name')
                </div>
            </div>
            
            {{ Form::text('name', null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-6">
        <div class="form-group">

            {{ Form::label('staff_type_id', 'Staff Type *') }}
            @lang('urdu.staff') @lang('urdu.type')
            {{ Form::select('staff_type_id', $staff_types, null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>
</div>

<div class="row gutter">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('phone', 'Phone') }}
            @lang('urdu.phone')
            {{ Form::text('phone', null, ['class' => 'form-control', 'data-phone', 'placeholder' => '03xx-xxxxxx'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('address', 'address') }}
            @lang('urdu.address')
            {{ Form::text('address', null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>
</div>

<div class="row gutter">
    <div class="col-md-3 col-xs-8">
        <div class="form-group">
            {{ Form::label('cnic', 'CNIC*') }}
            @lang('urdu.cnic')
            {{ Form::text('cnic', null, ['class' => 'form-control', 'data-cnic', 'placeholder' => 'XXXXX-XXXXXXX-X'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-3  col-xs-4">
        <div class="form-group">
            {{ Form::label('cnic_expiry', 'CNIC Expiry*') }}
            <span> @lang('urdu.cnic') @lang('urdu.expiry')</span>
            {{ Form::text('cnic_expiry', null, ['class' => 'form-control', 'data-date', 'readonly'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-3 col-xs-8">
        <div class="form-group">
            {{ Form::label('licences', 'Licences') }}
            @lang('urdu.licence')
            {{ Form::text('licences', null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-3  col-xs-4">
        <div class="form-group">
            {{ Form::label('licences_expiry', 'Licences Expiry') }}
            @lang('urdu.licence') @lang('urdu.expiry')
            {{ Form::text('licences_expiry', null, ['class' => 'form-control', 'data-date', 'readonly'])}}
        </div><!--form-group-->
    </div>
</div>

    <div class="form-group">
        <input name="status" value="1" type="checkbox" {{ (isset($staff) && $staff->status) || !isset($staff) ? 'checked' : '' }} id="status">
        <label for="stutus">Active @lang('urdu.active')</label>
    </div>

<div class="row gutter">

    <div class="col-md-6 col-sm-12 mb-3">
        <button type="submit" class="btn btn-success btn-block">
                <div class="row">
                        <div class="col-sm-6">
                            Save
                        </div>
                        <div class="col-sm-6 text-center">
                            @lang('urdu.save')
                        </div>
                    </div>
        </button>
        
    </div>
    <div class="col-md-6 col-sm-12">
        <a href="{{ route('admin.staff.index') }}" class="btn btn-primary btn-block">
            <div class="row">
                <div class="col-sm-6">
                    Cancel
                </div>
                <div class="col-sm-6 text-center">
                    @lang('urdu.cancel')
                </div>
            </div></a>
    </div>

</div>


