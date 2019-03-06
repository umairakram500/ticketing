@extends('front.layout.master')

@push('css')
<?php  $old = old('seat'); ?>
@endpush
@section('content')
    <style>

        .seat_tb td {
            width: 45px;
            height: 42px;
            background: url('{{ asset('img/seats1.png') }}') no-repeat center;
            color: #000;
            font-size: 10px;
            font-weight: 700;
        }
        .seat_tb tr td:nth-child(3) {
            background-image: none;
        }
        .seat_tb tr:last-child td:nth-child(3) {
            background-image: url('{{ asset('img/seats1.png') }}');
        }
        .seat_tb {
            width: 243px;
            text-align: center;
            border: 3px solid;
        }
        .bus .hf { width:244px}
        .seat_tb td input { display: none; }
        td.seat.seat_f { background-image: url('{{ asset('img/seats1f.png') }}'); }
        td.seat.seat_m { background-image: url('{{ asset('img/seats1m.png') }}'); }
        td.seat_fb { background-image: url('{{ asset('img/seats1f-b.png') }}'); cursor: no-drop;}
        td.seat_mb { background-image: url('{{ asset('img/seats1m-b.png') }}'); cursor: no-drop;}
    </style>
    <div class="container">
        <div class="row py-5">
            {{ Form::open(['route' => ['front.ticket.store', $schedule->id]]) }}
            <div class="col-md-5">
                <img src="{{ asset('img/seats-title.png') }}" alt="">
                <p>*One click on seat for male seat selection and dubble for femail</p>

                <div class="col-md-12" align="center">
                    <div class="row bus">
                        <div class="col-sm-12" align="center">
                            <img class="hf" src=" {{ asset('img/front4.2.jpg') }}">
                        </div>
                        <table class="seat_tb">
                            <?php
                            $s=0;
                            $tseats = $schedule->bus->seats;
                                $last_row = round($tseats/4);
                            ?>
                            @for($i=1; $i<= (round($tseats/4)); $i++)
                            <tr>
                                {{--@for($j=1; $j<=($i==11?5:4); $j++)--}}
                                @for($j=1; $j<=($last_row==$i?5:4); $j++)
                                    @php $s++ @endphp
                                    @if(array_key_exists($s, $seats))
                                        <td class="seat_{{ $seats[$s] == 'F' ? 'f' : 'm' }}b">{{ $s }}</td>
                                    @else
                                        <td class="seat {{ isset($old[$s])?'seat_'.($old[$s]=='M'?'m':'f'):'' }}" data-id="{{ $s }}">
                                            <input type="checkbox" value="{{ isset($old[$s])?$old[$s]:'' }}" {{ isset($old[$s])?'checked':'' }} data-id="{{ $s }}" id="seat-{{$s}}" name="seat[{{ $s }}]">{{ $s }}</td>
                                    @endif

                                    @if($j == 2 && $last_row != $i) {{-- && $i!== 11 --}}
                                        <td></td>
                                    @endif
                                @endfor
                            </tr>
                            @endfor

                        </table>
                        <div class="row">
                            <div class="col-sm-12" align="center">
                                <img class="hf" src="{{ asset('img/bottom1.png') }}" style="width: 252px;">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="bg-dark p-3 mb-4 text-white">
                    {{ $schedule->route->from_city->name }} <span class="fa fa-arrow-right"></span> {{
                    $schedule->route->to_city->name }}
                </div>


                <div class="row gutter">
                    <div class="col-md-6 col-sm-12">
                        <div class="input-group form-group">
                            <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                            {{ Form::text('p_phone', null, ['class' => 'form-control', 'placeholder' => 'Phone *',  'required', 'data-phone', 'placeholder' => '03xx-xxxxxx' ])}}
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="input-group form-group">
                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                            {{ Form::text('p_name', null, ['class' => 'form-control', 'placeholder' => 'Name *', 'required', "data-text"=>'only'])}}
                        </div>

                    </div>
                </div>
                <div class="row gutter">
                    <div class="col-md-6 col-sm-12">
                        <div class="input-group form-group">
                            <span class="input-group-addon"><span class="fa fa-address-card-o"></span></span>
                            {{ Form::text('p_cnic', null, ['class' => 'form-control', 'placeholder' => 'CNIC *', 'required', 'data-cnic', 'placeholder' => 'XXXXX-XXXXXXX-X' ])}}
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="input-group form-group">
                            <span class="input-group-addon"><span class="fa fa-money"></span></span>
                            {{ Form::text('fare', $schedule->fare, ['class' => 'form-control', 'placeholder' => 'Fare', 'readonly'])}}
                        </div>

                    </div>
                </div>
                <div class="row gutter">
                    <div class="col-md-6 col-sm-12">
                        <div class="input-group form-group">
                            <span class="input-group-addon">From</span>
                            {{ Form::select('from_city_id', $from_cities, null, ['class' => 'form-control'])}}
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="input-group form-group">
                            <span class="input-group-addon">To</span>
                            {{ Form::select('to_city_id', $to_cities, $to_city, ['class' => 'form-control'])}}
                        </div>

                    </div>
                </div>
                <div class="row gutter">
                    <div class="col-md-6 col-sm-12">
                        <div class="input-group form-group">
                            <span class="input-group-addon"><span class="fa fa-quora"></span></span>
                            {{ Form::text('total_seats', null, ['class' => 'form-control', 'placeholder' => 'Total Seats *', 'readonly'])}}
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="input-group form-group">
                            <span class="input-group-addon"><span class="fa fa-money"></span></span>
                            {{ Form::text('total_fare', null, ['class' => 'form-control', 'placeholder' => 'Total Fare', 'readonly'])}}
                        </div>
                    </div>
                </div>
                <div class="row gutter">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('seat_numbers', 'Seat #') }}
                            {{ Form::text('seat_numbers', null, ['class' => 'form-control', 'placeholder' => '', 'readonly'])}}
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

                {{--<div class="row gutter">
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::radio('paid', 0, true, ['id' => 'paid-later'])}}
                            {{ Form::label('paid-later', ' Pay later ' ) }}
                            &nbsp; &nbsp;
                            {{ Form::radio('paid', 1, false, ['id' => 'paid-now'])}}
                            {{ Form::label('paid-now', ' Pay now ' ) }}
                        </div>
                    </div>
                </div>--}}



                <div class="row gutter">
                    <div class="col-sm-12">
                        {{ Form::submit('Book Now', ['class' => 'btn btn-block btn-primary'])}}
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@push('js')
@include('front.includes.scripts')
<script>
    jQuery(document).ready(function($){
        $('.seat').click(function(){
            var id = $(this).data('id');

            var seat = $('#seat-'+id);
            if(seat.is(':checked')){
                if(seat.val() == 'F'){
                    seat.prop( "checked", false ).val('');
                    seat.parents(":eq(0)").removeClass('seat_f');
                } else {
                    seat.val('F');
                    seat.parents(":eq(0)").toggleClass('seat_f seat_m');
                }
            } else {
                seat.prop( "checked", true ).val('M');
                seat.parents(":eq(0)").addClass('seat_m');
            }

            var seats = $('input[id^="seat"]:checked');
            var seat_no = '';

            seats.each(function(i, e){
                seat_no += ','+$(e).data('id')+$(e).val();

            });
            $('input[name="total_seats"]').val(seats.length);
            $('input[name="total_fare"]').val(seats.length*$('input[name="fare"]').val());
            $('input[name="seat_numbers"]').val(seat_no.substr(1));

        });
    });
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
</script>
@endpush
