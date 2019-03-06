@extends('admin.layouts.app')

@section('title', 'Schedule')
@section('sub-title', 'Voucher not yet added or closed')

@section('content')
    <hr>
    <div class="row gutter">
        @forelse($vouchers as $voucher)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="users-wrapper blue">
                    <div class="users-info clearfix">
                        <div class="users-avatar text-center">
                            <span class="fa fa-bus fa-4x"></span>
                        </div>
                        <div class="users-detail">
                            <h5 class="m-0">{{ $voucher->bus->title ?? '' }} ({{ $voucher->bus->number ?? '' }})</h5>
                            <p>{{ $voucher->route->title }}</p>

                            <p class="float-left">Available Seats: <strong class="text-success">{{ $voucher['avail_seats'] }}</strong>
                            </p>
                            <p class="float-right">Total Seats: <strong
                                        class="text-success">{{ $voucher->bus->seats ?? '' }}</strong></p>
                            <div class="cleatfix"></div>

                            <div class="cleatfix"></div>

                        </div>
                    </div>
                    <ul class="users-footer clearfix">
                        <li>
                            <p class="light">Date</p>
                            <p>{{ date('d M, Y', strtotime($voucher->depart_time)) }}</p>
                        </li>
                        <li>
                            <p class="light">Time</p>
                            <p>{{ date('H:m A', strtotime($voucher->depart_time)) }}</p>
                        </li>
                        <li>
                            <div class="dropdown">
                                <button class="add-btn btn btn-default dropdown-toggle pt-2" type="button" data-toggle="dropdown"><span class="fa fa-ellipsis-v"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('admin.schedule.voucher', $voucher->id) }}" title="arrive" data-status="">Add Voucher</a></li>
                                    <li><a href="javascript:;" title="arrive" data-status="">Close</a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        @empty
            <div class="col-md-12">
                <h3 class="text-muted">No pendding voucher</h3>
            </div>
        @endforelse
    </div>



@endsection

@push('after-js')
<script>

    function saveVoucherNo()
    {
        /*var url = ""
        var data = {voucher_no: $('input[name="voucher_no"]').val()};
        ajaxSave(url, data);*/
    }

</script>
@endpush



