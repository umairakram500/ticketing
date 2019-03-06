@extends('admin.layouts.app')

@section('title', 'Add Terminal')

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

                    {!! Form::open(['route' => 'admin.terminal.store']) !!}

                    @include('admin.terminal.fields')

                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </div>


@endsection

