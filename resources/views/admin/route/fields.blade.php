
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
            <?php $terminals = \App\Models\Terminal::Selection() ?>
            {{ Form::label('from_terminal_id', 'Inital Terminal *') }}
            {{ Form::select('from_terminal_id', $terminals, null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            {{ Form::label('to_terminal_id', 'Last Terminal *') }}
            {{ Form::select('to_terminal_id', $terminals, null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>
</div>

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
            {{--{{ Form::select('stops[]', $terminals, $stops, ['class' => 'form-control', 'id' => 'stops', 'multiple' => true])}}--}}
                <select name="stops[]" id="stops" multiple class="form-control">
                    @forelse($terminals as $tk => $terminal)
                        <option value="{{ $tk }}" {{ in_array($tk, $stops) ? 'selected' : '' }}>{{ $terminal }}</option>
                    @empty
                    @endforelse
                </select>
        </div><!--form-group-->
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            {{ Form::label('status', 'Status *') }}
            {{ Form::select('status', array(1=>'Active', 0=>'Inactive'), null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    {{ Form::label('kms', 'KM\'s *') }}
                    {{ Form::number('kms', null, ['class' => 'form-control'])}}
                </div><!--form-group-->
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    {{ Form::label('diesel', 'Diesel *') }}
                    {{ Form::number('diesel', null, ['class' => 'form-control'])}}
                </div><!--form-group-->
            </div>
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

<style>
    .w100p {
        width: 60px;
    }
</style>
@push('after-js')
<script>
    $(document).ready(function(){
        $('#stops').multiSelect({
            keepOrder: true,
            selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search...'>",
            selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search...'>",
            afterInit: function(ms){
                var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                        .on('keydown', function(e){
                            if (e.which === 40){
                                that.$selectableUl.focus();
                                return false;
                            }
                        });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                        .on('keydown', function(e){
                            if (e.which == 40){
                                that.$selectionUl.focus();
                                return false;
                            }
                        });
            },
            afterSelect: function(){
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function(){
                this.qs1.cache();
                this.qs2.cache();
            }
        });
    })
</script>
@endpush












