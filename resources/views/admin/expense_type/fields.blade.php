
<div class="row guttor">
    <div class="col-xs-6">
        <div class="form-group">
            {{ Form::label('tilte', 'Title *') }}
            {{ Form::text('title', null, ['class' => 'form-control', 'autofocus'])}}
        </div><!--form-group-->
    </div>

    <div class="col-sm-6 col-xs-12">
        <div class="form-group">
            {{ Form::label('amount', 'Dedection Amount *') }}
            <div class="input-group">
                <span class="input-group-addon">Rs.</span>
                {{ Form::text('amount', null, ['class' => 'form-control', 'placeholder' => 'Amount'])}}
            </div>
        </div><!--form-group-->
    </div>
</div>

<div class="row guttor">
    <div class="col-xs-4 hidden">
        <div class="form-group">
            {{ Form::checkbox('night_diff', 1, null, ['data-check', 'id' => 'night_diff']) }}
            <label for="night_diff">Different night dedection</label>
        </div>
    </div>

    <div class="col-xs-4">
        <div class="form-group">
            {{ Form::checkbox('terminal_deduct', 1, null, ['data-check']) }}
            <label for="terminal_deduct">Deduct on Terminal</label>
        </div>
    </div>

    <div class="col-xs-4">
        <div class="form-group">
            {{ Form::checkbox('changeable', 1, null, ['data-check']) }}
            <label for="changeable">Change able</label>
        </div>
    </div>
</div>

<div class="row guttor night_deduct hidden">
    <div class="col-xs-12 custom-tabs">
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li class="active"><a data-toggle="tab" class="p-3" href="#sender">Night Dedection</a></li>
            <li></li>
        </ul>

        <div class="tab-content pt-4 pb-2 mb-4">
            <!-- Sender Information -->
            <div id="sender" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-sm-3 col-xs-6">
                        <div class="form-group">
                            {{ Form::label('nightfrom', 'Time From *') }}
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                {{ Form::text('nightfrom', null, ['class' => 'form-control'])}}
                            </div>
                        </div><!--form-group-->
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <div class="form-group">
                            {{ Form::label('nightto', 'Time To *') }}
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                {{ Form::text('nightto', null, ['class' => 'form-control'])}}
                            </div>
                        </div><!--form-group-->
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            {{ Form::label('nightamount', 'Dedection Amount *') }}
                            <div class="input-group">
                                <span class="input-group-addon">Rs.</span>
                                {{ Form::number('nightamount', null, ['class' => 'form-control', 'placeholder' => 'Amount'])}}
                            </div>
                        </div><!--form-group-->
                    </div>
                </div>
            </div>
            <!-- End:Sender Information -->
        </div>
    </div>
</div>





<div class="row guttor">
    <div class="col-md-6">

        <div class="form-group">
            <?php $accounts = \App\Models\AccountType::all()->pluck('AccountName', 'AccountID'); ?>
            {{ Form::label('refcode', 'Reference Number') }}
            {{ Form::select('refcode', $accounts, null, ['class' => 'form-control', 'placeholder'=>'Select Account', 'required'])}}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <br>

            <input name="status" value="1" type="checkbox" {{ (isset($expense_type) && $expense_type->status) || !isset($expense_type) ? 'checked' : '' }} id="status">
            <label for="stutus">Active</label>
        </div>
    </div>
</div>

<br>

<div class="row guttor">
    <div class="col-md-6">
        <div class="form-group mb-0 clearfix">
        <a href="#" class="btn btn-block btn-primary">CANCEL</a>
        </div><!--form-group-->
    </div>
    <div class="col-md-6">
        <div class="form-group mb-0 clearfix">
            {{ Form::submit( 'Save', ['class' => 'btn btn-success btn-block']) }}
        </div><!--form-group-->
    </div>
</div>
{{ old('night_diff') }}

@push('after-js')

<script>
    $(document).ready(function(){
        $('#refcode').select2();
        var startTimeTextBox = $('#nightfrom');
        var endTimeTextBox = $('#nightto');

        $.timepicker.timeRange(
            startTimeTextBox,
            endTimeTextBox,
            {
                controlType: 'select',
                oneLine: true,
                timeFormat: 'hh:mm tt',
                stepMinute: 5,
                minInterval: (1000*60*60), // 1hr
                start: {}, // start picker options
                end: {} // end picker options
            }
        );

        $('#night_diff').on('ifChanged', function(){
            console.log( $(this).is(':checked'));
            $('.night_deduct input').val('').prop('readonly', !$(this).is(':checked'));
        });
        @if(((!isset($expense_type) || (int)$expense_type->night_diff==0) && !old('night_diff')))
        $('.night_deduct input').val('').prop('readonly', true);
        @endif
    })
</script>

@endpush



