@extends('admin.layouts.app')

@section('title', 'Update Bus')

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
        <div class="col-xs-12">
            <div class="panel">
                <div class="panel-body">

                    {!! Form::model($bus, ['route' => ['admin.bus.update', $bus->id], 'method' => 'PUT']) !!}

                    @include('admin.bus.fields')

                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </div>


@endsection

