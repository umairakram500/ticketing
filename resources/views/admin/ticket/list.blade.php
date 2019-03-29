@extends('admin.layouts.app')

@section('title', $title)


@section('content')

    <div class="row guttor">
        <div class="col-xs-12">

            <div class="panel">
                <div class="panel-body p-0">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="50">ID</th>
                            {{--<th>Booking Type</th>--}}
                            <th>Name</th>
                            <th width="140">CNIC</th>
                            <th>Qty*</th>
                            <th>Seats</th>
                            <th>Fare</th>
                            <th>Depart</th>
                            <th>Destination</th>
                            <th>Booked at</th>
                            <th>Status</th>
                        </tr>
                        </thead>

                        <tbody id="voucher_depart-1">
                        @forelse($tickets  as $i => $ticket)
                            <tr>
                                <td>{{ $ticket->id }}</td>
                                {{--<td>{!! $ticket->icon !!}</td>--}}
                                <td>{{ $ticket->p_name }}</td>
                                <td>{{ $ticket->p_cnic }}</td>
                                <td>{{ $ticket->total_seats }}</td>
                                <td>{{ str_replace(',', ', ', $ticket->seat_numbers) }}</td>
                                <td>{{ $ticket->total_fare }}</td>
                                <td>{{ $ticket->fromStop->title ?? '' }}</td>
                                <td>{{ $ticket->toStop->title ?? '' }}</td>
                                <td>{{ date('M d, Y h:m A', strtotime($ticket->created_at)) }}</td>
                                <td>{{ $ticket->paid ? 'Paid' : 'Not Paid' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Not yet Ticket booked</td>
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