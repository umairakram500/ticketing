@extends('admin.layouts.app')

@section('title', 'Ticket Booking')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(Session::has('seat_error'))
        <div class="alert alert-danger alert-dismissible">
            {{ Session::get( 'seat_error' ) }}
        </div>
    @endif
<?php
$schedule_id = old('schedule_id', isset($schedule_id) ? $schedule_id : null);
$bookingdate = old('booking_date', isset($bookingdate) ? $bookingdate : null);
$routeID = old('route', isset($route) ? $route : null);
$stopsList = array();
$from_stop = null;
$to_stop = null;
if($routeID > 0){
    $route = \App\Models\Route\Route::find($routeID);
    if($route !== null){
        $from_stop = $route->from_terminal_id;
        $to_stop = $route->to_terminal_id;

        $stops = \App\Models\Route\Stop::select('terminal_id')->with('terminal')->where('route_id', $route->id)->get()->toArray();
        if(count($stops)){
            foreach($stops as $stop){
                $stopsList[$stop['terminal_id']] = $stop['terminal']['title'];
            }
        }
    }
}
?>
    {!! Form::open(['route' => 'admin.ticket.store', 'id'=>'searchSchedule']) !!}

    {{-- Search Schedues --}}
    <div class="row gutter">

        <div class="row gutter">
            <div class="col-md-9">
                <div class="row gutter">
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('booking_date', 'Booking Date') }}
                            {{ Form::text('booking_date',  old('booking_date', date('Y-m-d')), ['class' => 'form-control', 'id'=>'bookingdate', 'readonly'])}}
                        </div><!--form-group-->
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php $routes = \App\Models\Route\Route::selection(); ?>
                            {{ Form::label('route', 'Route') }}
                            {{ Form::select('route', $routes, $routeID, ['class' => 'form-control', 'placeholder'=>'- Select Route -', 'required'])}}
                        </div><!--form-group-->
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('from_stop', 'Departure') }}
                            {{ Form::select('from_stop', $stopsList, $from_stop, ['class' => 'form-control', 'required'])}}
                        </div><!--form-group-->
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('to_stop', 'Arrival') }}
                            {{ Form::select('to_stop', $stopsList, $to_stop, ['class' => 'form-control', 'required'])}}
                        </div><!--form-group-->
                    </div>
                    <div class="hidden">
                        <div class="form-group mt-5">
                            {{ Form::button('Get Schedules', ['class' => 'btn btn-info', 'type'=>'button', 'id'=>'getSchedules'])}}
                        </div><!--form-group-->
                    </div>

                    <div class="col-sm-12 legneds pb-4">
                        <table class="legends">
                            <tr>
                                <td><span class="bk lb lbm"></span></td>
                                <td>Male Booked</td>
                                <td><span class="bk lb"></span></td>
                                <td>Female Booked</td>
                                <td><span class="bk gb gbl"></span></td>
                                <td>Male Ticket</td>
                                <td><span class="bk gb"></span></td>
                                <td>Female Ticket</td>
                                <td><span class="bk va"></span></td>
                                <td>Vaccant</td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
            <div class="col-md-3 text-center">
                    <h3 id="selected-route" class="mb-2 mt-3" >Route</h3>
                    <h3 id="selected-schedule">Schedule</h3>

            </div>
        </div>


    </div>

    {{-- Legents --}}

    {{-- Schedules & seats --}}
    <div class="row gutter">
        {{-- Schedules --}}
        <div class="col-md-9">
            <div class="table-responsive">
                <table class="table table-bordered table-hover bg-white">
                    <tead>
                        <tr class="info">
                            <th>Sr#</th>
                            <th>Time</th>
                            <th>Route</th>
                            <th>BusType</th>
                            <th>Seats</th>
                            {{--<th>Fare</th>--}}
                            {{--<th>Res</th>
                            <th>Deli</th>
                            <th>Avai</th>--}}
                            <th>Open</th>
                            <th>Status</th>
                        </tr>
                    </tead>
                    <tbody id="schedules">
                    <?php $schedules = old('schedules'); ?>
                    @if($routeID > 0)
                        <?php
                        if($schedule_id > 0){
                            $schedule = \App\Models\Schedule::find($schedule_id);
                        }
                        $schedules = \App\Models\Schedule::where('route_id', $routeID)->orderByRaw('CAST(depart_time as time) ASC')->get();

                        $routefares = \App\Models\Route\Fare::where('route_id', $routeID)->get()->toArray();
                        if(count($routefares)){
                            foreach($routefares as $fare){
                                $fares[$fare['luxury_id']][] = $fare;
                            }
                        }
                        if(isset( $data['fares'][$schedule->luxury_type])){
                            $stopovers = $fares[$schedule->luxury_type];
                        }
                        ?>
                        @include('admin.ticket.getSchedules');
                    @else
                    <tr>
                        <td colspan="12" class="text-center">No data</td>
                    </tr>
                    @endif


                    </tbody>
                </table>
            </div>

        </div>

        {{-- Seats --}}
        <div class="col-md-3">
            <div class="py-3 bg-white bus_wrpr">
                <div class="overly py-5 text-center" style="display:{{$schedule_id?'none':''}}"><h3>Schedule not Selected</h3></div>
                <div id="bus_seats" class="icons seats">
                    <?php
                    $total_seats = 45;
                        if($schedule_id > 0){
                            $schedule = \App\Models\Schedule::find($schedule_id);
                            //$bookingdate = date('Y-m-d', strtotime($bookingdate));
                            //$seats = \App\Models\Schedule::where('id', $schedule_id)->with('tickets')->get()->first();
                            $seats = \App\Models\Ticket\TicketSeat::whereHas('ticket', function($query) use ($schedule_id, $bookingdate){
                               return $query->where('schedule_id', $schedule_id)->whereDate('booking_for', $bookingdate);
                            })->Selection();


                            //$ttypes = \App\Models\Schedule::find($schedule_id)->seats()->addSelect(['seat', 'tickets.paid'])->get()->toArray();
                            $ttypes = $schedule->seats()->whereHas('ticket', function($query) use ($schedule, $bookingdate){
                                return $query->whereDate('booking_for', $bookingdate);
                            })->addSelect(['seat', 'tickets.paid'])->get()->toArray();


                            if(count($ttypes)){
                                foreach($ttypes as $ttype){
                                    //dd($ttype);
                                    $btypes[$ttype['seat']] = $ttype['paid'];
                                }
                            }


                            if($schedule != null){
                                $total_seats = $schedule->luxuryType->seats;
                            }
                        }


                    $old = old('seat');
                    $last_row = round($total_seats/4);
                    $row = 1;
                    ?>
                    @for($i=1; $i<=$total_seats; $i++)
                        @if(isset($seats[$i]))
                            <span class="booked icon-{{ $seats[$i] == 'M' ? 'man' : 'woman' }} paid_{{ $btypes[$i] }}"><span>{{ $i
                            }}</span></span>
                        @else
                            <span onclick="seatSelect({{ $i }})" class="seat_{{$i}}">{{ $i }}
                                @if(isset($old[$i]))
                                    <span class="icon-{{ ($old[$i]=='M'?'man':'woman') }}"></span>
                                    <input type="checkbox" value="{{ $old[$i] }}" data-seat="{{$i}}" class="seats seat-{{ $i }} hidden" name="seat[{{ $i }}]" checked>
                                @else
                                    <input type="checkbox" data-seat="{{$i}}" class="seats seat-{{ $i }} hidden" name="seat[{{ $i }}]">
                                @endif
                        </span>
                        @endif

                        @if($last_row != $row)
                            @if($i%4==0)
                                <?php $row++; ?>
                                <div class="clearfix"></div>
                            @elseif($i%2==0)
                                <span class="speac"></span>
                            @endif
                        @endif
                    @endfor
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Customer info--}}
    <div class="row gutter mt-2">
        {{ Form::hidden('route_id') }}
        {{ Form::hidden('schedule_id') }}
        {{ Form::hidden('fare', 550) }}
        <div class="col-md-9">

            <div class="row gutter">
                <div class="col-md-6">
                    <div class="form-group input-group">
                        <span class="input-group-addon">CNIC</span>
                        <input type="text" class="form-control" name="p_cnic" value="{{ old('p_cnic') }}" data-cnic placeholder="XXXXX-XXXXXXX-X" required >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group input-group">
                        <span class="input-group-addon">Name</span>
                        <input type="text" class="form-control" name="p_name" value="{{ old('p_name') }}" placeholder="Enter Name" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group input-group">
                        <span class="input-group-addon">Phone</span>
                        <input type="text" class="form-control" name="p_phone" value="{{ old('p_phone') }}" data-phone placeholder="0300-1234567" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group input-group">
                        <span class="input-group-addon">Seats</span>
                        <input type="text" class="form-control" readonly name="seat_numbers" value="{{ old('seat_numbers') }}" placeholder="22F, 23M, 24M, 25F" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group input-group">
                        <span class="input-group-addon">Qty</span>
                        <input type="text" class="form-control" name="total_seats" id="total_seats" value="{{ old('total_seats') }}" placeholder="22F, 23M, 24M, 25F" required readonly>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <button  class="btn btn-success btn-block py-3"><span class="h4">Book Seats</span></button>
                    </div>
                    <div class="row guttor">
                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="button"  onclick="getList('booklist')" class="btn btn-info btn-block py-3">Booking List</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <a href="{{ route('admin.ticket.ticketing') }}" class="btn btn-primary btn-block py-3">Go to Ticketing</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="bg-white p-3">
                <table class="table table-bordered mb-0">
                    <tr>
                        <th>Fare</th>
                        <td width="100"><input class="form-control" name="fare" id="fare" required></td>
                    </tr>
                    <tr>
                        <th>Total Fare</th>
                        <td id="total_fare">2500</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

    @include('admin.ticket.script')





@endsection

