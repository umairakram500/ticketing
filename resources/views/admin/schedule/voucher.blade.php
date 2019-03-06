@extends('admin.layouts.app')

@section('title', 'Schedule Voucher')
@section('sub-title', $schedule->route->title." (closed)")

@section('content')

    <div class="panel">
        <div class="panel-body pb-0">

            <div class="row gutter">
                <div class="col-6 col-md-4">
                    <div class="form-group">
                        <label>Voucher#</label>
                        {{ $schedule->voucher_no==NULL? Form::number('voucher_no', null, ['onBlur' => 'saveVoucherNo()']): $schedule->voucher_no }}
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="form-group">
                        <label>Bus Number: </label>
                        {{ $schedule->bus->number }}
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="form-group">
                        <label>Route: </label>
                        {{ $schedule->route->title }}
                    </div>
                </div>
            </div>
            <div class="row gutter">
                <div class="col-6 col-md-4">
                    <div class="form-group">
                        <label>Driver: </label>
                        {{ $schedule->driver->name }}
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="form-group">
                        <label>Conductor: </label>
                        {{ $schedule->conductor->name }}
                    </div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="form-group">
                        <label>Date: </label>
                        {{ $schedule->created_at }}
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row guttor">
        <div class="col-xs-12">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" data-depart="1" href="#depart">Departure Voucher</a></li>
                <li><a data-toggle="tab" data-depart="0" href="#return">Return Voucher</a></li>
            </ul>

            <div class="tab-content p-0 bg-transparent pt-4 border-0">

                {{-- Depart --}}
                <div id="depart" class="tab-pane fade in active">
                    <div class="row">
                        <div  class="col-md-6">
                            <div class="panel">
                                <div class="panel-body p-0">
                                    <table class="">
                                        <thead>
                                        <tr>
                                            <th width="80">Ticket*</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th width="50">Qty*</th>
                                            <th width="70">Fare*</th>
                                            <th class="p-4"></th>
                                        </tr>
                                        </thead>

                                        <tbody id="voucher_depart-1">
                                        @forelse($schedule->ticketsDepart  as $i => $ticket)
                                            {{--@if($i==0)<table class="table table-bordered"> @endif--}}

                                            <tr>
                                                <td><input value="{{ $ticket->ticket_no }}" readonly class="form-control"></td>
                                                <td>{{ Form::select('from_city_id', $from_cities, null, ['class' => 'form-control'])}}</td>
                                                <td>{{ Form::select('to_city_id', $to_cities, null, ['class' => 'form-control'])}}</td>
                                                <td><input value="{{ $ticket->total_seats }}" readonly class="form-control"></td>
                                                <td><input value="{{ $ticket->total_fare }}" readonly class="form-control last"></td>
                                                <td class="text-center"></td>
                                            </tr>
                                        @empty
                                            @for($i=1; $i<=10; $i++)
                                                <tr>
                                                    <td>
                                                        <input name="ticket_no" placeholder="Ticket#" class="form-control">
                                                    </td>
                                                    <td>{{ Form::select('from_city_id', $from_cities, null, ['class' => 'form-control'])}}</td>
                                                    <td>{{ Form::select('to_city_id', $to_cities, null, ['class' => 'form-control'])}}</td>
                                                    <td><input name="qty" placeholder="Qty" class="form-control"></td>
                                                    <td><input name="fare" placeholder="Fare" class="form-control last"></td>
                                                    <td class="text-center">
                                                        <button class="btn btn-small btn-primary" onclick="saveRow(this)">
                                                            <span class="fa fa-cloud-upload"></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endfor
                                        @endforelse
                                        @if(!$schedule->closed)
                                            <tr>
                                                <td>
                                                    <input name="ticket_no" placeholder="Ticket#" class="form-control">
                                                </td>
                                                <td>{{ Form::select('from_city_id', $from_cities, null, ['class' => 'form-control'])}}</td>
                                                <td>{{ Form::select('to_city_id', $to_cities, null, ['class' => 'form-control'])}}</td>
                                                <td><input name="qty" placeholder="Qty" class="form-control"></td>
                                                <td><input name="fare" placeholder="Fare" class="form-control last"></td>
                                                <td class="text-center">
                                                    <button class="btn btn-small btn-primary" onclick="saveRow(this)">
                                                        <span class="fa fa-cloud-upload"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endif
                                        </tbody>
                                        @if(!$schedule->closed)
                                            <tfoot>
                                            <tr>
                                                <th colspan="5" class="p-2 text-center">
                                                    <span onclick="addRow()" class="fa fa-plus-circle fa-2x"></span>
                                                </th>
                                            </tr>
                                            </tfoot>
                                        @endif

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel">
                                <div class="panel-body p-0">
                                    {!! Form::open(['route' => ['admin.expense.store', $schedule->id], 'id'=>'expense_form-1' ]) !!}
                                    <table class="table table-bordered mb-3">
                                        @foreach($expense_types as $id => $expense)
                                            @php
                                            $exp = isset($expenseDepart) && isset($expenseDepart[$id]) ? $expenseDepart[$id] : null;
                                            $exp_id = isset($expenseDepart) && isset($expenseDepart_ids[$id]) ? $expenseDepart_ids[$id] : null;
                                            @endphp
                                            <tr>
                                                <th>{{ Form::label('expense['.$id.'][amt]', $expense) }}</th>
                                                <td class="p-0">
                                                    {{ Form::number('expense['.$id.'][amt]', $exp, ['class' => 'form-control border-0'])}}
                                                    {{ Form::hidden('expense['.$id.'][id]', $exp_id) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    @if(!$schedule->closed)
                                        <div class="row guttor">
                                            <div class="col-xs-6">
                                                <button type="reset" class="btn btn-primary btn-block">Resset</button>
                                            </div>
                                            <div class="col-xs-6">
                                                <button type="button" onclick="saveExpense()" class="btn btn-success btn-block">Save Expense</button>
                                            </div>
                                        </div>
                                    @endif
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End:Depart --}}

                {{-- Depart --}}
                <div id="return" class="tab-pane fade">
                    <div class="row">
                        <div  class="col-md-6">
                            <div class="panel">
                                <div class="panel-body p-0">
                                    <table class="">
                                        <thead>
                                        <tr>
                                            <th width="80">Ticket*</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th width="50">Qty*</th>
                                            <th width="70">Fare*</th>
                                            <th class="p-4"></th>
                                        </tr>
                                        </thead>

                                        <tbody id="voucher_depart-0">
                                        @forelse($schedule->ticketsRetrun as $i => $ticket)
                                            {{--@if($i==0)<table class="table table-bordered"> @endif--}}

                                            <tr>
                                                <td><input value="{{ $ticket->ticket_no }}" readonly class="form-control"></td>
                                                <td>{{ Form::select('from_city_id', $from_cities, null, ['class' => 'form-control'])}}</td>
                                                <td>{{ Form::select('to_city_id', $to_cities, null, ['class' => 'form-control'])}}</td>
                                                <td><input value="{{ $ticket->total_seats }}" readonly class="form-control"></td>
                                                <td><input value="{{ $ticket->total_fare }}" readonly class="form-control last"></td>
                                                <td class="text-center"></td>
                                            </tr>
                                        @empty
                                            @for($i=1; $i<10; $i++)
                                                <tr>
                                                    <td>
                                                        <input name="ticket_no" placeholder="Ticket#" class="form-control">
                                                    </td>
                                                    <td>{{ Form::select('from_city_id', $from_cities, null, ['class' => 'form-control'])}}</td>
                                                    <td>{{ Form::select('to_city_id', $to_cities, null, ['class' => 'form-control'])}}</td>
                                                    <td><input name="qty" placeholder="Qty" class="form-control"></td>
                                                    <td><input name="fare" placeholder="Fare" class="form-control last"></td>
                                                    <td class="text-center">
                                                        <button class="btn btn-small btn-primary" onclick="saveRow(this)">
                                                            <span class="fa fa-cloud-upload"></span>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endfor
                                        @endforelse
                                        @if(!$schedule->closed)
                                            <tr>
                                                <td>
                                                    <input name="ticket_no" placeholder="Ticket#" class="form-control">
                                                </td>
                                                <td>{{ Form::select('from_city_id', $from_cities, null, ['class' => 'form-control'])}}</td>
                                                <td>{{ Form::select('to_city_id', $to_cities, null, ['class' => 'form-control'])}}</td>
                                                <td><input name="qty" placeholder="Qty" class="form-control"></td>
                                                <td><input name="fare" placeholder="Fare" class="form-control last"></td>
                                                <td class="text-center">
                                                    <button class="btn btn-small btn-primary" onclick="saveRow(this)">
                                                        <span class="fa fa-cloud-upload"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                        @if(!$schedule->closed)
                                            <tfoot>
                                            <tr>
                                                <th colspan="5" class="p-2 text-center">
                                                    <span onclick="addRow()" class="fa fa-plus-circle fa-2x"></span>
                                                </th>
                                            </tr>
                                            </tfoot>
                                        @endif

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel">
                                <div class="panel-body p-0">
                                    {!! Form::open(['route' => ['admin.expense.store', $schedule->id], 'id'=>'expense_form-0' ]) !!}
                                    <table class="table table-bordered mb-3">
                                        @foreach($expense_types as $id => $expense)
                                            @php
                                            $exp = isset($expenseReturn) && isset($expenseReturn[$id]) ? $expenseReturn[$id] : null;
                                            $exp_id = isset($expenseReturn) && isset($expenseReturn_ids[$id]) ? $expenseReturn_ids[$id] : null;
                                            @endphp
                                            <tr>
                                                <th>{{ Form::label('expense['.$id.'][amt]', $expense) }}</th>
                                                <td class="p-0">
                                                    {{ Form::number('expense['.$id.'][amt]', $exp, ['class' => 'form-control border-0'])}}
                                                    {{ Form::hidden('expense['.$id.'][id]', $exp_id) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    @if(!$schedule->closed)
                                        <div class="row guttor">
                                            <div class="col-xs-6">
                                                <button type="reset" class="btn btn-primary btn-block">Resset</button>
                                            </div>
                                            <div class="col-xs-6">
                                                <button type="button" onclick="saveExpense()" class="btn btn-success btn-block">Save Expense</button>
                                            </div>
                                        </div>
                                    @endif
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Edn:Depart --}}
            </div>
        </div>

        </div>
    </div>





