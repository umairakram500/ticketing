@extends('admin.layouts.app')

@section('title', 'Cashier Closing Voucher')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row gutter">
        <div class="col-xs-12">
            <div class="panel">
                <div class="panel-body">



                        {!! Form::open(['route' => 'admin.cashier.close.voucher', 'method'=>'get']) !!}
                    <div class="row gutter">
                        <div class="col-sm-4">
                            <div class="form-group">
                                {{ Form::label('date', 'Date *') }}
                                {{ Form::text('date', old('date', $date),  ['class' => 'form-control', 'readonly' , 'data-date']) }}
                            </div><!--form-group-->
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <?php $users = \App\Models\User::all()->pluck('name', 'id'); ?>
                                {{ Form::label('user_id', 'Cashier *') }}
                                {{ Form::select('user_id', $users, old('user_id', $user_id), ['class' => 'form-control', 'placeholder'=> '- Select Cashier -', 'required'])}}
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mt-5">
                                {{ Form::submit('Get Departures', ['class' => 'btn btn-info'])}}
                            </div><!--form-group-->
                        </div>
                    </div>
                        {!! Form::close() !!}

                        @if(isset($boardings))
                        {!! Form::open(['route' => 'admin.cashier.close.print', 'method'=>'get']) !!}
                            {{ Form::hidden('user_id', $user_id) }}
                            {{ Form::hidden('date', $date) }}
                            <div class="row gutter">
                                <div class="col-xs-12">
                                    <div class="p-3 bg-primary">Voucher Details</div>
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

                                </div>
                            </div>

                            <div class="row gutter">
                            <div class="col-sm-6 col-md-offset-3">
                                <div class="form-group clearfix">
                                    {{ Form::submit( 'PRINT REPORT', ['class' => 'btn btn-success btn-block py-3']) }}
                                </div><!--form-group-->
                            </div>
                        </div>
                        {!! Form::close() !!}
                        @endif




                </div>
            </div>
        </div>
    </div>

@endsection

@push('after-js')

<script>
    $(document).ready(function() {

        // add voucher
        $('#addvoucher').click(function(){
            var voucherid = $('#voucherid').val();
            var voucherdate = $('#voucherdate').val();
            var busid = $('#bus_id option:selected').val();

            if(busid === ''){
                alert('Bus not selected');
                $('#addvoucher').focus();
                return false;
            }
            if(voucherid === ''){
                alert('Enter Voucher ID');
                $('#addvoucher').focus();
                return false;
            }

            $.ajax({
                url: '{{ route('admin.departure.getInfo') }}/'+voucherid,
                type: 'get',
                data: { busid: busid },
                success: function(res){
                    if(!res.error){
                        // console.log(res);
                        var board = res.boarding;
                        var bordingrow = '<tr><th>'+board.id+'</th><td>'+board.route.title+'</td><td>'+board.terminal.title+'</td><td>'+board.addeddate+'</td><td>'+board.addedtime+'</td><td>'+board.total_passenger+'</td><td>'+board.total_fare+'</td><td><input class="form-control" name="bord['+board.id+'][enpsg]" value="0"></td><td><input class="form-control" name="bord['+board.id+'][enincome]" value="0"></td><td><input class="form-control" name="bord['+board.id+'][cargo]" value="0"></td></tr>';
                        var expensesrow = '<tr><th>'+board.id+'</th><td>'+board.terminal.title+'</td>';
                        var expes = Object.keys(res.expenses).map(function(expid){
                            console.log(expid);
                            return '<td>'+res.expenses[expid]+'</td>';
                        })
                        expensesrow = expensesrow+expes+'</tr>';

                        $('#bordingrows').append(bordingrow);
                        $('#expensesrows').append(expensesrow);
                        $('#voucherid').val('').focus();

                    } else {
                        alertify.error(res.message);
                    }

                }
            })
        });

    });

</script>

@endpush