<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Departure Voucher</title>
    <style>
        body {
            font-size: 12px;
            max-width: 300px;
        }
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
<center><h3>NEW KHAN</h3></center>
<div>ID# <strong>{{ $boarding->id }}</strong></div>
<div>Terminal Name: {{ Auth::user()->terminal->title }}</div>
<div>Route: {{ $boarding->route->title }}</div>
<div>Closed By: {{ Auth::user()->name }}</div>
<div>Bus: <strong>{{ $boarding->bus->title }}</strong></div>
<div>Dep Time: <strong>{{ date('H:i d/m/Y', strtotime($boarding->created_at)) }}</strong></div>
<div>Driver: {{ $boarding->driver->name }}</div>
<div>Conductor: {{ $boarding->conductor->name }}</div>
<br>
<table>
    <thead>
    <tr>
        <th colspan="5">Ticketing</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td>Seats</td>
            <td>Fare</td>
            <td>Desitnation</td>
            <td>Seat No</td>
        </tr>
        <tr>
            <td colspan="5">{{ $boarding->terminal->title }}</td>
        </tr>
        @forelse($ticketStops as $ticket)
        <tr>
            <td></td>
            <td>{{ $ticket->total_seats }}</td>
            <td>{{ $ticket->total_fare }}</td>
            <td>{{ $ticket->toStop->title }}</td>
            <td>{{ str_replace(',', ', ', $ticket->seat_numbers) }}</td>
        </tr>
        @empty
        @endforelse
        
        <tr>
            <td>Totla</td>
            <td>{{ $ticketStops->sum('total_seats') }}</td>
            <td>{{ $ticketStops->sum('total_fare') }}</td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
<br/>
<?php $expenses = \App\Models\ExpenseType::where([
        ['terminal_deduct', 1],
        ['status', 1]
])->get() ?>
<table>
    <thead>
        <tr>
            <th colspan="{{ $expenses->count() }}">Deduction Summary</th>
        </tr>
        <tr>
            @forelse($expenses as $expense)
                <td>{{ $expense->title }}</td>
            @empty
            @endforelse
        </tr>
    </thead>
    <tbody>
    <thead>
        <tr>
            @forelse($expenses as $expense)
                <td>{{ $explist[$expense->id] }}</td>
            @empty
            @endforelse
        </tr>
    </tbody>
</table>
<br />
<table>
    <thead>
    <tr>
        <th colspan="5">Voucher Cash Summary</th>
    </tr>
    <tr>
        <td>Total Seats</td>
        <td>Total Sale</td>
        <td>Discount</td>
        <td>Terminal Exp</td>
        <td>Cash Paid</td>
    </tr>
    </thead>
    <tbody>
    <thead>
    <tr>
        <td>{{ $boarding->total_passenger }}</td>
        <td>{{ $boarding->total_fare }}</td>
        <td>{{ $boarding->total_discount }}</td>
        <td>{{ $boarding->total_exp }}</td>
        <td>{{ $boarding->netcash }}</td>
    </tr>
    </tbody>
</table>




</body>
</html>