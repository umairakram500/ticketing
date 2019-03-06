@extends('admin.layouts.app')

@section('title', 'Stopovers')
@section('sub-title', 'Stopovers of route ('.$route->title.')')

@section('content')

    <div class="row gutter">

        <div class="panel panel-green">
            <div class="panel-body">

                <div class="table-responsive">
                    {{ Form::open(['route' => ['admin.route.stopover.store', $route->id]]) }}
                    <table class="table table-striped no-margin" data-datatable>
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>From</th>
                            <th>To</th>
                            <th style="width: 100px">KMs</th>
                            <th width="100">Fare</th>
                            <th width="100">Time</th>
                            {{--<th>action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($stopovers as $i => $stop)
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $stop->from_stop->title }}</td>
                                <td>{{ $stop->to_stop->title }}</td>
                                <td>{{ $stop->kms }}</td>
                                <td>{{ $stop->fare }}</td>
                                <td>{{ $stop->time }}</td>
                                {{--<td>
                                    <button data-delete="{{ route('admin.city.destroy', $item->id) }}" class="btn btn-danger btn-sm delete"><span class="icon-trashcan"></span></button>
                                    <a href="{{ route('admin.city.edit', $item->id) }}" class="btn btn-info btn-sm delete"><span class="icon-pencil2"></span></a>
                                    <button data-status="{{ route('admin.city.status', $item->id) }}" title="{{ !$item->status?'Activate':'Deactivate' }}" class="btn btn-info btn-sm delete"><span class="icon-cycle"></span></button>
                                </td>--}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center p-5">
                                    No Stopover added yet
                                    <div class="clearfix p-3"></div>
                                    <a href="{{ route('admin.route.stopover.create', $route->id) }}"
                                       class="btn btn-info">Add Stopover</a>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    <style>
        table.table input {
            max-width: 100px;
        }
    </style>
@endsection


@push('buttons')

<li>
    <a href="{{ route('admin.route.edit', $route->id) }}" class="btn btn-info"><span class="fa
    fa-road"></span>Goto Route</a>
</li>

{{--<li>
    <a href="#" class="btn btn-success"><span class="fa fa-plus-circle"></span>Schedules</a>
</li>--}}

<li>
    <a href="{{ route('admin.route.stopover.create', $route->id) }}" class="btn btn-success"><span class="fa fa-edit"></span>Edit Stopovers</a>
</li>

@endpush

@push('after-js')

<script>
    /*$(document).ready(function(){
        $('table.table').DataTable({
            ordering:  false
        });
    })*/
</script>

@endpush



