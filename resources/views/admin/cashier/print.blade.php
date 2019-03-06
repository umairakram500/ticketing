<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Departure Voucher</title>
    <style>
        td,  th {
            border: 1px solid;

        }
        table {
            border-collapse: collapse;
            max-width: 100%;
            width: 100%;
        }
    </style>
</head>
<body>
<center>
    <h1>NEW KHAN</h1>
    <p>Cashier Closing Report</p>
</center>

<div>Terminal Name: {{ Auth::user()->terminal->title }}</div>
<div>Date: {{ date('Y-m-d') }}</div>

<br>
<table class="table table-bordered table-hover table-striped">
    <thead>
    <tr>
        <th width="10">VID#</th>
        <th>Route</th>
        <th>Bus</th>
        <th width="100">Date & Time</th>
        <th>From City</th>
        <th>To City</th>
        <th width="50">PSGs</th>
        <th width="50">Income</th>
        <th width="50">Dis.</th>
        <th width="50">Exp.</th>
        <th width="50">Net Total</th>
    </tr>
    </thead>
    <tbody id="bordingrows">
    @forelse($boardings as $boarding)
        <tr>
            <td>{{ $boarding->id }}</td>
            <td>{{ $boarding->route->title ?? '' }}</td>
            <td>{{ $boarding->bus->number ?? '' }}</td>
            <td>{{ date('Y-m-d', strtotime($boarding->created_at)).' '.$boarding->schedule->depart_time }}</td>
            <td>{{ $boarding->from->city->name ?? '' }}</td>
            <td>{{ $boarding->to->city->name ?? '' }}</td>
            <td>{{ $boarding->total_passenger }}</td>
            <td>{{ $boarding->total_fare }}</td>
            <td>{{ $boarding->total_discount }}</td>
            <td>{{ $boarding->total_exp }}</td>
            <td>{{ $boarding->netcash }}</td>
        </tr>
    @empty
    @endforelse
    </tbody>
    @if($boardings != null)
        <tfoot>
        <tr>
            <th colspan="10" class="text-right">Grand Total</th>
            <th>{{ $boardings->sum('netcash') }}</th>
        </tr>
        </tfoot>
    @endif
</table>





</body>
</html>