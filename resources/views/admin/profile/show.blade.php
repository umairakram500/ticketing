@extends('admin.layouts.app')

@section('title', 'User Profile')

@section('content')


    <div class="row gutter">
        <div class="col-sm-12 col-xs-12">
            <div class="panel">
                <div class="panel-body">

                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{ auth()->user()->name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ auth()->user()->email }}</td>
                        </tr>
                        <tr>
                            <th>City</th>
                            <td>{{ auth()->user()->city->name }}</td>
                        </tr>
                        {{--<tr>
                            <th>Company</th>
                            <td>{{ auth()->user()->company->title }}</td>
                        </tr>--}}
                        <tr>
                            <th>Terminal</th>
                            <td>{{ auth()->user()->terminal->title }}</td>
                        </tr>
                    </table>

                </div>
            </div>

        </div>
    </div>

@endsection

