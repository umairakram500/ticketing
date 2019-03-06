@extends('admin.layouts.app')

@section('title', '')

@section('content')
<div class="my-5 py-5">&nbsp;</div>
        <div class="row my-5">
            <div class="col-md-4 col-md-offset-4 mb-5">
                <a href="{{ route('admin.ticket.ticketing') }}" class="btn btn-block py-3 btn-info"><span class="h4">Issue</span></a>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <a href="{{ route('admin.ticket.booking') }}" class="btn btn-block py-3 btn-info"><span class="h4">book</span></a>
            </div>
        </div>


@endsection

