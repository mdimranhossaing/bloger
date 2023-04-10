<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('admin/dist/img/logo.jpg')}}" type="image/x-icon">
    <title>{{isset($title) ? $title . ' | ' : null}} {{env('APP_NAME')}}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/toastr/toastr.min.css') }}">
    <style>
        .navbar-nav>.user-menu .user-image,
        .navbar-nav>.user-menu>.dropdown-menu>li.user-header>img {
            object-fit: cover;
        }

        .user-panel img {
            height: 2.1rem;
            width: 2.1rem;
            object-fit: cover;
        }

        .error {
            color: #B00020;
            margin-top: -15px;
            margin-bottom: 15px;
        }

        .link-hover {
            background-color: rgba(255, 255, 255, .1);
            color: #fff;
        }
    </style>
    @yield('stylesheet')
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        @include('admin.components.navbar')

        @include('admin.components.sidebar')



        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
