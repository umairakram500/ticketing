@extends('admin.layouts.app')

@section('title', 'Users')
@section('sub-title', 'List of users in the system')

@section('content')

    <div class="row gutter">

        <div class="panel panel-green">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped no-margin">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>Terminal</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $key => $user)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->city->name ?? '-' }}</td>
                                <td>{{ $user->terminal->title ?? '' }}</td>
                                <td>
                                    <button data-delete="{{ route('admin.users.destroy', $user->id) }}" class="btn btn-danger btn-sm delete"><span class="icon-trashcan"></span></button>
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info btn-sm delete"><span class="icon-pencil2"></span></a>
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

@push('buttons')
<li>
    <a href="{{ route('admin.users.create') }}" class="btn btn-success"><i class="icon-plus"></i>Add User</a>
</li>
@endpush

