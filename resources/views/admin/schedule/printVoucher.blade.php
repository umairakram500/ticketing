@extends('admin.layouts.app')

@section('title', 'Departure Voucher')

@section('content')

<button class="btn btn-success mb-4 printb px-5" onclick="window.print();">Print</button>
    <div class="row gutter">
        <div class="col-xs-12">
            <table class="table table-bordered bg-white" border="1">
                <tr>
                    <th width="120">Schedule ID</th>
                    <td>{{ $schedule->voucher_no }}</td>
                    <th width="120">Bus Number</th>
                    <td>{{ $schedule->bus->number }}</td>

                </tr>
                <tr>
                    <th width="120">From</th>
                    <td>{{ $schedule->route->from_city->name }}</td>
                    <th width="120">To</th>
                    <td>{{ $schedule->route->to_city->name }}</td>
                </tr>
                <tr>
                    <th width="120">From Terminal</th>
                    <td>{{ $schedule->route->from_terminal->title }}</td>
                    <th width="120">To Terminal</th>
                    <td>{{ $schedule->route->to_terminal->title }}</td>
                </tr>
                <tr>
                    <th width="120">Driver:</th>
                    <td>{{ $schedule->driver->name }}</td>
                    <th width="120">Conductor:</th>
                    <td>{{ $schedule->conductor->name }}</td>
                </tr>
                <tr>
                    <th>Date:</th>
                    <td>{{ date('M, d, Y') }}</td>
                    <th >Time:</th>
                    <td>{{ date('h:m A') }}</td>
                </tr>
            </table>
        </div>

    </div>


    <div class="row guttor">

        <div class="col-xs-6  print-6">
            <div class="">
                <div class="bg-white">
                    <table border="1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="150">Stations</th>
                            <th>PSG</th>
                            <th >Amount</th>
                            <th >Dis.</th>
                        </tr>
                        </thead>

                        <tbody id="">
                        @forelse($schedule->ticketStops  as $i => $ticket)
                            {{--@if($i==0)<table class="table table-bordered"> @endif--}}

                            <tr>
                                <td>{{ $ticket->toStop['title'] }}</td>
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
            <div class="">
                <div class="bg-white">

                    <table border="1" class="table table-bordered mb-3">
                        <thead>
                        <tr>
                            <th>Deduction</th>
                            <td width="100">Amount</td>
                        </tr>
                        </thead>
                        @foreach($schedule->expenses as $expense)
                            <tr>
                                <td>{{ $expense->expense_type->title }}</td>
                                <td class="p-0">
                                    {{ $expense->amount }}
                                </td>
                            </tr>
                        @endforeach
                        <tfoot>
                        <tr>
                            <th>Total Deduction</th>
                            <td width="100">{{ $schedule->expenses->sum('amount') }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row guttor">
        <div class="col-sm-12">
            <table border="1" class="table bg-white">
                <tr>
                    <th>Total Cash</th>
                    <td>{{ $schedule->tickets->sum('total_fare') }}</td>
                </tr>
                <tr>
                    <th>Deduction</th>
                    <td>{{ $schedule->expenses->sum('amount') }}</td>
                </tr>
                <tr>
                    <th>Net Cash</th>
                    <td>{{ $schedule->tickets->sum('total_fare') - $schedule->expenses->sum('amount') }}</td>
                </tr>
            </table>
        </div>

    </div>



    <style>
        .vertical-nav, header, footer {
            display: none;
        }
        @media print {
            .vertical-nav, header, footer, .printb {
                display: none;
            }
            .print-6 {
                float: left;
                width: 50%;
                padding: 10px;
                box-sizing: border-box;
            }
            table {
                border-collapse: collapse;
                border-spacing: 0;
                width: 100%;
                border: 1px solid #ddd;
            }

            th, td {
                text-align: left;
                padding: 10px;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2
            }
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
    $(document).ready(function(){
        window.print();
        document.location.href = "{{ route('admin.schedules') }}";
    })

</script>

@endpush