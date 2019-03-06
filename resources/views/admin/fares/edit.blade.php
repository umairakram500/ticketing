@extends('admin.layouts.app')

@section('title', 'Fares')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row gutter">
        <div class="col-xs-12">
            <div class="panel">
                <div class="panel-body">

                    <h1>{{ $route->title }}</h1>

                    {!! Form::open(['route' => ['admin.fares.update', $route->id]]) !!}

                    @forelse($bus_types as $bid => $bname)
                        <div class="mb-5">
                            <div class="mark p-3 px-4">
                                {{ $bname }}
                            </div>
                            <table class="table table-striped table-bordered ">
                                <thead>
                                    <tr>
                                        <th>From</th>
                                        <th>To</th>
                                        <th width="150">Fare</th>
                                        <th width="150">KM's</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($combiations as $k => $com)
                                        <?php
                                        //$fare_id = "route_id,'-',luxury_id,'-',from_terminal_id,'-',to_terminal_id";
                                        $fare_id = $route->id.'-'.$bid.'-'.$com[0].'-'.$com[1];
                                        ?>
                                        <tr>
                                            <td>
                                                {{ $terminals[$com[0]] }}
                                                <input type="hidden" name="stops[{{$bid}}][{{$k}}][from]" value="{{ $com[0] }}">
                                            </td>
                                            <td>
                                                {{ $terminals[$com[1]] }}
                                                <input type="hidden" name="stops[{{$bid}}][{{$k}}][to]" value="{{ $com[1] }}">
                                            </td>
                                            <td><input type="number" name="stops[{{$bid}}][{{$k}}][fare]" class="form-control" value="{{ $fares[$fare_id] ?? '' }}"></td>
                                            <td><input type="number" step="0.01" name="stops[{{$bid}}][{{$k}}][kms]" class="form-control" value="{{ $kms[$fare_id] ?? '' }}"></td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @empty
                    @endforelse

                    <div class="row gutter">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group clearfix">
                                {{ Form::submit( 'Save', ['class' => 'btn btn-success btn-block py-3']) }}
                            </div><!--form-group-->
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group clearfix">
                                <a href="{{ route('admin.route.index') }}" class="btn btn-default btn-block py-3">Cancel</a>
                            </div><!--form-group-->
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </div>


@endsection

