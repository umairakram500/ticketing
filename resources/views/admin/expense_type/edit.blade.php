@extends('admin.layouts.app')

@section('title', 'Edit Expense Type')

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

                    {!! Form::model($expense_type, ['route' => ['admin.expense_type.update', $expense_type->id], 'method' => 'PUT']) !!}

                    @include('admin.expense_type.fields')

                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </div>


@endsection

