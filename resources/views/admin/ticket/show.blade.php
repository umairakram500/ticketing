<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/print/ticket.css') }}" rel="stylesheet" media="print">
    <style>
        #intro p {
            margin-bottom: 4px !important;
        }
        /*@media print {*/
            #intro p {
                margin-bottom: 4px !important;
            }
            th { text-align: left !important;}
            body {
                width: 250px;
                margin: auto;
            }
            h3 { margin: 0}
        /*}*/

    </style>
</head>

<body>
<?php $seats = explode(",",$ticket->seat_numbers); ?>
@foreach($seats as $seat)
<div id="myticket" class="container  rounded m-auto">
    <div class="text-center">
        <center>
        <img style="height:70px;" src="{{ asset('img/ticket-logo.png') }}" alt="logo image here" class="responsive">
        <div>Company Address, City</div>
        <div>Thanks for Travel</div>
            <h3>Tick #{{$ticket->id}}</h3>
        </center>
    </div>
    <tr>
        <hr style="background:black;">
        <table>
            <tr>
                <td colspan="2">
                    <center><h3>For Passenger</h3></center>
                </td>
            </tr>
            <tr>
                <th class="col-sm-6">Seat#</th>
                <th class="col-sm-6">{{$seat}}</th>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{$ticket->p_name}}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{$ticket->p_phone}}</td>
            </tr>
            <tr>
                <th>CNIC</th>
                <td>{{$ticket->p_cnic}}</td>
            </tr>
            <tr>
                <th>Departure</th>
                <td>{{$schedule->depart_time}}</td>
            </tr>
            <tr>
                <th>Route</th>
                <td>{{$route->title}}</td>
            </tr>

            <tr>
                <td colspan="2">
                    <hr style="background:black;">
                </td>
            </tr>

            <tr>
                <th>Fare</th>
                <td align="right">{{$ticket->total_fare}}</td>
            </tr>
            <tr>
                <th>Discount</th>
                <td align="right">{{$ticket->discount}}</td>
            </tr>
            <tr>
                <th>Net Fare</th>
                <td align="right">{{$ticket->total_fare-$ticket->discount}}</td>
            </tr>
        </table>

    <table>
        <tr>
            <td colspan="2">
                <hr style="border:1px dashed;">
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <center><h3>For Staff</h3></center>
            </td>
        </tr>

        <tr>
            <th width="80">Ticket No.</th>
            <td>{{$ticket->id}}</td>
        </tr>
        <tr>
            <th>Seat No.</th>
            <td>{{$seat}}</td>
        </tr>
        <tr>
            <td><b>Route</b></td>
            <td valign="">{{$route->title}}</td>
        </tr>
    </table>
    </div>
</div>
    @if(count($seats) > 1)
        <div style="page-break-after: always;">&nbsp;</div>
    @endif
@endforeach
<script src="{{ asset('js/jquery.js') }}"></script>
<script>
    $(document).ready(function(){
        window.print();
        window.onafterprint = function(event) {
            document.location.href = '{{ route('admin.ticket.ticketing') }}?schid={{$ticket->schedule_id}}&bkd={{ date('Y-m-d', strtotime($ticket->booking_for)) }}';
        }
    })

</script>
</body>

</html>
