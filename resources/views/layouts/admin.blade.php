<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/app.min.css') }}">
    <script src="{{ asset('assets/admin/js/config.min.js') }}"></script>
</head>
<body class="@if(Route::is('admin.login')) authentication-bg @endif">
    <div class="wrapper">
        @if (!Request::is('backoffice/login'))
            @include('admin.partials.header')
            @include('admin.partials.sidebar')
        @endif

        <main class="page-content">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('assets/admin/js/script.js') }}"></script>
    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    
  

</body>
</html>
