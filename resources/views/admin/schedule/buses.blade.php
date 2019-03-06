@extends('admin.layouts.app')

@section('title', 'Schedule')

@section('content')

    <hr/>

    <h4>Buses not yet Scheduled</h4>
    <div class="row gutter">
        @foreach($buses as $bus)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="users-wrapper red">
                    <div class="users-info clearfix">
                        <div class="users-avatar text-center">
                            <span class="fa fa-bus fa-4x"></span>
                        </div>
                        <div class="users-detail">
                            <h5 class="m-0">{{ $bus->title }} ({{ $bus->number }})</h5>
                            <p>{{ $bus->route->title }}</p>
                            <p>Total Seats: <strong class="text-success">{{ $bus->seats }}</strong></p>
                            <div class="cleatfix"></div>

                        </div>
                    </div>
                    <ul class="users-footer clearfix">
                        <li>
                            <p class="light">Departure Time</p>
                        </li>
                        <li>
                            <p class="light">Reach Time</p>
                        </li>
                        <li>
                            <a href="{{ route('admin.schedule.create', $bus->id) }}" class="add-btn">
                                <i class="icon-plus3"></i>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        @endforeach
    </div>

@endsection


