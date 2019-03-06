@extends('admin.layouts.app')

@section('title', 'Routes')
@section('sub-title', 'List of Routes')

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
                            <th>From</th>
                            <th>To</th>
                            <th>Fare</th>
                            <th>Travel Time</th>
                            <th>Status</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($list as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->from_city->name }}</td>
                                <td>{{ $item->to_city->name }}</td>
                                <td>{{ $item->fare }}</td>
                                <td>{{ $item->travel_time_display }}</td>
                                <td>{{ $item->status?'Active':'Deactive' }}</td>
                                <td>
                                    <button data-delete="{{ route('admin.route.destroy', $item->id) }}" class="btn btn-danger btn-sm delete"><span class="icon-trashcan"></span></button>
                                    <a href="{{ route('admin.route.edit', $item->id) }}" class="btn btn-info btn-sm delete"><span class="icon-pencil2"></span></a>
                                    <button data-status="{{ route('admin.route.status', $item->id) }}" title="{{ !$item->status?'Activate':'Deactivate' }}" class="btn btn-info btn-sm delete"><span class="icon-cycle"></span></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No recode found!</td>
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
    <a href="{{ route('admin.route.create') }}" class="btn btn-success"><i class="icon-plus"></i>add Route</a>
</li>
@endpush

