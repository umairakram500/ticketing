@extends('admin.layouts.app')

@section('title', 'Route Expenses')

@section('content')

    <div class="row gutter">

        <div class="panel panel-green">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped no-margin">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Bus</th>
                            {{--<th>Route</th>--}}
                            <th>Income</th>
                            <th>Terminal Exps</th>
                            <th>Route Exps</th>
                            <th>Profit/Loss</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($vouchers as $key => $voucher)
                            <tr>
                                <td>{{ $voucher->id }}</td>
                                <td>{{ $voucher->bus->number ?? '' }}</td>
                                {{--<td>{{ $voucher->route->title ?? '' }}</td>--}}
                                <td>{{ $voucher->income }}</td>
                                <td>{{ $voucher->terminal_exps }}</td>
                                <td>{{ $voucher->route_exps }}</td>
                                <td>{{ $voucher->income - $voucher->terminal_exps - $voucher->terminal_exps - $voucher->route_exps }}</td>
                                <td>
                                    <a href="{{ route('admin.voucher.show', $voucher->id) }}" class="btn btn-primary btn-sm">Print</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No recode found!</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

@endsection


@push('buttons')
<li>
    <a href="{{ route('admin.voucher.create') }}" class="btn btn-success"><i class="icon-plus"></i>add Voucher</a>
</li>
@endpush

