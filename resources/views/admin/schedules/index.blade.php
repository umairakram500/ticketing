@extends('admin.layouts.app')

@section('title', 'Schedules')
<?php
$scheduleType = array(
        1 => 'Permanent',
        2 => "Range",
        3 => 'Specific Date',
        4 => 'Drop'
);
?>
@section('content')

    <div class="row gutter">

        <div class="panel panel-green">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped no-margin">
                        <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Depart Time</th>
                            <th>Schedule Type</th>
                            <th>Route</th>
                            <th>Bus Type</th>
                            <th width="100">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($schedules as $key => $schedule)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $schedule->depart_time }}</td>
                                <td>{{ $scheduleType[$schedule->type] }}</td>
                                <td>{{ $schedule->route->title ?? '' }}</td>
                                <td>{{ $schedule->luxuryType->title ?? '' }}</td>
                                <td>
                                    <button data-delete="{{ route('admin.schedules.destroy', $schedule->id) }}" class="btn btn-danger btn-sm delete"><span class="icon-trashcan"></span></button>
                                    <a href="{{ route('admin.schedules.edit', $schedule->id) }}" class="btn btn-info btn-sm delete"><span class="icon-pencil2"></span></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No recode found!</td>
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
    <a href="{{ route('admin.schedules.create') }}" class="btn btn-success"><i class="icon-plus"></i>Add Schedule</a>
</li>
@endpush

