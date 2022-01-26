<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ env('APP_NAME') }}</title>

    @include('layouts.backend.partials.styles')
    <style>
        .brand_logo img{
            padding: 9px 9px 0 7px;
            max-width: 100%;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed {{ $settings->dark_mode ? 'dark-mode' : '' }}">
    @php
        $user = Auth::user();
    @endphp
    <div class="wrapper">
        <!-- Navbar -->
        <nav id="nav"
            class="main-header navbar navbar-expand {{ $settings->dark_mode ? 'navbar-dark navbar-dark' : 'navbar-white navbar-light' }}"
            style="background-color:{{ $settings->dark_mode ? '' : $settings->nav_color }}">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a id="nav_collapse" class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                @include('layouts.backend.partials.top-right-nav')
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.backend.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    @yield('breadcrumbs')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Main Footer -->
        @include('layouts.backend.partials.footer')
    </div>
    <!-- ./wrapper -->

    @include('layouts.backend.partials.scripts')
</body>

</html>
