@extends('admin.layouts.app')

@section('title', 'Add City')

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
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="panel">
                <div class="panel-body">

                    {!! Form::open(['route' => 'admin.city.store']) !!}

                    @include('admin.city.fields')

                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </div>


@endsection

