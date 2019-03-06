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
        <?php $cities = \App\Models\City::Select('name'); ?>
        <div class="form-group">
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
<?php $terminals = \App\Models\Terminal::Selection(); ?>


<div class="row gutter">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('terminals', 'Stops') }}
            {{ Form::select('terminals', $terminals, null, ['class' => 'form-control', 'id' => 'terminals'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            {{ Form::label('status', 'Status *') }}
            {{ Form::select('status', array('Active', 'Inactive'), null, ['class' => 'form-control', 'placeholder' => 'Select'])}}
        </div><!--form-group-->
    </div>
</div>

<style>
    .ms-container {
         width: auto !important;
        max-width: 100%;
    }
</style>




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

<style>
    .w100p {
        width: 60px;
    }
</style>
@push('after-js')
<script>
    $(document).ready(function(){
        $('#terminals').multiSelect({
            //keepOrder: true,
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












