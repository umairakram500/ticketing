@extends('admin.layouts.app')

@section('title', 'Schedules')
@section('sub-title', 'List of Schedule Buses')

@section('content')

    <div class="row gutter">
        @forelse($buses as $bus)
            <?php $schedule = $bus->schedule[0]; ?>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="users-wrapper red">
                    <div class="users-info clearfix">
                        <div class="users-avatar text-center">
                            <span class="fa fa-bus fa-4x"></span>
                        </div>
                        <div class="users-detail">
                            <h5 class="m-0">{{ $bus->title }} ({{ $bus->number }})</h5>

                            @if($bus->schedules_count)
                                <p>{{ $schedule->route->title }}</p>
                                <p class="float-left">Available Seats: <strong class="text-success">{{ $schedule['avail_seats'] }}</strong>
                                </p>
                                <p class="float-right">Total Seats: <strong
                                            class="text-success">{{ $bus->seats }}</strong></p>
                                <div class="cleatfix"></div>
                            @else
                                <p>{{ $bus->route->title }}</p>
                            @endif

                        </div>
                    </div>
                    <ul class="users-footer clearfix">
                        <li>
                            <p class="light">Departure Date</p>
                            @if($bus->schedules_count)
                                <p>{{ date('m d, Y', strtotime($schedule['depart_time'])) }}</p>
                            @endif
                        </li>
                        <li>
                            <p class="light">Departure Time</p>
                            @if($bus->schedules_count)
                                <p>{{ date('h:i a', strtotime($schedule['depart_time'])) }}</p>
                            @endif
                        </li>
                        <li>
                            <?php $sid = $schedule['id']; ?>
                            <div class="dropdown">
                                <button class="add-btn btn btn-default dropdown-toggle pt-2" type="button" data-toggle="dropdown"><span class="fa fa-ellipsis-v"></span></button>
                                <ul class="dropdown-menu">
                                    @if($schedule->departured==0)
                                    <li><a href="{{ route('admin.schedule.bookTicket', $sid) }}">Book Ticket</a></li>
                                    <li><a href="javascript:;" title="Cancel" data-status="{{ route('admin.schedule.status', $sid) }}">Cancel</a></li>
                                    <li><a href="javascript:;" title="departure" data-status="{{ route('admin.schedule.departure', $sid) }}">Departured</a></li>
                                    <li><a href="{{ route('admin.schedule.edit', $sid) }}" title="arrive">Edit</a></li>
                                    @else
                                    <li><a href="javascript:;" title="arrive" data-status="{{ route('admin.schedule.arrive', $sid) }}">Arrived</a></li>
                                    @endif
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        @empty
            <div class="col-md-4 col-sm-6 col-xs-12">
                <a href="{{ route('admin.schedule.buses') }}" class="btn btn-primary btn-block py-5">Add Schedule</a>
            </div>
        @endforelse
    </div>

@endsection


