@extends('front.layout.master')

@push('css')

@endpush
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="p-5 text-center">
                    <h3 class="my-4">Congratulations! - Your booking has completed successfully.</h3>
                    <p>Please note that this booking will only be valid for <strong class="text-danger">30</strong> minutes after which it will be automatically canceled.<br>
                        Your booking number is <strong class="text-danger">{{ $ticket_id }}</strong></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="panel">
                    <div class="panel-heding"><h4>Terminal Info</h4></div>
                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Contact Person</th>
                                <td>Hameed Ahmad</td>
                            </tr>
                            <tr>
                                <th>Mobile</th>
                                <td>03018645412</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>041-8527536</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>Bund Road Block J, Gulshan-e-Ravi Lahore.</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <img src="{{ asset('img/map.jpg') }}" class="img-responsive border rounded" alt="">
            </div>
        </div>
    </div>

@endsection

@push('js')

@endpush
