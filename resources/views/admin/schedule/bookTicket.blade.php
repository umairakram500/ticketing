@extends('admin.layouts.app')

@section('title', 'Booking')
@section('sub-title', $schedule->route->title)

@section('content')
    <style>
        .icons.seats .icheckbox_square-blue {
            display: none;
        }
    </style>
    <?php
    $old = old('seat');
    if(old('to_city') > 0 )
        $to_city = old('to_city');
    ?>
    <div class="row gutter">

        <div class="col-md-12">
            <table class="table table-bordered bg-white">
                <tr>
                    <th width="120">Route:</th>
                    <td>{{ $schedule->route->title }}</td>
                    <th width="120">Depart Time:</th>
                    <td>{{ date('M d, Y h:m A', strtotime($schedule->created_at)) }}</td>
                </tr>
            </table>
        </div>

        {!! Form::open(['route' => ['admin.ticket.store', $schedule->id]]) !!}

        <div class="col-md-2 col-sm-12">
            <div class="row">
                <table class="">
                    <tr>
                        <td>
                            <span class="bk gb"></span>
                        </td>
                        <td>Gents Booking</td>
                    </tr>
                    <tr>
                        <td>
                            <span class="bk lb"></span>
                        </td>
                        <td>Ladies Booking</td>
                    </tr>
                    <tr>
                        <td>
                            <span class="bk go"></span>
                        </td>
                        <td>Gents online</td>
                    </tr>
                    <tr>
                        <td>
                            <span class="bk lo"></span>
                        </td>
                        <td>Lady online</td>
                    </tr>

                </table>
                <ul>
                    <li>1. One click on seat for male seat selection</li>
                    <li>2. Two click on seat for female seat selection</li>
                    <li>3. 3rd click for unselect</li>
                </ul>
            </div>
            <style>
                .bk {
                    width: 30px;
                    height: 30px;
                    border-radius: 3px;
                    display: block;
                    margin: 3px;
                    margin-right: 10px;
                }
                .lb, .booked.icon-woman.btype_t {
                    background-color: #F1B4BF !important;
                }
                .gb, .booked.icon-man.btype_t {
                    background-color: #76AD22 !important;
                }
                .lo, .booked.icon-woman.btype_o {
                    background-color: #145d42 !important;
                }
                .go, .booked.icon-man.btype_o {
                    background-color: #983648 !important;
                }
            </style>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="panel text-center">
                {{--<img src="{{ asset('img/booked-admin.png') }}" alt=""><div class="clearfix"></div>--}}
                {{--Blue background booked from website and gray background booked from terminal--}}
                <div class="panel-body icons seats text-center pl-3">
                    <?php
                        $last_row = round($schedule->buses->seats/4);
                        $row = 1;
                    ?>
                    @for($i=1; $i<=$schedule->buses->seats; $i++)
                        @if(isset($seats[$i]))
                            <span class="booked icon-{{ $seats[$i] == 'M' ? 'man' : 'woman' }} btype_{{ $btypes[$i] == 2 ? 't' : 'o' }}"><span>{{ $i
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
                </div>
            </div>
        </div>



        <div class="col-md-6 col-sm-12">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
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
            <div class="panel">
                <div class="panel-body">
                    <div class="row gutter">
                        <div class="col-md-8 col-sm-12">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><span class="fa fa-address-card-o"></span></span>
                                {{ Form::text('p_cnic', null, ['class' => 'form-control', 'placeholder' => 'CNIC *', 'data-cnic', 'placeholder' => 'CNIC: xxxxx-xxxxxxx-x', 'maxLength' => 15])}}
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <style>
                                .cu.alert { display: none }
                            </style>
                            <div class="form-group text-center">
                                <div class="cu alert alert-danger error">
                                    CNIC Not Valid!
                                </div>
                                <div class="cu alert alert-success loading">
                                    loading...
                                </div>
                                <div class="cu alert alert-info new">
                                    New Passenger
                                </div>
                                <div class="cu alert alert-info existing">
                                    Existing Passenger
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row gutter">
                        <div class="col-md-6 col-sm-12">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                                {{ Form::text('p_phone', null, ['class' => 'form-control', 'placeholder' => 'Phone *', 'data-phone', 'placeholder' => '03xx-xxxxxxx'])}}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="input-group form-group">
                                <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                {{ Form::text('p_name', null, ['class' => 'form-control', 'placeholder' => 'Name *'])}}
                            </div>
                        </div>
                    </div>
                    <div class="row gutter">
                        <div class="col-md-6 col-sm-12">
                            <div class="input-group form-group">
                                <span class="input-group-addon">From</span>
                                {{ Form::text('', $schedule->route->from_city->name, ['class' => 'form-control', 'readonly'])}}
                                {{ Form::hidden('from_city_id', $schedule->route->from_city_id) }}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="input-group form-group">
                                <span class="input-group-addon">To</span>
                                {{ Form::text('',  $schedule->route->to_city->name, ['class' => 'form-control', 'readonly'])}}
                                {{ Form::hidden('to_city_id', $schedule->route->to_city_id) }}
                            </div>
                        </div>
                    </div>
                    <div class="row gutter">
                        <div class="col-md-6 col-sm-12">
                            <div class="input-group form-group">
                                <span class="input-group-addon">From</span>
                                {{ Form::select('from_stop', $stops, null, ['class' => 'form-control', 'id'=>'from_stop'])}}
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="input-group form-group">
                                <span class="input-group-addon">To</span>
                                {{ Form::select('to_stop', $stops, null, ['class' => 'form-control','id'=>'to_stop'])}}
                            </div>

                        </div>
                    </div>
                    <div class="row gutter">
                        <div class="col-xs-3">
                            <label for="total_seats">Total Seats</label>
                            <div class="input-group form-group">
                                <span class="input-group-addon"><span class="fa fa-users"></span></span>
                                {{ Form::number('total_seats', null, ['class' => 'form-control', 'min' => 1, 'id' => 'total_seats'])}}
                            </div>
                        </div>
                        <div class="col-xs-1">
                            <label>&nbsp;</label>
                            <div><h1 class="mb-0">X</h1></div>
                        </div>
                        <div class="col-xs-3">
                            <label for="fare">Fare Per Seat</label>
                            <div class="input-group form-group">
                                <span class="input-group-addon"><span class="fa fa-money"></span></span>
                                {{ Form::number('fare', $schedule->fare, ['class' => 'form-control', 'placeholder' => 'Fare', 'min' => 1, 'readonly', 'id' => 'fare'])}}
                            </div>

                        </div>
                        <div class="col-xs-1">
                            <label>&nbsp;</label>
                            <div><h1 class="mb-0">=</h1></div>
                        </div>
                        <div class="col-xs-4">
                            <label for="total_fare">Total Fare</label>
                            <div class="input-group form-group">
                                <span class="input-group-addon"><span class="fa fa-money"></span></span>
                                {{ Form::text('total_fare', null, ['class' => 'form-control', 'readonly', 'id' => 'total_fare'])}}
                            </div>
                        </div>
                    </div>
                    <div class="row gutter">

                        <div class="col-xs-6">
                            <label for="total_seats">Discount</label>
                            <div class="form-group">
                                {{--<span class="input-group-addon"><span class="fa fa-minus"></span></span>--}}
                                {{ Form::number('discount', null, ['class' => 'form-control', 'readonly', 'id' => 'discount'])}}
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <label for="payable_fare">Recived</label>
                            <div class="form-group">
                                {{--<span class="input-group-addon"><span class="fa fa-money"></span></span>--}}
                                {{ Form::text('payable_fare', null, ['class' => 'form-control', "pattern"=>"[0-9]+", 'id' => 'payable_fare'])}}
                            </div>
                        </div>
                    </div>
                    <div class="row gutter">
                        <div class="col-sm-12">
                            <div class="form-group">
                                {{ Form::label('seat_numbers', 'Seat #') }}
                                {{ Form::text('seat_numbers', null, ['class' => 'form-control', 'readonly'])}}
                            </div>
                        </div>
                    </div>
                    <div class="row gutter">
                        <div class="col-sm-12">
                            <div class="form-group">
                                {{ Form::label('remarks', 'Remarks') }}
                                {{ Form::text('remarks', null, ['class' => 'form-control', 'placeholder' => ''])}}
                            </div>
                        </div>
                    </div>

                    <div class="row gutter">
                        <div class="col-sm-12">
                            <div class="form-group">
                                {{ Form::checkbox('on_phone')}}
                                {{ Form::label('on_phone', 'Phone Booking') }}

                            </div>
                        </div>
                    </div>
                    @if(!$schedule->departured)
                    <div class="row gutter">
                        <div class="col-sm-12">
                            {{ Form::submit('Add Ticket', ['class' => 'btn btn-block btn-primary'])}}
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Schedule Voucher</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>Seat Book from</th>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Website</td>
                            <td><strong class="text-info">8</strong></td>
                        </tr>
                        <tr>
                            <td>App</td>
                            <td><strong class="text-info">20</strong></td>
                        </tr>

                        <tr>
                            <td>Total</td>
                            <td><strong class="text-info">28</strong></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info" onclick="alert('Under development')"
                            data-dismiss="modal">Print</button>
                </div>
            </div>

        </div>
    </div>
    <!-- end: Modal -->
    <style>
        .icons.seats .icheckbox_square-blue {
            display: none;
        }
        @media print {

            body * {
               display: none;
            }
            body .modal * {
                display: block !important;
            }
        }
    </style>
@endsection

@push('buttons')
{{--<li><a href="javascript:;" class="btn btn-danger"><span class="fa fa-times"></span>Cancel</a></li>
<li><a href="javascript:;" class="btn btn-success"><span class="fa fa-check"></span>Departed</a></li>--}}
<li><a href="{{ route('admin.voucher.create', $schedule->id) }}" class="btn btn-success"><span class="fa fa-clipboard"></span>Genrate Voucher</a></li>
<li><a href="{{ route('admin.ticket.index', $schedule->id) }}" class="btn btn-info"><span class="fa fa-clipboard"></span>View Tickets</a></li>
@endpush

@push('after-js')
<script>
    var stopovers = JSON.parse('{!! $stopovers !!}');

    //console.log(stopovers.find(stopover => stopover.id === 13));
    /*for (var i = 0; i < stopovers.length; i++){
     // look for the entry with a matching `code` value
     if (stopovers[i].id === 13){
     console.log(stopovers[i]);
     }
     }*/
    function stopChange(){
        stopovers.find(stopover => stopover.id === 13)
    }
    function seatSelect(id){
        var seat = $('.seat-'+id);
        var seat_no = $('.seat_'+id);
        if(seat.is(':checked')){
            if(seat.val() == 'F'){
                seat.prop( "checked", false ).val('');
                seat_no.find('span').remove();
            } else {
                seat.val('F');
                seat_no.find('span').attr('class', 'icon-woman');
            }
        } else {
            seat.prop( "checked", true ).val('M');
            seat_no.append('<span class="icon-man"></span>');
        }
        setSeat();
        //console.log(id, seat.val(), seat.is(':checked'));
    }
    function setSeat(){
        var seats = $('.seats:checked');
        var seat_no = '';

        seats.each(function(i, e){
            seat_no += ','+$(e).data('seat')+$(e).val();

        });
        $('input[name="total_seats"]').val(seats.length);
        $('input[name="total_fare"]').val(seats.length*$('input[name="fare"]').val());
        $('input[name="seat_numbers"]').val(seat_no.substr(1));
    }
    $(document).ready(function(){
        var fare = parseInt('{{ $schedule->fare }}}');

        $('#total_seats').on('keyup change',function(){
            var seats = $(this).val();
            var discount = $('#discount').val();
            $('#total_fare').val((seats*fare));
            $('#payable_fare').val((seats*fare)-discount);
        });
        $('#payable_fare').on('keyup change',function(){
            var recived = $(this).val();
            var seats = $('#total_seats').val();
            //$('#total_fare').val((seats*fare));
            $('#discount').val((seats*fare)-recived);
        });
        $('#to_stop, #from_stop').on('change',function(){
            var from = parseInt($('#from_stop option:selected').val());
            var to = parseInt($('#to_stop option:selected').val());

            var newfare = stopovers.find(function(stopover){
                if(stopover.from_stop_id === from && stopover.to_stop_id === to){
                    return stopover.fare;
                }
            });
            fare = newfare.fare;
            $('#fare').val(fare);
            $('#total_seats').trigger('change');
            //console.log(fare, '22');
        });

        $('input[name="p_cnic"]').on('keypress change',function(){
            var cnic = $(this).val();
            var myRegExp = new RegExp(/\d{5}-\d{7}-\d/);
            $('.cu.alert').hide();
            if(!myRegExp.test(cnic)) {
                // enter valid cnic message
                $('.cu.alert.error').show();
            }
            else {
                $('.alert.loading').show();
                $('input[name="p_phone"]').focus();
                $.get('{{ url('admin/getCustomerInfo')}}/'+cnic, function(res){
                    console.log(res);
                    $('.cu.alert').hide();
                    if(res.error != undefined){
                        $('.alert.new').show();
                        $('input[name="p_phone"], input[name="p_name"]').val('');
                    } else{
                        $('.cu.alert.existing').show();
                        $('input[name="p_phone"]').val(res.phone);
                        $('input[name="p_name"]').val(res.name);
                    }
                })
            }
        });

    })
</script>
@endpush



