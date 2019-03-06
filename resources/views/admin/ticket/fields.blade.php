<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('depart', 'Departure') }}
            {{ Form::select('depart', array('Faisalabad', 'Lahore'), null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('depart', 'Arrival') }}
            {{ Form::select('depart', array('Faisalabad', 'Lahore'), null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('depart', 'Date') }}
            {{ Form::date('date', null, ['class' => 'form-control'])}}
        </div><!--form-group-->
    </div>
    <div class="col-md-3">
        <div class="form-group mt-5">
            {{ Form::button('Get Schedules', ['class' => 'btn btn-info'])}}
        </div><!--form-group-->
    </div>
</div>
<div class="row">
    <div class="col-sm-12 legneds pb-4">
        <table class="legends">
            <tr>
                <td><span class="bk gb"></span></td>
                <td>Gents Booking</td>
                <td><span class="bk lb"></span></td>
                <td>Ladies Booking</td>
                <td><span class="bk go"></span></td>
                <td>Gents online</td>
                <td><span class="bk lo"></span></td>
                <td>Lady online</td>
            </tr>
        </table>
    </div>
</div>
<div class="row gutter">
    <div class="col-md-9">
        <div class="table-responsive">
            <table class="table table-bordered bg-white table-striped table-hover">
                <tead>
                    <tr class="info">
                        <th>Sr#</th>
                        <th>Time</th>
                        <th>Route</th>
                        <th>BusType</th>
                        <th>Seats</th>
                        <th>Fare</th>
                        <th>Res</th>
                        <th>Deli</th>
                        <th>Avai</th>
                        <th>Open</th>
                        <th>Status</th>
                    </tr>
                </tead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>09:00</td>
                    <td>FSD-LHR</td>
                    <td>Hino</td>
                    <td>44</td>
                    <td>550</td>
                    <td>22</td>
                    <td>10</td>
                    <td>12</td>
                    <td>1</td>
                    <td>1</td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
    <div class="col-md-3">
        <div class="py-3 bg-white">
            <div class="icons seats">
                <?php
                $last_row = round(45/4);
                $row = 1;
                ?>
                @for($i=1; $i<=45; $i++)
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
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>

<div class="row gutter mt-2">
    <div class="col-md-9">

        <div class="row gutter">
            <div class="col-md-6">
                <div class="form-group input-group">
                    <span class="input-group-addon">CNIC</span>
                    <input type="text" class="form-control" name="cnic" placeholder="XXXXX-XXXXXXX-X">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group input-group">
                    <span class="input-group-addon">Name</span>
                    <input type="text" class="form-control" name="name" placeholder="Enter Name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group input-group">
                    <span class="input-group-addon">Phone</span>
                    <input type="text" class="form-control" name="name" placeholder="0300-1234567">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group input-group">
                    <span class="input-group-addon">Seats</span>
                    <input type="text" class="form-control" readonly name="name" placeholder="22F, 23M, 24M, 25F">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <button class="btn btn-success btn-block py-3"><span class="h4">Issue Ticket
</span></button>
                </div>
                <div class="row gutter">
                    <div class="col-md-4">
                        <div class="form-group">
                            <button class="btn btn-danger btn-block py-3">Cancel Ticket</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button class="btn btn-danger btn-block py-3">Cancel All</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button class="btn btn-primary btn-block py-3">Duplicate Print</button>
                        </div>
                    </div>
                </div>

                <div class="row gutter">
                    <div class="col-md-4">
                        <div class="form-group">
                            <button class="btn btn-info btn-block py-3">Way Bill</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button class="btn btn-info btn-block py-3">Ticket List</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button class="btn btn-info btn-block py-3">Booking List</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-3">
        <div class="bg-white p-3">
            <table class="table table-bordered table-striped mb-0 " valign="middle">
                <tbody class="amounts">
                <tr>
                    <th width="120">No. of Seat</th>
                    <td>3</td>
                </tr>
                <tr>
                    <th>Fare</th>
                    <td>500</td>
                </tr>
                <tr>
                    <th>Total Fare</th>
                    <td>2000</td>
                </tr>
                <tr>
                    <th>Discount</th>
                    <td><input type="text" value="200" class="form-control"></td>
                </tr>
                <tr>
                    <th>Amount Paid</th>
                    <td><input type="text" value="2000" class="form-control"></td>
                </tr>
                <tr>
                    <th>Return Back</th>
                    <td>200</td>
                </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>



<style>
    .icons.seats .icheckbox_square-blue {
        display: none;
    }
    .icons.seats {
        width: 250px;
        margin: 0 auto;
    }
    @media print {

        body * {
            display: none;
        }
        body .modal * {
            display: block !important;
        }
    }
    .bk {
        width: 30px;
        height: 30px;
        border-radius: 3px;
        display: block;
        margin: 3px;
        margin-right: 5px;
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
    .legends tr td:nth-child(even) {
        padding-right: 20px;
    }
    .amounts tr td:last-child {
        text-align: right;
    }
    .amounts tr td:last-child input.form-control {
        text-align: right !important;
    }
</style>

@push('after-js')
<script>
    var stopovers = {};

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
        var fare = 500;

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