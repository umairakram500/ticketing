@extends('admin.layouts.app')

@section('title', 'Update Route')
@section('sub-title', 'Route Management')
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

                    {!! Form::model($route, ['route' => ['admin.route.update', $route->id], 'method' => 'PUT']) !!}
                    @include('admin.route.fields')
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection

@push('buttons')


@endpush
