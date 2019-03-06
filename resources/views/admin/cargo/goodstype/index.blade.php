@extends('admin.layouts.app')

@section('title', 'Goods Types')
@section('sub-title', 'List of Cargo Goods Types')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger alert-transparent">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon-cross2"></i> <strong>Solve Following error</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row gutter">

        <div class="panel panel-green">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped no-margin">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($list as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->status?'Active':'Deactive' }}</td>
                                <td>
                                    <!-- Delete -->
                                    <button data-delete="{{ route('admin.cargo.goodstype.destroy', $item->id) }}" class="btn btn-danger btn-sm delete"><span class="icon-trashcan"></span></button>
                                    <!-- Edit -->
                                    <button data-edit="{{ route('admin.cargo.goodstype.edit', $item->id) }}" class="btn btn-info btn-sm"><span class="icon-pencil2"></span></button>
                                    <!-- Change Status -->
                                    <button data-status="{{ route('admin.cargo.goodstype.status', $item->id) }}" title="{{ !$item->status?'Activate':'Deactivate' }}" class="btn btn-info btn-sm delete"><span class="icon-cycle"></span></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">1</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>


    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Goods Type</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['route' => 'admin.cargo.goodstype.store']) }}
                    {{ Form::hidden('id', null, ['id' => 'titleid']) }}
                    <div class="form-group">
                        <lable>Title</lable>
                        {{ Form::text('title', null, ['class' => 'form-control', 'id' => 'title'])}}
                    </div>
                    <div class="row guttor">
                        <div class="col-xs-6">
                            <button type="button" data-dismiss="modal" class="btn btn-primary btn-block">Cancel</button>
                        </div>
                        <div class="col-xs-6">
                            <button class="btn btn-success btn-block">Save</button>
                        </div>
                    </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
    <!-- End:Modal -->


@endsection

@push('buttons')
<li>
    <a data-toggle="modal" data-target="#myModal" class="btn btn-success"><i class="icon-plus"></i>add new</a>
</li>
@endpush

@push('after-js')

<script>
    $(document).ready(function(){
        $("[data-edit]").click(function(){
            const route = $(this).data('edit');
            //const token = $('meta[name="csrf-token"]').attr('content');
            console.log(route);
            $.ajax({
                url:route,
                type: 'GET',
                success:function(result)
                {
                    $('#title').val(result.title);
                    $('#titleid').val(result.id);
                    $("#myModal").modal("show");
                }
            });
        });
    });
</script>

@endpush


