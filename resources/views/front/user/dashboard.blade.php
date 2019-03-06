@extends('front.layout.master')

@section('content')

    <div class="container">
        <div class="row">
            @include('front.includes.userleft')
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12 pt-3">
                        <div class="custom-heading part-heading three-slashes">
                            <h2>User Dashboard</h2>
                        </div>
                        <div class="form-group">
                            <strong for="name">Name: </strong> {{ Auth::user()->name }}
                        </div>
                        <div class="form-group">
                            <strong for="email">Email: </strong> {{ Auth::user()->email }}
                        </div>

                        <div class="row">
                            <section class="service-icon-list service-menu">
                                <div class="col-md-4">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="type">
                                                    <i class="fa fa-fighter-jet"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <h3>LOGISTIC SERVICE</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="active col-md-4">
                                    <div class="content">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="type">
                                                    <i class="fa fa-truck"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <h3>GROUND TRANSPORT</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </section>
                            <div class="col-md-4">
                                <div class="p-4 border rounded bg-dark">
                                    Tickets:  {{ Auth::user()->tickets()->count() }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection