@extends('admin.layouts.app')

@section('title', 'Boarding')

@section('content')

    <div class="row gutter">

        <div class="panel panel-green">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped no-margin">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Schedule</th>
                            <th>Destination</th>
                            <th>Net cash</th>
                            <th>Date/time</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($boardings as $key => $boarding)


                            <tr>
                                <td>{{ $boarding->id }}</td>
                                <td>{{ $boarding->schedule_id }}</td>
                                <td>{{ $boarding->to->title ?? '' }}</td>
                                <td>{{ $boarding->netcash }}</td>
                                <td>{{ $boarding->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.boarding.show', $boarding->id) }}" class="btn btn-primary btn-sm">Print</a>
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


