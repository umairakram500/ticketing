@extends('admin.layouts.app')

@section('title', 'Update Terminal')

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

                    {!! Form::model($terminal, ['route' => ['admin.terminal.update', $terminal->id], 'method' => 'PUT']) !!}

                    @include('admin.terminal.fields')

                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </div>


@endsection

