@extends('admin.layouts.app')

@section('title', 'Add Bus')

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

                    {!! Form::open(['route' => 'admin.bus.store']) !!}

                    @include('admin.bus.fields')

                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </div>


@endsection

