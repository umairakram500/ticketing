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

    <!-- Error CSS -->
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" media="screen">

    <!-- Animate CSS -->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet" media="screen">

    <!-- Ion Icons -->
    <link href="{{ asset('fonts/icomoon/icomoon.css') }}" rel="stylesheet" />
</head>
<body>
{{ Form::open(array('route' => 'admin.login.process')) }}

    <div id="box" class="animated bounceIn">
        <div id="top_header">
            <img src="{{ asset('img/logo1.png') }}" alt="Arise Admin Dashboard Logo" />

            <h5>
                Sign in to access to your<br />
                control panel.
            </h5>
            @if (session('error'))
                <div style="color: red;">
                    {{ session('error') }}
                </div>
            @endif
        </div>
        <div id="inputs">
            <div class="form-block">
                <input type="text" name="email" placeholder="Email">
                <i class="icon-user-check"></i>
            </div>
            <div class="form-block">
                <input type="password" name="password" placeholder="Password">
                <i class="icon-spell-check"></i>
            </div>
            <input type="submit" value="Sign In">
        </div>
        <div id="bottom" class="clearfix">
            {{--<div class="pull-right">
                <label class="switch pull-right">
                    <input type="checkbox" class="switch-input" checked>
                    <span class="switch-label" data-on="Yes" data-off="No"></span>
                    <span class="switch-handle"></span>
                </label>
            </div>--}}
            <div class="pull-right">
                <span class="cb-label">Remember</span>
            </div>
        </div>
    </div>
{{ Form::close() }}
</body>
</html>