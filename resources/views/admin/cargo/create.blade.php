@extends('admin.layouts.app')

@section('title', 'Cargo')
@section('sub-title', 'Add cargo collection')

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

    {{ Form::open([ 'route' => 'admin.cargo.store' ]) }}
    <div class="row gutter">
        <div class="col-xs-12">

            <div class="custom-tabs">

                <ul class="nav nav-tabs nav-justified" role="tablist">
                    <li class="active"><a data-toggle="tab" class="h5 m-0" href="#sender">Sender Information</a></li>
                    <li><a data-toggle="tab" class="h5 m-0" href="#receiver">Receiver Information</a></li>
                </ul>

                <div class="tab-content">
                    <!-- Sender Information -->
                    <div id="sender" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('s_name')?'has-error':'' }}">
                                    {{ Form::label('s_name', 'Name*') }}
                                    {{ Form::text('s_name', null, ['class' => 'form-control', 'required'])}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('s_cnic')?'has-error':'' }}">
                                    {{ Form::label('s_cnic', 'CNIC*') }}
                                    {{ Form::text('s_cnic', null, ['class' => 'form-control', 'required', 'data-cnic', 'placeholder' => 'XXXX-XXXXXX-X'])}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('s_phone')?'has-error':'' }}">
                                    {{ Form::label('s_phone', 'Phone*') }}
                                    {{ Form::text('s_phone', null, ['class' => 'form-control', 'required', 'data-phone', 'placeholder' => '03xx-xxxxxx'])}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('s_email')?'has-error':'' }}">
                                    {{ Form::label('s_email', 'Email') }}
                                    {{ Form::text('s_email', null, ['class' => 'form-control'])}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('s_address')?'has-error':'' }}">
                                    {{ Form::label('s_address', 'Street Address') }}
                                    {{ Form::text('s_address', null, ['class' => 'form-control'])}}
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- End:Sender Information -->

                    <!-- Receiver Information -->
                    <div id="receiver" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('r_name')?'has-error':'' }}">
                                    {{ Form::label('r_name', 'Name*') }}
                                    {{ Form::text('r_name', null, ['class' => 'form-control', 'required'])}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('r_cnic')?'has-error':'' }}">
                                    {{ Form::label('r_cnic', 'CNIC*') }}
                                    {{ Form::text('r_cnic', null, ['class' => 'form-control', 'required', 'data-cnic', 'placeholder' => 'XXXX-XXXXXX-X'])}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('r_phone')?'has-error':'' }}">
                                    {{ Form::label('r_phone', 'Phone*') }}
                                    {{ Form::text('r_phone', null, ['class' => 'form-control', 'required', 'data-phone', 'placeholder' => '03xx-xxxxxx'])}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('r_email')?'has-error':'' }}">
                                    {{ Form::label('r_email', 'Email') }}
                                    {{ Form::text('r_email', null, ['class' => 'form-control'])}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('r_address')?'has-error':'' }}">
                                    {{ Form::label('r_address', 'Street Address') }}
                                    {{ Form::text('r_address', null, ['class' => 'form-control'])}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('r_city')?'has-error':'' }}">
                                    {{ Form::label('r_city', 'City*') }}
                                    {{ Form::select('r_city', $cities , null, ['class' => 'form-control'])}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('r_terminal')?'has-error':'' }}">
                                    {{ Form::label('r_terminal', 'Terminal*') }}
                                    {{ Form::select('r_terminal', $terminals, null, ['class' => 'form-control'])}}
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- End:Receiver Information -->
                </div>


            </div>


            <h4 class="my-3 text-center">ITEMS</h4>
            <div class="panel mb-5">
                <div class="panel-body pb-0">
                    <div class="table-responsive mb-0">
                        <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" width="50">#</th>
                                <th>Remarks*</th>
                                <th>Category*</th>
                                <th>Goods Type*</th>
                                <th>Packing*</th>
                                <th width="75" class="text-center">QTY*</th>
                                <th width="75" class="text-center">Weight*</th>
                            </tr>
                        </thead>

                        <tbody id="cargo-tiems" class="nob nop">
                            <tr>
                                <td class="text-center">1</td>
                                <td>{{ Form::text("items[0][remarks]", null, ["class" => "form-control"]) }}</td>
                                <td>
                                    {{ Form::select("items[0][category]", $categories, null, ["class" => "form-control"]) }}
                                </td>
                                <td>
                                    {{ Form::select("items[0][goods_type]", $goods_types, null, ["class" => "form-control"]) }}
                                </td>
                                <td>
                                    {{ Form::select("items[0][packing]", $packings, null, ["class" => "form-control"]) }}
                                </td>
                                <td>{{ Form::text("items[0][qty]", null, ["class" => "form-control"]) }}</td>
                                <td>{{ Form::text("items[0][weight]", null, ["class" => "form-control"]) }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center p-0 pt-2" colspan="5">
                                    <span onclick="addRow()" class="fa fa-plus-circle fa-2x"></span>
                                </th>
                                <th class="p-0 {{ $errors->has('qty')?'has-error':'' }}">
                                    {{ Form::text("qty", null, ["class" => "form-control border-0"]) }}
                                </th>
                                <th class="p-0 {{ $errors->has('weight')?'has-error':'' }}">
                                    {{ Form::text("weight", null, ["class" => "form-control border-0"]) }}
                                </th>
                            </tr>
                            <tr>
                                <th colspan="5" class="text-right">Charges</th>
                                <td colspan="2" class="p-0 {{ $errors->has('charges')?'has-error':'' }}">
                                    {{ Form::number("charges", null, ["class" => "form-control border-0", 'placeholder' => 'Enter Amount']) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                </div>
            </div>

            <div class="row gutton">
                <div class="col-xs-6">
                    <a href="{{ route('admin.cargo.index') }}" class="btn btn-block btn-lg btn-primary">CANCEL</a>
                </div>
                <div class="col-xs-6">
                    <button class="btn btn-block btn-lg btn-info">SAVE</button>
                </div>
            </div>

        </div>
    </div>
    {{ Form::close() }}


@endsection


@push('after-js')
<script>
    var row_id = 0;
    function addRow(){
        row_id++;
        var html = '<tr><td class="text-center">1</td><td><input type="text" class="form-control" placeholder="Remarks" name="items[row][remarks]"></td><td>{{ Form::select("items[row][category]", $categories, null, ["class" => "form-control"]) }}</td><td>{{ Form::select("items[row][goods_type]", $goods_types, null, ["class" => "form-control"]) }}</td><td>{{ Form::select("items[row][packing]", $packings, null, ["class" => "form-control"]) }}</td><td><input name="items[row][qty]" type="text" class="form-control"></td><td><input name="items[row][weight]" type="text" class="form-control"></td></tr>';

       // var newHmtl = html.replace('row', row_id);
        $('#cargo-tiems').append(html.replace(/row/g, row_id));

    }
</script>
@endpush

