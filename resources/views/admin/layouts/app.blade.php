<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', env('APP_NAME'))</title>
    <meta name="description" content="@yield('meta_description', 'eTicketing')">
    <meta name="author" content="@yield('meta_author', 'Invictus Solution')">
    <link rel="shortcut icon" href="img/fav.png">
    @yield('meta')

    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-css')
    @include('admin.includes.css')
    @stack('after-css')

</head>

<body>

<!-- Header starts -->
@include('admin.includes.topbar')
        <!-- Header ends -->

<!-- Left sidebar start -->
@include('admin.includes.sidebar')
        <!-- Left sidebar end -->

<!-- Dashboard Wrapper Start -->
<div class="dashboard-wrapper {{ !isset($_COOKIE['sidebar_sm'])?'dashboard-wrapper-lg':'' }}">

    <!-- Container fluid Starts -->
    <div class="container-fluid">

        <div class="top-bar clearfix">
            <div class="row gutter">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="page-title">
                        <h3>@yield('title')</h3>
                        @if(View::hasSection('sub-title'))
                        <p>@yield('sub-title')</p>
                        @endif
                    </div>
                </div>
                {{--@if(View::hasSection('buttons'))--}}
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <ul class="right-stats" id="mini-nav-right">
                        @stack('buttons')
                    </ul>
                </div>
                {{--@endif--}}

            </div>
        </div>

        @yield('content')

    </div>
    <!-- Container fluid ends -->

</div>
<!-- Dashboard Wrapper End -->

<!-- Footer Start -->
<footer>
    All right reserved. <?=date('Y')?> &copy;
</footer>
<!-- Footer end -->

@stack('before-js')
@include('admin.includes.js')
@stack('after-js')
</body>
</html>