@extends('admin.layouts.app')

@section('title', 'Fares')

@section('content')

    <div class="row gutter">

        <div class="panel panel-green">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped no-margin">
                        <thead>
                        <tr>
                            <th width="20">#</th>
                            <th>Name</th>
                            <th width="50"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($routes as $key => $route)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $route->title }}</td>
                                <td>
                                    <a href="{{ route('admin.fares.edit', $route->id) }}" class="btn btn-info btn-sm delete"><span class="icon-pencil2"></span></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No recode found!</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

@endsection



