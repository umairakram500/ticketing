@extends('admin.layouts.app')

@section('title', 'Departments')
@section('sub-title', 'List of departments')

@section('content')

    <div class="row gutter">

        <div class="panel panel-green">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped no-margin">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Code</th>
                            <th>Status</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($departments as $key => $department)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $department->title }}</td>
                                <td>{{ $department->code }}</td>
                                <td>{{ $department->status?'Active':'Deactive' }}</td>
                                <td>
                                    <button data-delete="{{ route('admin.department.destroy', $department->id) }}" class="btn btn-danger btn-sm delete"><span class="icon-trashcan"></span></button>
                                    <a href="{{ route('admin.department.edit', $department->id) }}" class="btn btn-info btn-sm delete"><span class="icon-pencil2"></span></a>
                                    <button data-status="{{ route('admin.department.status', $department->id) }}" title="{{ !$department->status?'Activate':'Deactivate' }}" class="btn btn-info btn-sm delete"><span class="icon-cycle"></span></button>
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
    <a href="{{ route('admin.department.create') }}" class="btn btn-success"><i class="icon-plus"></i>add New</a>
</li>
@endpush

