@extends('front.layout.master')

@push('css')

@endpush
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-9">

                <div class="our-services service-icon-list">
                    @if(count($schedules))
                        @foreach($schedules as $schedule)
                        <div class="content">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="type">
                                        <i class="fa fa-bus"></i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3>{{ $schedule->bus->title }}</h3>
                                    <p>Departure at <strong>{{ date('h:m', strtotime($schedule->depart_time)) }}</strong> | Arrival {{ date('h:m', strtotime($schedule->reach_time)) }}</p>
                                    <p>Seats left: <span class="label label-primary rounded">{{ $schedule->avail_seats }}</span> Total Seats: <span class="label label-primary rounded">{{ $schedule->bus->seats }}</span></p>
                                </div>
                                <div class="col-md-3">
                                    <div class="px-4 pt-3">
                                        <a href="{{ route('front.bookticket', $schedule->id) }}" class="btn btn-primary btn-block">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="content">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="type">
                                        <i class="fa fa-bus"></i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h3>Schedule not found.</h3>
                                    <p>No any bus schedule yet accroding to your selection.</p>
                                    <p>&nbsp;</p>
                                </div>
                                <div class="col-md-3">

                                </div>
                            </div>
                        </div>
                    @endif


                </div>

            </div>
            <div class="col-md-3">
                <div class="leftsearch">

                    @include('front.includes.searchbox')

                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

@endpush
