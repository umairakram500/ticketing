@extends('admin.layouts.app')

@section('title', 'Update User')

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

                    {!! Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PUT', 'enctype'=>'multipart/form-data']) !!}

                    @include('admin.user.fields')

                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </div>


@endsection

