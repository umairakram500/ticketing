@extends('admin.layouts.app')

@section('title', 'Stopovers')
@section('sub-title', 'Stopovers of route ('.$route->title.')')

@section('content')

    <div class="row gutter">

        <div class="panel panel-green">
            <div class="panel-body">
                {{ Form::open(['route' => ['admin.route.stopover.store', $route->id], 'id' => 'stopverform']) }}
                <div class="table-responsive">
                    <table class="table table-striped no-margin">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>From</th>
                            <th>To</th>
                            <th width="100">Fare</th>
                            <th style="width: 100px">KMs</th>
                            <th width="100">Time</th>
                            {{--<th>action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @php $i=1; @endphp
                        @forelse($stop_keys as $from)
                            @foreach($stop_keys as $to)
                                @if($from !== $to)
                                    <?php
                                    $fare = null;
                                    $kms = null;
                                    $time = null;

                                    $soid = $route->stopovers()->where([
                                            ['from_stop_id', $from],
                                            ['to_stop_id', $to]
                                    ])->get()->first();

                                    if ($soid) {
                                        $fare = $soid->fare;
                                        $kms = $soid->kms;
                                        $time = $soid->travel_time ? date('H:i', strtotime($soid->travel_time)) : null;
                                    }
                                    ?>
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>
                                            {{ $stops[$from] }}
                                            {{ Form::hidden('stops['.$i.'][from_stop_id]', $from) }}
                                            {{ Form::hidden('stops['.$i.'][to_stop_id]', $to) }}
                                            @if($soid)
                                                {{ Form::hidden('stops['.$i.'][id]', $soid->id) }}
                                            @endif
                                        </td>
                                        <td>{{ $stops[$to] }}</td>
                                        <td>{{ Form::number('stops['.$i.'][fare]', $fare, ['class'=>'form-control', 'placeholder'=>'Fare', 'min' => 1]) }}</td>
                                        <td>{{ Form::number('stops['.$i.'][kms]', $kms, ['class'=>'form-control', 'placeholder'=>'KMs', 'min' => 1]) }}</td>
                                        <td>{{ Form::text('stops['.$i.'][travel_time]', $time, ['class'=>'form-control travel_time', 'placeholder'=>'Time', 'min' => 1, 'readonly']) }}</td>
                                        {{--<td>
                                            <button data-delete="{{ route('admin.city.destroy', $item->id) }}" class="btn btn-danger btn-sm delete"><span class="icon-trashcan"></span></button>
                                            <a href="{{ route('admin.city.edit', $item->id) }}" class="btn btn-info btn-sm delete"><span class="icon-pencil2"></span></a>
                                            <button data-status="{{ route('admin.city.status', $item->id) }}" title="{{ !$item->status?'Activate':'Deactivate' }}" class="btn btn-info btn-sm delete"><span class="icon-cycle"></span></button>
                                        </td>--}}
                                    </tr>
                                    @php $i++ @endphp
                                @endif

                            @endforeach
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No Stop found!</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <button class="btn btn-success btn-success">SAVE Stopovers</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <style>
        table.table input { max-width: 100px; }
        .form-control[readonly].trave_time { background: #fff; }
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
    <a href="javascript:$('#stopverform').submit()" class="btn btn-success"><span class="fa
    fa-check-square-o"></span>Save Stopovers</a>
</li>

@endpush

@push('after-js')

<script>
    $(document).ready(function () {

        $('.travel_time').timepicker({
            controlType: 'select',
            oneLine: true,
            timeFormat: 'HH:mm',
            stepMinute: 5
        })
    })
</script>

@endpush



