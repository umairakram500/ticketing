@extends('admin.layouts.app')

@section('title', 'Cargo')
@section('sub-title', 'List of cargo collections')

@section('content')

    <div class="row gutter">

        <div class="panel panel-green">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped no-margin">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>barcode</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Shipment Status</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($list as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->senderCity->name }}</td>
                                <td>{{ $item->receiverCity->name }}</td>
                                <td>{{ $item->shipmentStatus->title }}</td>
                                <td>
                                    <a href="{{ route('admin.cargo.show', $item->id) }}" class="btn btn-info btn-sm delete"><span class="fa fa-arrow-right" title="Details" data-toggle="tooltip"></span></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No recode found!</td>
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
    <a href="{{ route('admin.cargo.create') }}" class="btn btn-success"><i class="icon-plus"></i>add Cargo</a>
</li>
@endpush

