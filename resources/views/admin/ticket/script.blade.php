@push('before-js')
<script>
    var stopovers = {};
    var fares = {};
    var fare = 0;
    var busSeatsURI = '{!! route('admin.ticket.getBusSeats') !!}';
    var isuseTicketURI = '{{ route('admin.ticket.issueByID') }}';
    var ticketPrintURI = '{{ url('admin/ticket') }}';


</script>
@endpush

@push('after-js')
<script>
<?php // dd($stopovers) ?>

    @if(isset($stopovers))
    stopovers = JSON.parse('{!! isset($stopovers) ? json_encode($stopovers) : '' !!}');
    @endif

    @if(isset($fares))
    fares = JSON.parse('{!! isset($fares) ? json_encode($fares) : '' !!}');
console.log('asdf');
    @endif

    $(document).ready(function(){

        $('#bookingdate').datepicker({
            minDate: 0,
            maxDate: "+1m",
            dateFormat: "yy-mm-dd"
        });

        $('#route').select2();

        $('#total_seats, #disfare, #fare').on('keyup change', function(){
            fareCalculate();
        });
        $('#discount').on('keyup change',function(){
            fareCalculate();
        });
        $('#amount_paid').on('keyup change',function(){
            var fare = $('#fare').val();
            var recived = $(this).val();
            var seats = $('#total_seats').val();
            var discount = $('#discount').val();
            var total_fare = seats * fare - discount
            var ret = recived - total_fare
            $('#return').text( ret >= 0 ? ret : 0 );
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
                $.get('{{ url('admin/getCustomerInfo')}}/'+cnic, function(res){
                    if(res.error != undefined)
                    {
                        console.log('not found');
                        $('input[name="p_name"]').focus();
                        $('input[name="p_phone"], input[name="p_name"]').val('').prop('readonly', false);
                    }
                    else{
                        console.log('User found');
                        $('input[name="p_phone"]').val(res.phone).prop('readonly', true);
                        $('input[name="p_name"]').val(res.name).prop('readonly', true).focus();
                    }
                })
            }
        });

        $('#getSchedules').click(function(){
            $('.bus_wrpr .overly').show();
            var route = $('#route option:selected').val();
            var bookdate = $('#bookingdate').val();
            if(route == '' || route == undefined){
                alert('Route not selected');
                return false;
            }

            var uri = '{{ route('admin.ticket.getSchedules') }}?route='+route+'&bookingdate='+bookdate;
            $.get(uri, function(res){
                $("#schedules").html(res);
            });
        });

        // get stops list on the base of route
        $('#route').change(function(){
            onRouteChange();
        });

        $('#from_stop, #to_stop').on('change',function(){
            getfare();
        });
        // Bus seats
        $(document).on('click', '[data-schedule]',function(){
            //$('#total_seats').removeAttr('readonly');
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
            var type = $(this).data('type');
            var schedule = $(this).find('td:nth-child(2)').text();
            var route = $(this).find('td:nth-child(3)').text();
            $('#selected-schedule').text(schedule);
            $('#selected-route').text(route);
            stopovers = fares.hasOwnProperty(type) ? fares[type] : {};
            getfare();
            getBusSeats(this, busSeatsURI);
        });

        $('#ticketlist, #booklist').click(function(){
            var list = $(this).attr('id');

            var bookingdate = $('#bookingdate').val();
            var schedule = $('#schedules tr.active').data('schedule');

            if(schedule == undefined || schedule == ''){
                alert('Schedule not selected');
                return false;
            }
            if(bookingdate == undefined || bookingdate == ''){
                alert('Select booking date');
                return false;
            }
            if(list == 'booktlist')
                var url = '{{ route('admin.ticket.booklist') }}/'+schedule+'/'+bookingdate;
            else
                var url = '{{ route('admin.ticket.issuelist') }}/'+schedule+'/'+bookingdate;

            window.open( url, '_blank');

        });

        $('#searchSchedule').on('submit', function(e){
            var error = 0;
            var formData = {};
            $.each($('#searchSchedule').serializeArray(), function() {
                formData[this.name] = this.value;
            });
            if(!(formData.schedule_id>0)){
                error = 1;
                alert('Schedule not selected');

            }
            if(error) {
                e.preventDefault();
            }
        });

        @if($routeID)
        $('tr[data-schedule="{{ $schedule_id }}"]').trigger('click');
        @endif

        $('#depart').on('click', function(){
            var bookingdate = $('#bookingdate').val();
            var route = $('#route option:selected').val();
            var schedule = $('#schedules tr.active').data('schedule');

            if(bookingdate === '' || bookingdate === undefined){
                alert('Booking Date not selected');
                return false;
            }
            if(route === '' || route === undefined){
                alert('Route not selected');
                $('#route').focus();
                return false;
            }
            if(schedule === '' || schedule === undefined){
                alert('Schedule not selected');
                $('#schedules').focus();
                return false;
            }

            window.location.href = '{{ route('admin.departure.create') }}?route='+route+'&schedule='+schedule+'&bookingdate='+bookingdate;
        });

        onRouteChange();

    });

    function getfare()
    {
        var from = parseInt($('#from_stop option:selected').val());
        var to = parseInt($('#to_stop option:selected').val());
        //console.log(from, to, stopovers);
        if(stopovers.hasOwnProperty('length')){

            $.each(stopovers, function(i, v){
                if(v.from_terminal_id == from && v.to_terminal_id == to){
                    fare = v.fare;
                }
            });
        } else {
            fare = 0;
        }

        $('#fare, #disfare').val(parseInt(fare));
        $('#disfare').attr('max', parseInt(fare));
        //$('#total_seats').trigger('change');
        fareCalculate();
    }



    function onRouteChange(){
        var route = parseInt($('#route option:selected').val());
        if(route > 0)
        {
            $.ajax({
                url: '{{ route('admin.route.getStops') }}/'+route,
                //async: false,
                success: function(res){
                    fares = res.fares;
                    console.log(fares);
                    var stops = '';
                    $.each(res.stops, function(i,v){
                        stops += '<option value="'+ v.id+'">'+ v.title+'</option>'
                    });
                    $('#to_stop').html(stops);
                    $('#from_stop').html('<option value="{{ Auth::user()->terminal_id }}">{{ Auth::user()->terminal->title ?? 'Terminal not found' }}</option>');

                    $('#to_stop option[value="'+res.to+'"]').prop('selected', true);
                    $('#getSchedules').click();
                }
            });
        }
    }

    function getList( listof )
    {
        var bookingdate = $('#bookingdate').val();
        var schedule = $('#schedules tr.active').data('schedule');

        if(schedule == undefined || schedule == ''){
            alert('Schedule not selected');
            return false;
        }
        if(bookingdate == undefined || bookingdate == ''){
            alert('Select booking date');
            return false;
        }
        var url = '{{ url('admin/ticket') }}/'+listof+'/'+schedule+'/'+bookingdate;
        window.open( url, '_blank');
    }

    function getTicketInfo(id, paid)
    {

        var data = $('tr[data-schedule].active').data();
        data.bookingdate = $('#bookingdate').val();

        console.log(data);

        $.ajax({
            url: '{{ route('admin.ticket.getInfo') }}/'+id,
            data: data,
            type: 'get',
            success: function(res){
                console.log(res);
                $('input[name="p_cnic"]').val(res.p_cnic);
                $('input[name="p_name"]').val(res.p_name);
                $('input[name="p_phone"]').val(res.p_phone);
                $('input[name="p_phone"], input[name="p_name"]').prop('readonly', true);

                if(res.paid == 0)
                {
                    $('input[name="seat_numbers"]').val(res.seat_numbers);
                    var seats = res.seat_numbers.split(",");
                } else {
                    $('input[name="seat_numbers"]').val('');
                }
            }
        })

        $('.seats.seat-'+id).prop('checked', !$('.seats.seat-'+id).is(':checked'));
        setSeat();

    }

    window.onload = function() {
        clock();
        function clock() {
            var now = new Date();
            var TwentyFourHour = now.getHours();
            var hour = now.getHours();
            var min = now.getMinutes();
            var mid = ' PM';
            if (min < 10) min = "0" + min;
            if (hour > 12) hour = hour - 12;
            if(hour==0) hour=12;
            if(TwentyFourHour < 12) mid = ' AM';

            document.getElementById('timeclock').innerHTML = hour+':'+min + mid ;
            setTimeout(clock, 1000);
        }
    }

