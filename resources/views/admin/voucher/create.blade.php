@extends('admin.layouts.app')

@section('title', 'Daily Income & Expenditure Report')

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

    <?php
    $terminal_exps = \App\Models\ExpenseType::where('terminal_deduct', 1)->Selection();
    $route_exps = \App\Models\ExpenseType::where('terminal_deduct', 0)->Selection();
    ?>

    <div class="row gutter">
        <div class="col-xs-12">
            <div class="panel">
                <div class="panel-body">

                    {!! Form::open(['route' => 'admin.voucher.store']) !!}
                    <div class="row gutter">
                        <div class="col-sm-4">
                            <div class="form-group">
                                {{ Form::label('voucherdate', 'Date *') }}
                                {{ Form::text('voucherdate', Date('Y-m-d'),  ['class' => 'form-control', 'readonly']) }}
                            </div><!--form-group-->
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <?php $buses = \App\Models\Bus\Bus::list(); ?>
                                {{ Form::label('bus_id', 'Bus *') }}
                                {{ Form::select('bus_id', $buses, null,  ['class' => 'form-control', 'placeholder'=> '- Select Bus -'])}}
                            </div><!--form-group-->
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                {{ Form::label('voucherid', 'Add Voucher *') }}
                                <div class="input-group">
                                    {{ Form::text('voucherid',null,  ['class' => 'form-control', 'placeholder'=> 'Voucher ID'])}}
                                    <span class="input-group-addon btn btn-primary bg-dark" id="addvoucher"><i class="m-0 fa fa-plus"></i></span>
                                </div>
                            </div><!--form-group-->
                        </div>
                        <div class="row gutter">
                            <div class="col-xs-12">
                                <div class="p-3 bg-primary">Voucher Details</div>
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <td width="100">VoucherID#</td>
                                        <td>Route</td>
                                        <td>Terminal</td>
                                        <td width="100">Date</td>
                                        <td width="90">Time</td>
                                        <td width="50">PSGs</td>
                                        <td width="50">Income</td>
                                        <td>En.PSGs</td>
                                        <td>En.Income</td>
                                        <td>Cargo</td>
                                        {{--<td>Total</td>--}}
                                    </tr>
                                    </thead>
                                    <tbody id="bordingrows">
                                    </tbody>
                                </table>

                                <div class="p-3 bg-primary">Terminal Expenses Details</div>
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th width="100">VoucherID#</th>
                                        <th>Terminal</th>
                                        @forelse($terminal_exps as $term_exp_id => $term_exp)
                                            <th width="50">{{ $term_exp }}</th>
                                        @empty
                                        @endforelse
                                    </tr>
                                    </thead>
                                    <tbody id="expensesrows">
                                    {{--<tr>
                                        <th>50064</th>
                                        <td>LHR Bus Add</td>
                                        @forelse($terminal_exps as $term_exp_id => $term_exp)
                                            <td>{{ $term_exp_id }}</td>
                                        @empty
                                        @endforelse
                                    </tr>--}}
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row gutter">

                            <div class="col-md-6">
                                <div class="p-3 bg-primary">Route Expenses</div>
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>Expense Type</th>
                                        <th width="200">Amount</th>
                                        <th width="50"></th>
                                    </tr>
                                    </thead>
                                    <tbody id="expeslist">
                                    <tr>
                                        <td>
                                            {{ Form::select('route_exps[1][id]', $route_exps, 8, ['class'=>'form-control', 'placeholder'=>'- Select Expense Type -']) }}
                                        </td>
                                        <td><input type="number" class="form-control" name="route_exps[1][amount]" required></td>
                                        <td><button type="button" class="btn btn-primary" disabled><span class="fa fa-times"></span></button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Form::select('route_exps[2][id]', $route_exps, 9, ['class'=>'form-control', 'placeholder'=>'- Select Expense Type -']) }}
                                        </td>
                                        <td><input type="number" class="form-control" name="route_exps[2][amount]" required></td>
                                        <td><button type="button" class="btn btn-primary" disabled><span class="fa fa-times"></span></button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Form::select('route_exps[3][id]', $route_exps, 22, ['class'=>'form-control', 'placeholder'=>'- Select Expense Type -']) }}
                                        </td>
                                        <td><input type="number" class="form-control" name="route_exps[3][amount]" value="0" required></td>
                                        <td><button type="button" class="btn btn-primary"><span class="fa fa-times"></span></button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Form::select('route_exps[4][id]', $route_exps, 23, ['class'=>'form-control', 'placeholder'=>'- Select Expense Type -']) }}
                                        </td>
                                        <td><input type="number" class="form-control" name="route_exps[4][amount]" value="0" required></td>
                                        <td><button type="button" class="btn btn-primary"><span class="fa fa-times"></span></button></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{ Form::select('route_exps[5][id]', $route_exps, 18, ['class'=>'form-control', 'placeholder'=>'- Select Expense Type -']) }}
                                        </td>
                                        <td><input type="number" class="form-control" name="route_exps[5][amount]" value="0" required></td>
                                        <td><button type="button" class="btn btn-primary"><span class="fa fa-times"></span></button></td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="3">
                                            <button class="btn btn-primary" type="button" id="addexptype">
                                                <span class="fa fa-plus"></span> Add Expense Row</button>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="row gutter">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group clearfix">
                                    {{ Form::submit( 'Save', ['class' => 'btn btn-success btn-block py-3']) }}
                                </div><!--form-group-->
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group clearfix">
                                    <a href="{{ route('admin.route.index') }}" class="btn btn-default btn-block py-3">Cancel</a>
                                </div><!--form-group-->
                            </div>
                        </div>

                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection

@push('after-js')

<script>
    $(document).ready(function() {

        /*$('#voucherdate').datepicker({
            minDate: 0
        })*/

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

        // Add Expense Type
        $('#addexptype').click(function(){
            var rowid = Math.floor(Math.random() * (99999 - 1 + 1)) + 1;
            <?php
            $select_exp = Form::select('route_exps[rowid][id]', $route_exps, null, ['class'=>'form-control', 'placeholder'=>'- Select Expense Type -', 'required'])
            ?>
            var exp_row = '<tr><td>{{ $select_exp }}</select></td><td><input type="number" name="route_exps[rowid][amount]" class="form-control" value="0"></td><td><button class="btn btn-primary re_exp"><span class="fa fa-times"></span></button></td></tr>';

            $('#expeslist').append(exp_row.replace(/rowid/g, rowid));
        });
        $(document).on('click', '.re_exp', function(){
            $(this).parents(':eq(1)').remove();
        })
    });

</script>

@endpush