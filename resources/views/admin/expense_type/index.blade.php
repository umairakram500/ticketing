@extends('admin.layouts.app')

@section('title', 'Expense Types')
@section('sub-title', 'List of Expense Types')

@section('content')

    <div class="row gutter">

        <div class="panel panel-green">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped no-margin text-center" data-datatable>
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Title</th>
                            <th width="80">Amount</th>
                            <th width="150">Terminal Deduct</th>
                            <th width="100">GL A/C</th>
                            <th width="80">Status</th>
                            <th width="140">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($expense_types as $key => $expense_type)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td class="text-left">{{ $expense_type->title }}</td>
                                <td>{{ $expense_type->amount }}</td>
                                <td><span class="fa fa-{{ $expense_type->terminal_deduct?'check':'times' }}"></span></td>
                                <td>{{ $expense_type->refcode }}</td>
                                <td>{{ $expense_type->status?'Active':'Deactive' }}</td>
                                <td>
                                    <button data-delete="{{ route('admin.expense_type.destroy', $expense_type->id) }}" class="btn btn-danger btn-sm delete"><span class="icon-trashcan"></span></button>
                                    <a href="{{ route('admin.expense_type.edit', $expense_type->id) }}" class="btn btn-info btn-sm delete"><span class="icon-pencil2"></span></a>
                                    <button data-status="{{ route('admin.expense_type.status', $expense_type->id) }}" title="{{ !$expense_type->status?'Activate':'Deactivate' }}" class="btn btn-info btn-sm delete"><span class="icon-cycle"></span></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No recode found!</td>
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
    <a href="{{ route('admin.expense_type.create') }}" class="btn btn-success" title="Add Expense Type" data-toggle="tooltip"><i class="icon-plus"></i>Expense Type</a>
</li>
@endpush

