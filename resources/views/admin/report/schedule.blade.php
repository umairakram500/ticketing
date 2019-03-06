@extends('admin.layouts.app')

@section('title', 'Cities')

@section('content')

    <div class="row gutter">

        <div class="panel panel-green">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped no-margin">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Bus#</th>
                            <th>Voucher#</th>
                            <th>Fare</th>
                            <th>Expense</th>
                            <th>+/-</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($schedules as $key => $schedule)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $schedule->bus->number }}</td>
                                <td>{{ $schedule->voucher_no }}</td>
                                <td>{{ $schedule->tickets->sum('total_fare')." (".$schedule->tickets->sum('total_seats').")" }}</td>
                                <td>{{ $schedule->expenses->sum('amount') }}</td>
                                <td>{{ $schedule->tickets->sum('total_fare')-$schedule->expenses->sum('amount') }}</td>
                                <th>
                                    <a href="{{ route('admin.schedule.voucher', $schedule->id) }}" class="btn btn-small btn-primary">Details</a>
                                </th>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">1</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

@endsection

@push('buttons')
<li>
    <a href="{{ route('admin.city.create') }}" class="btn btn-success"><i class="icon-plus"></i>add City</a>
</li>
@endpush

