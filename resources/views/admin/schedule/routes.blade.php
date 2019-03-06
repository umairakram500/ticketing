@extends('admin.layouts.app')

@section('title', 'Route Schedule')

@section('content')

    <div class="row gutter">

        @foreach($list as $item)
        <div class="col-md-4 col-sm-4 col-xs-12">
            <a href="{{ route('admin.schedule.route.buses', $item->id) }}" class="project-block transparent-bdr">
                <h5 class="project-name">{{ $item->title }}</h5>
                <p class="project-type float-left">Total Buses: <strong class="text-success">{{ $item->buses->count() }}</strong> </p>
                <p class="project-type float-right">Schedule: <strong class="text-success">{{ $item->buses->count() }}</strong> </p>
                <div class="clearfix"></div>
                <ul class="project-time clearfix">
                    <li>
                        <h3>100</h3>
                        <p>Departured</p>
                    </li>
                    <li>
                        <h3>0</h3>
                        <p>In Que</p>
                    </li>
                </ul>
            </a>
        </div>
        @endforeach

    </div>

@endsection

