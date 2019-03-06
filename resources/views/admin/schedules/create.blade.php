@extends('admin.layouts.app')

@section('title', 'Schedule')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row gutter">
        <div class="col-sm-12 col-xs-12">

            <div class="panel">
                <div class="panel-body pb-0">

                    {!! Form::open(['route' => 'admin.schedules.store']) !!}

                    @include('admin.schedules.fields')

                    {!! Form::close() !!}

                </div>
            </div>
            <!-- End:Panel -->
        </div>
    </div>


@endsection

