@extends('admin.layouts.app')

@section('title', 'User Profile')

@section('content')

    <div class="row gutter">


        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="panel">

                <div class="panel-body">
                    {!! Form::model(auth()->user(), ['route' => 'admin.profile.update']) !!}
                    <div class="form-group">
                        <div class="row gutter">
                            <div class="col-md-12">
                                <label class="control-label">Name</label>
                                {{ Form::text('name', null, [ 'class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row gutter">
                            <div class="col-md-12">
                                <label class="control-label">Email</label>
                                {{ Form::text('email', null, [ 'class' => 'form-control']) }}
                            </div>
                        </div>
                    </div>


                    <div class="form-group no-margin">
                        <div class="row gutter">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success btn-block">Save</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>


    </div>

@endsection

