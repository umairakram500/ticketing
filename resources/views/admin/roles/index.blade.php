@extends('admin.layouts.app')

@section('title', 'Roles')
@section('sub-title', 'List of roles')

@section('content')

    <div class="row gutter">

        <div class="panel panel-green">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped no-margin">
                        <thead>
                            <tr>
                                <th width="50">#</th>
                                <th>Name</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($roles as $key => $role)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <button data-delete="{{ route('admin.roles.destroy', $role->id) }}" class="btn btn-danger btn-sm delete"><span class="icon-trashcan"></span></button>
                                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-info btn-sm delete"><span class="icon-pencil2"></span></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No recode found!</td>
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
    <a href="{{ route('admin.roles.create') }}" class="btn btn-success"><i class="icon-plus"></i>Add Role</a>
</li>
@endpush

