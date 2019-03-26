<?php
$terminals = \App\Models\Terminal::selection();
$oldDiesel = old('diesel');
if($oldDiesel != null)
{
    $diesel = $oldDiesel;
}
?>
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
            <?php $cities = \App\Models\City::Selection('name'); ?>
            {{ Form::label('from_city_id', 'From City *') }}
            {{ Form::select('from_city_id', $cities, null, ['class' => 'form-control', 'placeholder' => 'Select'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            {{ Form::label('to_city_id', 'City to *') }}
            {{ Form::select('to_city_id', $cities, null, ['class' => 'form-control', 'placeholder' => 'Select'])}}
        </div><!--form-group-->
    </div>
</div>

<div class="row gutter">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <?php $terminals = \App\Models\Terminal::where('status', 1)->get(); ?>
            {{ Form::label('from_terminal_id', 'Inital Terminal *') }}
            {{--{{ Form::select('from_terminal_id', $terminals, null, ['class' => 'form-control'])}}--}}
                <select name="from_terminal_id" id="from_terminal_id" class="form-control">
                    @forelse($terminals as $terminal)
                        <?php
                            $sel = '';
                            if(isset($route)){
                                $from_terminal = old('from_terminal_id', $route->from_terminal_id);
                                $sel = $terminal->id == $from_terminal ? 'selected' : '';
                            }
                        ?>
                        <option data-city="{{ $terminal->city_id }}" value="{{ $terminal->id }}" {{ $sel }}>{{ $terminal->title }}</option>
                    @empty
                    @endforelse
                </select>
        </div><!--form-group-->
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            {{ Form::label('to_terminal_id', 'Last Terminal *') }}
            {{-- {{ Form::select('to_terminal_id', $terminals, null, ['class' => 'form-control'])}} --}}
            <select name="to_terminal_id" id="to_terminal_id" class="form-control">
                @forelse($terminals as $terminal)
                    <?php
                        $sel = '';
                        if(isset($route)){
                            $from_terminal = old('to_terminal_id', $route->to_terminal_id);
                            $sel = $terminal->id == $from_terminal ? 'selected' : '';
                        }
                    ?>
                    <option data-city="{{ $terminal->city_id }}" value="{{ $terminal->id }}" {{$sel}}>{{$terminal->title}}</option>
                @empty
                @endforelse
            </select>
        </div><!--form-group-->
    </div>
</div>

<?php $terminals = $terminals->pluck('title', 'id') ?>

<div class="row gutter">
    <div class="col-md-6">
        <div class="form-group">
            <?php
                $stops = array();
            if(isset($route->stops)){
                $stops = array_column($route->stops->toArray(), 'terminal_id');
            }
                //dd($stops);
            ?>
            {{ Form::label('stops', 'Stops') }}

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="10"><strong>#</strong></th>
                        <th colspan="2"><strong>Stop(s)</strong></th>
                    </tr>
                </thead>
                <tbody id="stopslist">
                    @forelse($stops as $key => $stop)
                    <tr>
                        <td><strong>{{ $key+1 }}</strong></td>
                        <td>{{ Form::select('stops[]', $terminals, $stop, ['class' => 'form-control']) }}</td>
                        <td><span class="btn btn-primary re_row"><span class="fa fa-times"></span></span></td>
                    </tr>
                    @empty
                    @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3">
                        <button type="button" class="btn btn-primary" id="addstop"><span class="fa fa-plus mr-2"></span> Add Stop</button>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div><!--form-group-->
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            {{ Form::label('status', 'Status *') }}
            {{ Form::select('status', array(1=>'Active', 0=>'Inactive'), null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="row gutter">
            <div class="col-xs-4">
                <div class="form-group">
                    {{ Form::label('kms', 'Manual KM\'s *') }}
                    {{ Form::number('kms', null, ['class' => 'form-control'])}}
                </div><!--form-group-->
            </div>
            <div class="col-xs-4">
                <div class="form-group">
                    {{ Form::label('act_kms', 'KM\'s From G-BOS') }}
                    {{ Form::number('act_kms', null, ['class' => 'form-control', 'readonly'])}}
                </div><!--form-group-->
            </div>
            {{--<div class="col-xs-4">
                <div class="form-group">
                    {{ Form::label('diesel', 'Diesel *') }}
                    {{ Form::number('diesel', null, ['class' => 'form-control'])}}
                </div><!--form-group-->
            </div>--}}
        </div>
        <?php $bustypes = \App\Models\Bus\LuxuryType::selection(); ?>
        {{ Form::label('diesel', 'Diesel *') }}
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <td>Bus Type</td>
                <td>Litres</td>
            </tr>
            </thead>
            @forelse($bustypes as $typeid => $typetitle)
            <tr>
                <td>{{ $typetitle }}</td>
                <td class="p0"><input type="number" class="form-control" name="diesel[{{$typeid}}]" value="{{ $diesel[$typeid] ?? '' }}"></td>
            </tr>
            @empty
            @endforelse
        </table>
    </div>
</div>
<style>
    td.p0 {
        padding: 0 !important;
    }
</style>
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

<style>
    .w100p {
        width: 60px;
    }
</style>
@push('after-js')
<script>
    $(document).ready(function(){
        $(document).on('click', '.re_row', function(){
            $(this).parents(':eq(1)').remove();
        });
        $('#addstop').click(function(){
            //var rowid = Math.floor(Math.random() * (99999 - 1 + 1)) + 1;
                    <?php
                    $select_stops = Form::select('stops[]', $terminals, null, ['class'=>'form-control', 'placeholder'=>'- Select Stop -', 'required'])
                    ?>
                    var exp_row = '<tr><td></td><td>{{ $select_stops }}</td><td><span class="btn btn-primary re_row"><span class="fa fa-times"></span></span></td></tr>';
            $('#stopslist').append(exp_row);
        });

        $('#from_city_id').on('change', function(){
            var from_city = $(this, 'option:selected').val();
            $('#from_terminal_id option[data-city="'+from_city+'"]')[0].attr('selected', 'selected');
            //$('#from_terminal_id option').hide();
            //$('#from_terminal_id option[data-city="'+from_city+'"]').show();

        });

    })
</script>
@endpush












