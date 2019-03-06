@extends('admin.layouts.app')

@section('title', 'Schedule Departure Voucher')

@section('content')

    <div class="row gutter">
        <div class="col-xs-12">
            <table class="table table-bordered bg-white">
                <tr>
                    <th width="120">Schedule ID:</th>
                    <td>{{ $schedule->id }}</td>
                    <th width="120">Bus Number:</th>
                    <td>{{ $schedule->bus->number }}</td>
                    <th width="120">Route:</th>
                    <td>{{ $schedule->route->title }}</td>
                </tr>
                <tr>
                    <th width="120">Driver:</th>
                    <td>{{ $schedule->driver->name }}</td>
                    <th width="120">Conductor:</th>
                    <td>{{ $schedule->conductor->name }}</td>
                    <th width="120">Depart Time:</th>
                    <td>{{ date('h:m A', strtotime($schedule->created_at)) }}</td>
                </tr>
            </table>
        </div>

    </div>


    <div class="row guttor">
        {{--<div class="col-xs-6">
            <div class="panel">
                <div class="panel-body p-0">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Booking Type</th>
                            <th>Qty</th>
                        </tr>
                        </thead>

                        <tbody id="voucher_depart-1">
                        @forelse($schedule->ticketSum  as $i => $ticket)
                            --}}{{--@if($i==0)<table class="table table-bordered"> @endif--}}{{--

                            <tr>
                                <td>{!! $ticket->icon !!}</td>
                                <td>{{ $ticket->total }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Not yet Ticket booked</td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfooter>
                            <tr>
                                <th>Total</th>
                                <td>{{ $schedule->tickets->sum('total_seats') }}</td>
                            </tr>
                        </tfooter>

                    </table>
                </div>
            </div>
        </div>--}}

        <div class="col-xs-6  print-6">


            <div class="panel">
                <div class="panel-body p-0">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Stations</th>
                            <th width="50">PSG</th>
                            <th width="80">Amount</th>
                            <th width="80">Discount</th>
                        </tr>
                        </thead>

                        <tbody id="voucher_depart-1">
                        @forelse($schedule->ticketStops  as $i => $ticket)
                            {{--@if($i==0)<table class="table table-bordered"> @endif--}}

                            <tr>
                                <td>{!! $ticket->toStop['title'] !!}</td>
                                <td>{{ $ticket->total_seats }}</td>
                                <td>{{ $ticket->total_fare}}</td>
                                <td>{{ $ticket->total_discount}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Not yet Ticket booked</td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfooter>
                            <tr>
                                <th>Sub-Total</th>
                                <td>{{ $schedule->tickets->sum('total_seats') }}</td>
                                <td>{{ $schedule->tickets->sum('total_fare') }}</td>
                                <td>{{ $schedule->tickets->sum('discount') }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Total</strong> <small>(Amount - Discount)</small></td>
                                <td colspan="2">{{ $schedule->tickets->sum('total_fare')  - $schedule->tickets->sum('discount') }}</td>
                            </tr>
                        </tfooter>

                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6  print-6">
            <div class="panel">
                <div class="panel-body p-0">
                    {!! Form::open(['route' => ['admin.expense.store', $schedule->id], 'id'=>'expense_form' ]) !!}
                    {{ Form::hidden('dv', 1) }}
                    <table class="table table-bordered mb-3">
                        <thead>
                        <tr>
                            <th>Deduction</th>
                            <td width="100">Amount</td>
                        </tr>
                        </thead>
                        @foreach($expenses as $expense)
                            @php
                            $id = $expense->id;
                            $readonly = $expense->changeable ? '' : 'readonly';
                            @endphp
                            <tr>
                                <td>{{ $expense->title }}</td>
                                <td class="p-0">
                                    {{ Form::number('expense['.$id.'][amt]', $expense->amount, ['class' => 'form-control border-0', $readonly])}}
                                </td>
                            </tr>
                        @endforeach
                        <tfoot>
                        <tr>
                            <th>Total Deduction</th>
                            <td width="100">{{ $expenses->sum('amount') }}</td>
                        </tr>
                        </tfoot>
                    </table>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row guttor">
        <div class="col-sm-6">
            <a href="{{ route('admin.schedule.bookTicket', $schedule->id) }}" class="btn btn-primary btn-block py-4">Cancel - Got to Ticket Booking</a>
        </div>
        <div class="col-sm-6">
            <button type="button" onclick="saveExpense()" class="btn btn-success btn-block py-4">Add Voucher</button>
        </div>

    </div>



    <style>
        @media print {
            .vertical-nav, header {
                display: none;
            }
            .print-6 {
                float: left;
                width: 50%;
            }
            table { border: 1px solid}
        }
    </style>

@endsection

@if(!$schedule->departured)
@push('buttons')
<li>
    <a href="{{ route('admin.schedule.bookTicket', $schedule->id) }}" class="btn btn-success">
        <span class="fa fa-arrow-right"></span>
        Book Tickets
    </a>
</li>
@endpush
@endif



@push('after-js')

<script>
    function cancelTicket(url){
        $.post(url, function(res){
            console.log(res);
        })
    }
    function paidTicket(url, ele){
        $.post(url, function(res){
            alertify.success('Ticket mark as Paid successfully');
            $(ele).parents(':eq(0)').prev().text('Paid');
            $(ele).remove();
        })
    }

    function saveExpense()
    {
        //event.preventDefault();
        var rowData = {departure: 1};
        var data = $('#expense_form').serializeArray().map(function(item){
            rowData[item.name] = item.value;
        });
        var url = "{{ route('admin.expense.store', $schedule->id) }}";

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
                    alertify.success( result.message );
                    window.location.href='{{ route('admin.print.voucher', $schedule->id) }}';
                }

            }
        });
    }

</script>

@endpush