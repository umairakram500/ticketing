@extends('admin.layouts.app')
@section('title', 'Boarding Form')
@section('content')
    <div class="bg-white pt-5 pb-5 pl-3 pr-3">
            @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {!! Form::model($boarding, ['route' => ['admin.boarding.update', $boarding->id], 'method' => 'PUT']) !!}
        <?php 
            //print_r($boarding->routes->title); exit;
        ?>
        @include('admin.board.fieldsedit')
        {!! Form::close() !!}
    </div>
@endsection