@extends('admin.layouts.app')

@section('title', 'Add Expense Type')

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

                    {!! Form::open(['route' => 'admin.expense_type.store']) !!}

                    @include('admin.expense_type.fields')

                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </div>


@endsection

