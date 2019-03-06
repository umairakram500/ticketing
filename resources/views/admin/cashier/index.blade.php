@extends('admin.layouts.app')

@section('title', 'Boarding')

@section('content')

    <div class="row gutter">

        <div class="panel panel-green">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped no-margin">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Schedule</th>
                            <th>From City</th>
                            <th>To City</th>
                            <th>Net cash</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($list as $key => $item)


                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->schedule_id }}</td>
                                <td>{{ $item->from_city }}</td>
                                <td>{{ $item->to_city }}</td>
                        
                                <td>{{ $item->netcash }}</td>

                            
                                <td>
                                    <button data-delete="{{ route('admin.boarding.destroy', $item->id) }}" class="btn btn-danger btn-sm delete"><span class="icon-trashcan"></span></button>
                                    <a href="{{ route('admin.boarding.edit', $item->id) }}" class="btn btn-info btn-sm delete"><span class="icon-pencil2"></span></a>
                                    
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
    <a href="{{ route('admin.boarding.create') }}" class="btn btn-success"><i class="icon-plus"></i>add Boarding</a>
</li>
@endpush

