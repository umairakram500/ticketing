<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', env('APP_NAME'))</title>
    <meta name="description" content="@yield('meta_description', 'eTicketing')">
    <meta name="author" content="@yield('meta_author', 'Invictus Solution')">
    <link rel="shortcut icon" href="{{ asset('img/fav.png') }}">
    @yield('meta')

    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    @stack('before-styles')

    @include('admin.includes.css')

    @stack('after-styles')

</head>

<body>

<!-- Header starts -->
@include('admin.includes.topbar')
<!-- Header ends -->

<!-- Left sidebar start -->
@include('admin.includes.sidebar')
<!-- Left sidebar end -->

<!-- Dashboard Wrapper Start -->
<div class="dashboard-wrapper dashboard-wrapper-lg">

    <!-- Container fluid Starts -->
    <div class="container-fluid">




