<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="{{ config('app.charset') }}">
    <meta name="viewport" content="{{ __('width=device-width, initial-scale=1') }}">
    <!-- favicon -->
    <link rel="icon" href="{{ asset(config('app.icon')) }}">
    <meta name="csrf-token">
    <title>{{ __('MAAN|LMS') }}</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ asset('public/admin/fonts/google-font-sans-pro.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('public/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons 2.0.1 -->
    <link rel="stylesheet" href="{{ asset('public/admin/fonts/docs/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/admin/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/admin/css/maan-custom.css') }}">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{ asset(config('app.icon')) }}" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    @include('maanuser.partials.header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('maanuser.partials.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <!-- CSS. Contains page content -->
    @yield('css_content')
    <!-- Main. Contains page content -->
    @yield('main_content')
    <!-- JS. Contains page content -->
    @yield('js_content')

    <!-- /.content-wrapper -->
    @include('maanuser.partials.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('public/admin/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/admin/dist/js/demo.js') }}"></script>

</body>
</html>
