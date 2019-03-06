@extends('admin.layouts.app')

@section('title', 'Buses')
@section('sub-title', 'List of buses')

@section('content')

    <div class="row gutter">

        <div class="panel panel-green">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped no-margin" data-datatable>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Route</th>
                            <th>Terminal</th>
                            <th>Seats</th>
                            <th>Number</th>
                            <th>Driver</th>
                            <th>Conductor</th>
                            <th>Status</th>
                            <th width="120">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($list as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->route->title ?? '' }}</td>
                                <td>{{ $item->terminal->title }}</td>
                                <td>{{ $item->seats }}</td>
                                <td>{{ $item->number }}</td>
                                <td>{{ $item->driver->name ?? '' }}</td>
                                <td>{{ $item->conductor->name ?? '' }}</td>
                                <td>{{ $item->status?'Active':'Deactive' }}</td>
                                <td>
                                    <button data-delete="{{ route('admin.bus.destroy', $item->id) }}" class="btn btn-danger btn-sm delete"><span class="icon-trashcan"></span></button>
                                    <a href="{{ route('admin.bus.edit', $item->id) }}" class="btn btn-info btn-sm delete"><span class="icon-pencil2"></span></a>
                                    <button data-status="{{ route('admin.bus.status', $item->id) }}" title="{{ !$item->status?'Activate':'Deactivate' }}" class="btn btn-info btn-sm delete"><span class="icon-cycle"></span></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">No recode found!</td>
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
    <a href="{{ route('admin.bus.create') }}" class="btn btn-success"><i class="icon-plus"></i>add Bus</a>
</li>
@endpush