function cancelAllBooking()
{
    var bookingdate = $('#bookingdate').val();
    var schedule_id = $('#schedules tr.active').data('schedule');
    var schedule_time = $('#schedules tr.active td:nth-child(2)').text();
    var schedule_name = $('#schedules tr.active td:nth-child(3)').text();
    var bookingdate = $('#bookingdate').val();
    if(schedule_id === undefined){
        alert('Schedule not selected');
        return false;
    }
    if(bookingdate === undefined && bookingdate == ''){
        alert('Select booking date');
        return false;
    }

    var data = { bookingdate: bookingdate, schedule: schedule_id }

    var r = confirm("Are you sure?\nCancel all Booking of Route '"+schedule_name+"' at "+schedule_time+"!");
    if (r == true) {
        $.ajax({
            url : '{{ route('admin.ticket.cancelAllBooking') }}',
            type : 'get',
            data : data,
            success: function(res){
                getBusSeats($('#schedules tr.active'), busSeatsURI);
                alertify.success(res.msg);
            }
        })
    }
}

function cancelBooking()
{
    var txt;
    var ticketid = prompt("Please enter Booking ID");
    if (ticketid != null || ticketid != "") {
        url = '{{ route('admin.ticket.cancelBooking') }}'+"/"+ticketid;
        console.log(url);
        $.post(url, function(res){
            console.log(res);
            alert(res.msg);
            getBusSeats($('#schedules tr.active'), busSeatsURI);
        })
    }
    //document.getElementById("demo").innerHTML = txt;
}



</script>

@endpush