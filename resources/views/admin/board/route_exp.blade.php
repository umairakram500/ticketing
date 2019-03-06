@extends('admin.layouts.app')

@section('title', 'Daily Income & Expenditure Report')

@section('content')

<?php
$terminal_exps = \App\Models\ExpenseType::where('terminal_deduct', 1)->Selection();
$route_exps = \App\Models\ExpenseType::where('terminal_deduct', 0)->Selection();

?>

    <div class="row gutter">
        <div class="col-xs-12">
            <div class="panel">
                <div class="panel-body">

                    <div class="row gutter">
                        <div class="col-sm-4">
                            <div class="form-group">
                                {{ Form::label('voucherdate', 'Date *') }}
                                {{ Form::text('voucherdate', Date('Y-m-d'),  ['class' => 'form-control', 'readonly', 'data-date']) }}
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
                                {{ Form::label('voucher', 'Add Voucher *') }}
                                <div class="input-group">
                                    {{ Form::text('route',null,  ['class' => 'form-control', 'placeholder'=> 'Voucher ID'])}}
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
                                        <td width="130">VoucherID#</td>
                                        <td>Route</td>
                                        <td>Terminal</td>
                                        <td>Date</td>
                                        <td>Time</td>
                                        <td>TotalPSGs</td>
                                        <td>T.Income</td>
                                        <td>En.PSGs</td>
                                        <td>En.Income</td>
                                        <td>Cargo</td>
                                        <td>Total</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>46546</th>
                                        <td>LHR-DI KHAN</td>
                                        <td>LHR Bus Add</td>
                                        <td>2019-03-01</td>
                                        <td>10:30AM</td>
                                        <td>22</td>
                                        <td>8980</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>8980</td>
                                    </tr>

                                </tbody>
                            </table>

                            <div class="p-3 bg-primary">Terminal Expenses Details</div>
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>VoucherID#</th>
                                    <th>Terminal</th>
                                    @forelse($terminal_exps as $term_exp_id => $term_exp)
                                        <th>{{ $term_exp }}</th>
                                    @empty
                                    @endforelse
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>50064</th>
                                        <td>LHR Bus Add</td>
                                        @forelse($terminal_exps as $term_exp_id => $term_exp)
                                            <td>{{ $term_exp_id }}</td>
                                        @empty
                                        @endforelse
                                    </tr>
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
                                            <?php $select_exp = Form::select('route_exps[]', $route_exps, 1, ['class'=>'form-control', 'placeholder'=>'- Select Expense Type -', 'required']); ?>

                                            {{ $select_exp }}
                                        </td>
                                        <td><input type="number" class="form-control"></td>
                                        <td><button class="btn btn-primary" disabled><span class="fa fa-times"></span></button></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3">
                                            <button class="btn btn-primary" id="addexptype">
                                                <span class="fa fa-plus"></span> Add Expense Row</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <div class="p-3 bg-primary">Summary</div>
                            <table class="table table-bordered table-hover table-striped">
                                <tr>
                                    <td>Total Income</td>
                                    <td>89590</td>
                                </tr>
                                <tr>
                                    <td>Total Route Expenses</td>
                                    <td>2540</td>
                                </tr>
                                <tr>
                                    <td>Total Terminal Expenses</td>
                                    <td>3550</td>
                                </tr>
                                <tr>
                                    <td><strong>Net Porfit</strong></td>
                                    <td><strong>830500</strong></td>
                                </tr>
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
            var voucherid = $(this).val();
            var voucherdate = $('#voucherdate').val();
            var busid = $('#bus_id option:selected').val();

            if(busid === ''){
                alert('Enter Voucher ID');
                $('#addvoucher').focus();
                return false;
            }
            if(voucherid === ''){
                alert('Enter Voucher ID');
                $('#addvoucher').focus();
                return false;
            }

            $.ajax({
                url: '{{ route('admin.departure.create') }}}/'+voucherid,
                type: 'get',
                data: { busid: busid },
                success: function(res){
                    console.log(res);
                }
            })
        });

        // Add Expense Type
        $('#addexptype').click(function(){
            var exp_row = '<tr><td>{{ $select_exp }}</select></td><td><input type="number" class="form-control"></td><td><button class="btn btn-primary re_exp"><span class="fa fa-times"></span></button></td></tr>';

            $('#expeslist').append(exp_row);
        });
        $(document).on('click', '.re_exp', function(){
            $(this).parents(':eq(1)').remove();
        })
    });

</script>

@endpush