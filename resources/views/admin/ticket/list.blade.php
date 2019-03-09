@extends('admin.layouts.app')

@section('title', $title)


@section('content')



    {{--<div class="row gutter">
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

    </div>--}}


    <div class="row guttor">
        <div class="col-xs-12">


            <div class="panel">
                <div class="panel-body p-0">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="50">ID</th>
                            <th>Booking Type</th>
                            {{--<th>From</th>
                            <th>To</th>--}}
                            <th>Qty*</th>
                            <th>Seats</th>
                            <th>Booked at</th>
                            <th>Status</th>
                            {{--<th width="180">Action</th>--}}
                        </tr>
                        </thead>

                        <tbody id="voucher_depart-1">
                        @forelse($tickets  as $i => $ticket)
                            {{--@if($i==0)<table class="table table-bordered"> @endif--}}

                            <tr>
                                <td>{{ $ticket->id }}</td>
                                <td>{!! $ticket->icon !!}</td>
                                {{--<td>{{ $ticket->from }}</td>
                                <td>{{ $ticket->to }}</td>--}}
                                <td>{{ $ticket->total_seats }}</td>
                                <td>{{ $ticket->seat_numbers }}</td>
                                <td>{{ date('M d, Y h:m A', strtotime($ticket->created_at)) }}</td>
                                <td>{{ $ticket->paid ? 'Paid' : 'Not Paid' }}</td>
                                {{--<td>
                                    <button class="btn btn-danger" data-message="Are Soue you want to cancel this Ticket" data-delete="">Cancel</button>
                                    @if(!$ticket->paid)
                                    <button class="btn btn-success" onclick="paidTicket('{{ route('admin.ticket.paid', $ticket->id) }}', this)">Paid</button>
                                    @else
                                    <a href="{{ route('admin.ticket.show', [$ticket->schedule_id, $ticket->id]) }}" class="btn btn-success" onclick="paidTicket('', this)">Print</a>
                                    @endif
                                </td>--}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Not yet Ticket booked</td>
                            </tr>
                        @endforelse
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>


@endsection




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
</script>

@endpush