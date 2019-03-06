@extends('admin.layouts.app')

@section('title', 'Cargo')
@section('sub-title', 'Cargo Details')

@section('content')

    <div class="row guttor">
        <div class="col-md-3 col-xs-6">
            <div class="border text-center py-5 py-1 mb-5 bg-primary rounded">
                <h3 class="mb-2">{{ $cargo->receiverCity->name }}</h3>
                <p>From City</p>
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="border text-center py-5 py-1 mb-5 bg-primary rounded">
                <h3 class="mb-2">{{ $cargo->senderCity->name }}</h3>
                <p>To City</p>
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="border text-center py-5 py-1 mb-5 bg-primary rounded">
                <h3 class="mb-2">{{ $cargo->weight }} <small class="text-white">kg</small></h3>
                <p>Weight</p>
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="border text-center py-5 py-1 mb-5 bg-primary rounded">
                <h3 class="mb-2">{{ $cargo->qty }}</h3>
                <p>Quantity</p>
            </div>
        </div>
    </div>



    <ul class="shipment_steps mb-5 clearfix">
        @foreach($shipments as $shipment)
        <li style="width:{{100/count($shipments)}}%;" class="{{ $shipment->id <= $cargo->shipment_status_id ? 'active' : '' }}">{{ $shipment->title }}</li>
        @endforeach
    </ul>

    {{--<div class="row guttor">
        <div class="col-sm-12">
            <div class="p-5 border bg-primary mb-5 text-center">
                <h1 class="mb-0">this is for status</h1>
            </div>
        </div>
    </div>--}}


    <div class="row guttor">
        <div class="col-xs-12">

            <div class="row guttor">
                <div class="col-md-6 mb-4">
                    <div class="panel">
                        <div class="panel-heading">
                            <h4>Sender Information</h4>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped mb-0">
                                <tr>
                                    <th width="10" class="text-center"><span class="fa fa-user float-center"></span></th>
                                    <td>{{ $cargo->s_name }}</td>
                                    <th width="50">Name</th>
                                </tr>
                                <tr>
                                    <th class="text-center"><span class="fa fa-address-card-o float-center"></span></th>
                                    <td>{{ $cargo->s_cnic }}</td>
                                    <th>CNIC</th>
                                </tr>
                                <tr>
                                    <th class="text-center"><span class="fa fa-phone float-center"></span></th>
                                    <td>{{ $cargo->s_phone }}</td>
                                    <th>Phone</th>
                                </tr>
                                <tr>
                                    <th class="text-center"><span class="fa fa-envelope-o float-center"></span></th>
                                    <td>{{ $cargo->s_email }}</td>
                                    <th>Email</th>
                                </tr>
                                <tr>
                                    <th class="text-center"><span class="fa fa-map-marker float-center"></span></th>
                                    <td>{{ $cargo->s_address }}</td>
                                    <th>Address</th>
                                </tr>
                                <tr>
                                    <th class="text-center"><span class="fa fa-building-o float-center"></span></th>
                                    <td>{{ $cargo->receiverCity->name }}</td>
                                    <th>City</th>
                                </tr>
                                <tr>
                                    <th><span class="fa fa-handshake-o float-center"></span></th>
                                    <td>{{ $cargo->receiverTerminal->title }}</td>
                                    <th>Terminal</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="panel">
                        <div class="panel-heading">
                            <h4>Receiver Information</h4>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped mb-0">
                                <tr>
                                    <th width="10" class="text-center"><span class="fa fa-user float-center"></span></th>
                                    <td>{{ $cargo->r_name }}</td>
                                    <th width="50">Name</th>
                                </tr>
                                <tr>
                                    <th class="text-center"><span class="fa fa-address-card-o float-center"></span></th>
                                    <td>{{ $cargo->r_cnic }}</td>
                                    <th>CNIC</th>
                                </tr>
                                <tr>
                                    <th class="text-center"><span class="fa fa-phone float-center"></span></th>
                                    <td>{{ $cargo->r_phone }}</td>
                                    <th>Phone</th>
                                </tr>
                                <tr>
                                    <th class="text-center"><span class="fa fa-envelope-o float-center"></span></th>
                                    <td>{{ $cargo->r_email }}</td>
                                    <th>Email</th>
                                </tr>
                                <tr>
                                    <th class="text-center"><span class="fa fa-map-marker float-center"></span></th>
                                    <td>{{ $cargo->r_address }}</td>
                                    <th>Address</th>
                                </tr>
                                <tr>
                                    <th class="text-center"><span class="fa fa-building-o float-center"></span></th>
                                    <td>{{ $cargo->receiverCity->name }}</td>
                                    <th>City</th>
                                </tr>
                                <tr>
                                    <th><span class="fa fa-handshake-o float-center"></span></th>
                                    <td>{{ $cargo->receiverTerminal->title }}</td>
                                    <th>Terminal</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row guttor">
                <div class="col-xs-12">
                    <div class="panel mb-5">
                        <div class="panel-heading">
                            <h4>Items</h4>
                        </div>
                        <div class="panel-body pb-0">
                            <div class="table-responsive mb-0">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center" width="50">#</th>
                                            <th>Remarks</th>
                                            <th>Category</th>
                                            <th>Goods Type</th>
                                            <th>Packing</th>
                                            <th width="75" class="text-center">QTY</th>
                                            <th width="75" class="text-center">Weight</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($cargo->items as $item)
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>{{ $item->remarks }}</td>
                                            <td>{{ $item->category->title }}</td>
                                            <td>{{ $item->goodsType->title }}</td>
                                            <td>{{ $item->packingType->title }}</td>
                                            <td class="text-center">{{ $item->qty }}</td>
                                            <td class="text-center">{{ $item->weight }}</tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-right">Total Qty & Weight</td>
                                            <th class="text-center">{{ $cargo->qty }}</th>
                                            <th class="text-center">{{ $cargo->weight }}</th>
                                        </tr>
                                        <tr>
                                            <td colspan="5" class="text-right">Charges</td>
                                            <th colspan="2">{{ $cargo->charges }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <style>
        .shipment_steps {
            counter-reset: step;
        }
        .shipment_steps li {
            list-style-type: none;
            width: 25%;
            float: left;
            font-size: 12px;
            position: relative;
            text-align: center;
            text-transform: uppercase;
            color: #7d7d7d;
        }
        .shipment_steps li:before {
            width: 30px;
            height: 30px;
            content: counter(step);
            counter-increment: step;
            line-height: 30px;
            border: 2px solid #7d7d7d;
            display: block;
            text-align: center;
            margin: 0 auto 10px auto;
            border-radius: 50%;
            background-color: white;
        }
        .shipment_steps li:after {
            width: 100%;
            height: 2px;
            content: '';
            position: absolute;
            background-color: #7d7d7d;
            top: 15px;
            left: -50%;
            z-index: -1;
        }
        .shipment_steps li:first-child:after {
            content: none;
        }
        .shipment_steps li.active {
            color: green;
        }
        .shipment_steps li.active:before {
            border-color: #55b776;
        }
        .shipment_steps li.active + li:after {
            background-color: #55b776;
        }
    </style>
@endsection


@push('buttons')

@endpush