@endsection

@if(!$schedule->closed)
@push('buttons')
<li>
    <a href="javascript:void(0)" data-status="{{ route('admin.schedule.close', $schedule->id) }}" data-goto="{{ route('admin.schedule.vouchers') }}" class="btn btn-success" title="All Done" data-toggle="tooltip"><span class="fa fa-check"></span>Close it</a>
</li>
@endpush

@push('after-js')
<script>

    var depart = 1;
    $(document).ready(function(){
        $('#voucher_depart input').keydown(function(e){
            var keycode = (e.keyCode ? e.keyCode : e.which);
            if (keycode == '13') {
                if($(this).hasClass( "last" )){
                    addRow();
                    $('#voucher_depart tr:last-child td:first-child input').focus();
                } else
                    $(this ).closest('td').nextAll().eq(0).find('input').focus();
            }
        });

        $(".nav-tabs a").click(function(){
            $(this).tab('show');
            depart = $(this).data('depart');
            console.log(depart);
        });

    });

    function addRow(){
        '';
        var html = '<tr> <td><input type="text" name="ticket_no" placeholder="Ticket#" class="form-control"></td><td>{{ Form::select("from_city_id", $from_cities, null, ["class" => "form-control"])}}</td><td>{{ Form::select("to_city_id", $to_cities, null, ["class" => "form-control"])}}</td><td><input type="text" name="qty" placeholder="Qty" class="form-control"></td><td><input type="text" name="fare" placeholder="Fare" class="form-control last"></td><td class="text-center"><button class="btn btn-small btn-primary" onclick="saveRow(this)"><span class="fa fa-cloud-upload"></span></button></td></tr>';

        $('#voucher_depart-'+depart).append(html);

    }

    function saveRow(ele)
    {
        var rowData = {departure: depart};
        var data = $(ele).parents(':eq(1)').find('input, select').serializeArray().map(function(item){
            rowData[item.name] = item.value;
        });
        var url = "{{ route('admin.schedule.saveVoucherRow',$schedule->id) }}";

        //console.log(url, rowData);
        $.post(url, rowData, function(result){
            //result = JSON.parse(result);
            //console.log(result);
            if(result.errors != undefined){
                alertify.error( result.message );
            } else {
                if(result.error){
                    alertify.error( result.message );
                } else{
                    $(ele).parents(':eq(1)').find('input').attr('readonly', 'readonly');
                    $(ele).remove();
                    alertify.success( result.message );
                    addRow();
                }

            }
        });
    }

    function saveVoucherNo()
    {
        var url = "{{ route('admin.schedule.saveVoucherNo', $schedule->id) }}"
        var data = {voucher_no: $('input[name="voucher_no"]').val()};
        ajaxSave(url, data);
    }

    function saveExpense()
    {
        //event.preventDefault();
        var rowData = {departure: depart};
        var data = $('#expense_form-'+depart).serializeArray().map(function(item){
            rowData[item.name] = item.value;
        });
        var url = "{{ route('admin.expense.store', $schedule->id) }}";

        //console.log(rowData);
        //return false;
        //console.log(url, rowData);
        $.post(url, rowData, function(result){
            //result = JSON.parse(result);
            console.log(result);
            //return false;
            if(result.errors != undefined){
                alertify.error( result.message );
            } else {
                if(result.error){
                    alertify.error( result.message );
                } else{
                    //$(ele).parents(':eq(1)').find('input').attr('readonly', 'readonly');
                    //$(ele).remove();
                    alertify.success( result.message );
                    //addRow();
                }

            }
        });
    }

</script>
@endpush



@endif
