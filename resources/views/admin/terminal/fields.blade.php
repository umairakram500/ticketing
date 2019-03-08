<div class="row gutter">
    <div class="col-md-8">
        <div class="form-group">
            {{ Form::label('title', 'Title *') }}
            {{ Form::text('title', null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-4">
        <div class="form-group">
            {{ Form::label('city_id', 'Termnal Type *') }}
            {{ Form::select('terminal_type', config('const.terminal_types'), null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>

    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('city_id', 'City *') }}
            {{ Form::select('city_id', $cities, null, ['class' => 'form-control', 'placeholder' => 'Select'])}}
        </div><!--form-group-->

        <div class="form-group">
            {{ Form::label('address', 'Address *') }}
            {{ Form::text('address', null, ['class' => 'form-control'])}}
        </div><!--form-group-->
        <div class="row gutter">
            <div class="col-xs-6">
                <div class="form-group">
                    {{ Form::label('lat', 'Lat *') }}
                    {{ Form::number('lat', null, ['class' => 'form-control', 'readonly'])}}
                </div><!--form-group-->
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    {{ Form::label('lng', 'Lang *') }}
                    {{ Form::number('lng', null, ['class' => 'form-control', 'readonly'])}}
                </div><!--form-group-->
            </div>
        </div>
    </div>

    <div class="col-md-6">
        {{ Form::label('lat', '&nbsp;') }}
        <div id="terminalMap" style="height: 205px" class="border"></div>
    </div>

</div>

<?php

$oldexps = old('expenses');
if($oldexps != null){
    $expenses = $oldexps;
}
?>

    <div class="row gutter">
        <div class="col-md-6">
            <label><strong>Terminal Expenses</strong></label>
            <?php $exps = \App\Models\ExpenseType::where('terminal_deduct', 1)->get() ?>
            <table class="table table-bordered">
                @forelse($exps as $exp)
                    <tr>
                        <td>{{ $exp->title }}</td>
                        <td><input type="number" name="expenses[{{ $exp->id }}]" class="form-control" value="{{ $expenses[$exp->id] ?? $exp->amount }}"></td>
                    </tr>
                @empty
                @endforelse
            </table>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('refcode', 'Reference Number') }}
                {{ Form::text('refcode', null, ['class' => 'form-control',])}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('', 'Status') }}
                <div class="clearfix"><p></p></div>
                <input name="status" value="1" type="checkbox"
                       {{ (isset($terminal) && $terminal->status) || !isset($terminal) ? 'checked' : '' }} id="status">
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
                <a href="{{ route('admin.terminal.index') }}" class="btn btn-default btn-block">Cancel</a>
            </div><!--form-group-->
        </div>
    </div>

@push('after-js')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAE_9bGUXkGmhljqamF3oyIHJpSUN7FE7U&libraries=places&callback=initMap
"></script>
<script type="text/javascript">

    var map;
    function initMap() {
        // The location of Pakistan
        @if((isset($terminal) && $terminal->lat != '' && $terminal->lng != ''))
        var pakistan =  {lat: parseFloat('{{$terminal->lat}}'), lng: parseFloat('{{ $terminal->lng }}')};
        var zoom = 16;
        @else
        var pakistan =  {lat: 30.375321, lng: 69.34511599999996};
        var zoom = 8;
        @endif


        // The map, centered at Uluru
        map = new google.maps.Map(
                document.getElementById('terminalMap'), {zoom: 16, center: pakistan});
        // The marker, positioned at Uluru
        @if((isset($terminal) && $terminal->lat && $terminal->lng))
         new google.maps.Marker({position: pakistan, map: map});
        @endif

        initializeAutocomplete();
    }

    function initializeAutocomplete(){
        var input = document.getElementById('address');
        var options = {}
        var autocomplete = new google.maps.places.Autocomplete(input, options);

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            var placeId = place.place_id;
            // to set city name, using the locality param
            /*var componentForm = {
                locality: 'short_name',
            };
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById("city").value = val;
                }
            }*/
            var marker = new google.maps.Marker({position: {lat: lat, lng: lng}, map: map});
            map.setCenter({lat: lat, lng: lng});
            document.getElementById("lat").value = lat;
            document.getElementById("lng").value = lng;
            //document.getElementById("location_id").value = placeId;
        });
    }

    jQuery(document).ready(function($) {

        var preventSubmit = function(event) {
            if(event.keyCode == 13) {
                console.log("caught ya!");
                event.preventDefault();
                //event.stopPropagation();
                return false;
            }
        }
        $("#address").keypress(preventSubmit);
        $("#address").keydown(preventSubmit);
        $("#address").keyup(preventSubmit);
    });
</script>
@endpush















