
<div class="row gutter">
    <div class="col-md-8 col-sm-12">
        <?php $routes = \App\Models\Route\Route::Selection(); ?>
        <div class="form-group">
            {{ Form::label('route_id', 'Route *') }}
            {{ Form::select('route_id', $routes, null, ['class' => 'form-control', 'placeholder' => '', 'required'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-4 col-sm-12">
        <?php $types = \App\Models\Bus\LuxuryType::Selection(); ?>
        <div class="form-group">
            {{ Form::label('luxury_type', 'Luxury Type *') }}
            {{ Form::select('luxury_type', $types, null, ['class' => 'form-control', 'placeholder' => '', 'required'])}}
        </div><!--form-group-->
    </div>
</div>

<div class="row gutter">
    <div class="col-md-4 col-sm-12">
        <?php $types = \App\Models\Bus\LuxuryType::Selection(); ?>
        <div class="form-group">
            <?php $scheduleTypes = array(1=>'Permanent', 2=>'Range', 3=>'Specific Date', 4=>'Drop' ); ?>
            {{ Form::label('type', 'Type *') }}
            {{ Form::select('type', $scheduleTypes, null, ['class' => 'form-control', 'id'=>'schtype', 'required'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-4 col-sm-12">
        <?php $routes = \App\Models\Route\Route::Selection(); ?>
        <div class="form-group">
            {{ Form::label('from_date', 'From Date *') }}
            {{ Form::text('from_date', null, ['class' => 'form-control', 'autocomplete'=>'off', 'required'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-4 col-sm-12">
        <?php $routes = \App\Models\Route\Route::Selection(); ?>
        <div class="form-group">
            {{ Form::label('to_date', 'To Date *') }}
            {{ Form::text('to_date', null, ['class' => 'form-control', 'autocomplete'=>'off', 'required'])}}
        </div><!--form-group-->
    </div>
</div>

<div class="row gutter">
    <div class="col-md-4 col-sm-12">
        <?php $cities = \App\Models\City::Selection('name'); ?>
        <div class="form-group">
            {{ Form::label('city_id', 'Base Station *') }}
            {{ Form::select('city_id', $cities, null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-8 col-sm-12">
        <div class="form-group">
            {{ Form::label('note', 'Note') }}
            {{ Form::text('note', null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>

    {{--<div class="col-md-4 col-sm-12 pt-2">
        <div class="form-group mt-5">
            {{ Form::checkbox('reverse', 1, null, ['id' => 'reverse'])}}
            {{ Form::label('reverse', 'Reverse Order *') }}
        </div><!--form-group-->
    </div>--}}
</div>

<div id="stops" class="my-5">
    <?php
    $route_id = old('route_id', (isset($schedule) ? $schedule->route_id: null));
    $reverse = old('reverse', (isset($schedule) ? $schedule->reverse: null));

    $route_stops = \App\Models\Route\Stop::where('route_id', $route_id)->with('terminal')->get()->toArray();
    $stop_ids = array_column($route_stops, 'terminal_id');
    if($reverse){
        $stop_ids = array_reverse($stop_ids);
    }
    // $data['departs'] = $this->toSelect($schedule_stops, 'depart', 'terminal_id');
    // $data['arrives'] = $this->toSelect($schedule_stops, 'arrive', 'terminal_id');
    $stops = array();

    if(is_array($route_stops) && count($route_stops)){
        foreach($route_stops as $route_stop){
            $stops[$route_stop['terminal_id']] = $route_stop['terminal']['title'];
        }
    }
    if($route_id != null && $route_id > 0){
        $oldStop = old('stops', isset($schedule_stops)? $schedule_stops : null);

        //if($stops_json != null && count($oldStop)){
            foreach($stop_ids as $k => $sid){
                //$stop = array_search($sid, array_search('id',$stops))
    ?>
        <div class="row gutter">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <h4 class="mt-5 text-muted">{{ $stops[$sid] ?? '' }}</h4>
                    {{--<input type="hidden" name="stops[{{ $sid }}][name]" value="{{ $stopname }}">--}}
                </div><!--form-group-->
            </div>
            @if($k !=0)
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Arrival</label>
                    <input type="text" class="form-control arrive" name="stops[{{ $sid }}][arrive]" value="{{ $oldStop[$sid]['arrive']??'' }}">
                </div><!--form-group-->
            </div>
            @endif

            @if($k+1 != count($stops))
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Departure</label>
                    <input type="text" class="form-control depart"  name="stops[{{ $sid }}][depart]" value="{{ $oldStop[$sid]['depart']??'' }}">
                </div><!--form-group-->
            </div>
            @endif



        </div>
    <?php
            }
       // }
    }
    ?>

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
<input type="hidden" id="stops_json" name="stops_json" value="{{ old('stops_json', json_encode($stops)) }}">


@push('after-js')
<link rel="stylesheet" href="{{ asset('css/jquery.timepicker.min.css') }}">
<script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
<script>
    var stops = {};
    var reverse = 0;
    var stopids = [];
    $(document).ready(function () {

        $('.depart, .arrive').timepicker({ 'step': 15, 'timeFormat': 'g:i a' });

        /*-- set inial stops josn --*/
        var stops_json = $('#stops_json').val();
        stops = stops_json != '' ? JSON.parse(stops_json) : {};

        /*-- on click of reverse --*/
        $('#reverse').on('ifChanged', function(event){
            reverse = $(this).is(':checked') ? 1 : 0;
            $('#stops').html('');
            addStops();
        });

        /*-- Get stops on selection of route --*/
        $('#route_id').change(function(){
            var route_id = $(this, 'option:selected').val();
            $('#stops').html('');
            $.get('{{ route('admin.schedules.getStops') }}/'+route_id, function(res){
                if(typeof res === 'object' && Object.keys(res).length > 0){
                    console.log(res);
                    stops = res;
                    $('#stops_json').val(JSON.stringify(res));
                    addStops();
                } else {
                    stops = {};
                    alert('Route not have stop')
                }
            })
        });

        /*-- Datepicker --*/
        $( "#from_date" ).datepicker({
            minDate: 'today',
            onSelect: function(date){
                $("#to_date").datepicker("option",{ minDate: new Date(date)});
            }
        });
        $( "#to_date" ).datepicker({
            minDate: 'today'
        });

        /*-- On Change of Schedule Type --*/
        var schtype = $('#schtype option:selected').val();
        dateFromToSetting(schtype);
        $('#schtype').change(function(){
            schtype = $(this, 'option:selected').val();
            dateFromToSetting(schtype)
        });

        //$('#stops .row:last-child input').attr('disabled', true);
    });

    function dateFromToSetting(type)
    {
        $('#from_date, #to_date').removeAttr("disabled");
        if(type == 1){
            $('#from_date, #to_date').attr("disabled", "disabled");
        }
        else if(type == 3 || type == 4){
            $('#to_date').attr("disabled", "disabled");
        }
    }


    function addStops()
    {
        if(Object.keys(stops).length > 0){
            //var stopIds = reverse ? Object.keys(stops).reverse() : Object.keys(stops);
            //console.log(stops);
            for (var id in stops) {
                console.log((id+1) == stops.length, (id+1), stops.length);
                var row = (parseInt(id)+1) == stops.length ? 'last' : id;
                appendStop(stops[id].id, stops[id].title, row);
            }
            // $('#stops .row:last-child input').attr('readonly', true);
            $('.depart, .arrive').timepicker({ 'step': 15, 'timeFormat': 'g:i a' });
        }
    }
    function appendStop(id, title, row)
    {
        var stop = '<div class="row gutter"><div class="col-md-4 col-sm-12"><div class="form-group"><h4 class="mt-5 text-muted">'+title+'</h4> <input type="hidden" name="stops['+id+'][name]" value="'+title+'"></div></div>';

        if(row != 0)
        stop += '<div class="col-md-4 col-sm-12"><div class="form-group"> <label>Arrival</label> <input type="text" class="form-control arrive" name="stops['+id+'][arrive]" required></div></div>';

        if(row != 'last')
        stop += '<div class="col-md-4 col-sm-12"><div class="form-group"> <label>Departure</label> <input type="text" class="form-control depart" name="stops['+id+'][depart]" required></div></div>';


        stop +='</div>';

        $('#stops').append(stop);
    }
</script>
@endpush
