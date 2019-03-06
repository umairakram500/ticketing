<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daily Income & Expenditure Report</title>
    <style>
        * { box-sizing: border-box }
        body {
            font-size: 12px;
        }
        td, th {
            border: 1px solid #d5d5d5;
            padding: 3px 5px;
        }
        th { text-align: left }
        table {
            border-collapse: collapse;
            max-width: 100%;
            width: 100%;
        }
        h3.title {
            background: #d5d5d5;
            padding: 6px;
            margin: 12px 0 0 0;
        }
        .w50{
            width: 50%;
            float: left;
            padding:0 10px;
        }
        .w100 {
            padding:0 10px;
        }

        @media print{
            * { box-sizing: border-box }
            body {
                font-size: 12px;
            }
            td, th {
                border: 1px solid #d5d5d5;
                padding: 3px 5px;
            }
            th { text-align: left }
            table {
                border-collapse: collapse;
                max-width: 100%;
                width: 100%;
            }
            h3.title {
                background: #d5d5d5;
                padding: 6px;
                margin: 12px 0 0 0;
            }
            .w50{
                width: 50%;
                float: left;
                padding:0 10px;
            }
            .w100 {
                padding:0 10px;
            }
        }
    </style>
</head>
<body>
    <center>
        <h1>New Khan Road Runners (PVT) LIMINTED</h1>
        <h2>Daily Income & Expenditure Report</h2>
    </center>
    <div class="w100">
        <table>
            <tr>
                <th>VID#</th>
                <td>{{ $voucher->id }}</td>
                <th>Bus#</th>
                <td>{{ $voucher->bus->number }}</td>
                <th>Date</th>
                <td>{{ date('d-m-Y', strtotime($voucher->created_at)) }}</td>
                <th>Time</th>
                <td>{{ date('h:i A', strtotime($voucher->created_at)) }}</td>
                <th>Distance</th>
                <td>{{ $voucher->kms }}</td>
                <th>Diesel Ltr</th>
                <td>{{ $voucher->diesel }}</td>
            </tr>
            <tr>
                <th>Driver</th>
                <td colspan="4">{{ $voucher->driver->name ?? '' }}</td>
                <th>Conductor</th>
                <td colspan="6">{{ $voucher->conductor->name ?? '' }}</td>
                {{--<td>Avg KM</td>
                <td>0.00</td>--}}
            </tr>
        </table>
        <h3 class="title">Depart Vouchers</h3>
        <table>
        <thead>
            <tr>
                <th>DepartID</th>
                <th>Route</th>
                <th>Terminal Name</th>
                <th width="70">Time</th>
                <th width="80">Date</th>
                <th>PSGs</th>
                <th>T.Income</th>
                <th>En.PSGs</th>
                <th>En.Income</th>
                <th>Cargo</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($voucher->boardings as $boarding)
            <tr>
                <th>{{ $boarding->id }}</th>
                <th>{{ $boarding->route->title ?? '' }}</th>
                <td>{{ $boarding->terminal->title ?? '' }}</td>
                <td>{{ date('h:i A', strtotime($boarding->created_at)) }}</td>
                <td>{{ date('d-m-Y', strtotime($boarding->created_at)) }}</td>
                <td>{{ $boarding->total_passenger }}</td>
                <td>{{ $boarding->total_fare - $boarding->total_discount }}</td>
                <td>{{ $boarding->en_psgs ?? '-' }}</td>
                <td>{{ $boarding->en_income ?? '-' }}</td>
                <td>{{ $boarding->cargo ?? '-' }}</td>
                <th>{{ $boarding->total_fare + $boarding->en_income + $boarding->cargo - $boarding->total_discount }}</th>
            </tr>
            @empty
            @endforelse
        </tbody>
    </table>
        <h3 class="title">Terminal Expenses Details</h3>
        <table>
            <thead>
            <?php
            $expense_types = \App\Models\ExpenseType::TerminalExp();
                    //dd($expense_types);
            ?>
            <tr>
                <th>DepartID</th>
                <th>Terminal</th>
                @forelse($expense_types as $expid => $exptype)
                <th>{{ $exptype }}</th>
                @empty
                @endforelse
            </tr>
            </thead>
            <tbody>
            @forelse($voucher->boardings as $boarding)
                <?php
                $bordexp = $boarding->expenses->pluck('amount', 'expense_type_id')->toArray();
                   // dd($bordexp);
                ?>
            <tr>
                <th>{{ $boarding->id }}</th>
                <th>{{ $boarding->terminal->title ?? '' }}</th>
                @forelse($bordexp as $tid => $expval)
                    <td>{{ $expval }}</td>
                @empty
                @endforelse
            </tr>
            @empty
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="w50">
        <h3 class="title">Route Expense Details</h3>
        <table>
            <thead>
                <tr>
                    <th>Expense Type</th>
                    <th>Amount</th>
                </tr>
            </thead>
        <tbody>
            @forelse($voucher->routeExps as $routexp)
            <tr>
                <th>{{ $routexp->expense_type->title ?? '' }}</th>
                <td>{{ $routexp->amount }}</td>
            </tr>
            @empty
            @endforelse
        </tbody>
    </table>
    </div>
    <div class="w50">
        <h3 class="title">Summary</h3>
        <table>
            <tbody>
                <tr>
                    <td>Total Income</td>
                    <td>{{ $voucher->income }}</td>
                </tr>
                <tr>
                    <td>Terminals Expenses</td>
                    <td>{{ $voucher->terminal_exps }}</td>
                </tr>
                <tr>
                    <td>Route Expense</td>
                    <td>{{ $voucher->route_exps }}</td>
                </tr>
                <tr>
                    <th>Profit</th>
                    <th>{{ $voucher->income - $voucher->terminal_exps - $voucher->route_exps }}</th>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="clear:both; margin-top: 100px"></div>
    <div class="w50">
        <center>
            <strong>Driver / Conductor Sign</strong>
            <hr></center>
    </div>
    <div class="w50">
        <center>
            <strong>Cashier Sign</strong>
            <hr></center>
    </div>
</body>
</html>