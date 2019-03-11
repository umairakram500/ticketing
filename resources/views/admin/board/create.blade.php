@extends('admin.layouts.app')
@section('title', 'Boarding Form')
@section('content')
    <div class="panel">
        <div class="panel-boyd">
            {{ Form::open([ 'route' => 'admin.departure.store']) }}
            <div class="row gutter">
                <div class="col-sm-3">
                    <div class="form-group">
                        <?php $routes = \App\Models\Route\Route::selection() ?>
                        {{ Form::label('route_id', 'Route *') }}
                        {{ Form::select('route_id', $routes , $route, ['class' => 'form-control', 'placeholder'=>'-Select Route-', 'disabled'])}}
                        {{ Form::hidden('route_id', $route) }}
                    </div>
                    <!--form-group-->
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        {{ Form::label('schedule_id', 'Schedule *') }}
                        {{ Form::select('schedule_id',  $schedules, $schedule, ['class' => 'form-control', 'placeholder'=>'-Select Schedule-', 'disabled'])}}
                        {{ Form::hidden('schedule_id', $schedule) }}

                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        {{ Form::label('departdate', 'Departure Date *') }}
                        {{ Form::text('departdate', date('Y-m-d'), ['class' => 'form-control', 'data-date', 'disabled'])}}
                    </div>
                    <!--form-group-->
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        {{ Form::label('departdate', 'Depart Time *') }}
                        {{ Form::text('departtime', date('h:i A'), ['class' => 'form-control', 'required', 'disabled'])}}
                    </div>
                    <!--form-group-->
                </div>
            </div>

            <div class="row gutter">
                <div class="col-sm-3">
                    <div class="form-group">
                        {{ Form::label('from_terminal', 'Terminal *') }}
                        {{ Form::text('from_terminal', Auth::user()->terminal->title, ['class' => 'form-control','placeholder'=>'- Select Stop -', 'disabled'])}}
                    </div>
                    <!--form-group-->
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        {{ Form::label('to_terminal', 'To Stop *') }}
                        {{ Form::select('to_terminal', $stops, null, ['class' => 'form-control','placeholder'=>'- Select Stop -', 'required'])}}
                    </div>
                    <!--form-group-->
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <?php $drivers = \App\Models\Staff\Staff::DriverList(); ?>
                        {{ Form::label('driver_id', 'Driver *') }}
                        {{ Form::select('driver_id',  $drivers,null, ['class' => 'form-control', 'placeholder'=>'- Select Driver -', 'required'])}}
                    </div>
                    <!--form-group-->
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <?php $conductors = \App\Models\Staff\Staff::ConductorList(); ?>
                        {{ Form::label('conductor_id', 'Conductor/Hostess *') }}
                        {{ Form::select('conductor_id',  $conductors, null, ['class' => 'form-control', 'placeholder'=>'- Select Conductor -', 'required'])}}
                    </div>
                    <!--form-group-->
                </div>

            </div>



            <div class="row gutter">
                <div class="col-sm-6" ng-app="">
                    <label for=""><strong>Terminal Expenses *</strong></label>
                    <?php
                    $expenses = \App\Models\ExpenseType::where([
                            ['terminal_deduct', 1],
                            ['status', 1]
                    ])->get();
                    $ter_exps = \App\Models\ExpensetypeTerminal::where('terminal_id', Auth::user()->terminal_id)->get()->pluck('amount', 'expensetype_id')->toArray();
                    ?>

                    <table class="table table-bordered">
                        @forelse($expenses as $expense)
                            <tr>
                                <td>{{ $expense->title }}</td>
                                <td>{{ Form::text('exp['.$expense->id.']', ($ter_exps[$expense->id] ?? 0), ['class' => 'form-control'])}}</td>
                            </tr>
                        @empty
                        @endforelse
                    </table>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <?php $buses = \App\Models\Bus\Bus::list(); ?>
                        {{ Form::label('bus_id', 'Bus *') }}
                        {{ Form::select('bus_id',  $buses , null, ['class' => 'form-control', 'placeholder'=>'- Select Bus -', 'required'])}}
                    </div>
                    <!--form-group-->

                    <div class="form-group">
                        <table class="table table-bordered">
                            <tr>
                                <th>Seats booked</th>
                                <th>Extra booked</th>
                                <th>Total</th>
                            </tr>
                            <tr>
                                <td>{{ $booked_seats }}{{ Form::hidden('total_psg', $total_seats) }}</td>
                                <td>{{ $extra_seats }}</td>
                                <td>{{ $total_seats }}</td>
                            </tr>
                        </table>
                    </div>
                    <!--form-group-->

                    <div class="form-group">
                        <table class="table table-bordered">
                            <tr>
                                <th>Total Sale</th>
                                <th>Discounts</th>
                                <th>Refunds</th>
                                <th>Expenses</th>
                                <th>Total Sale</th>
                            </tr>
                            <tr>
                                <td>{{ $total_fare }} {{ Form::hidden('total_fare', $total_fare) }}</td>
                                <td>{{ $total_discount }} {{ Form::hidden('total_discount', $total_discount) }}</td>
                                <td>-</td>
                                <td>{{ array_sum($ter_exps) }}</td>
                                <td>{{ $total_fare - $total_discount }}</td>
                            </tr>
                        </table>
                    </div>
                    <!--form-group-->
                </div>
            </div>

            <div class="row gutter mt-5">
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-success btn-block py-3">Add Voucher & Print</button>
                </div>
                <div class="col-sm-6">
                    <button type="button" class="btn btn-default btn-block py-3">Cancel</button>
                </div>

            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection