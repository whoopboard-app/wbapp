<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .theme-align-left,
        .theme-align-center,
        .theme-align-right {
            display: flex;
            width: 100%;
        }

        .theme-align-left {
            justify-content: flex-start;
        }

        .theme-align-center {
            justify-content: center;
        }

        .theme-align-right {
            justify-content: flex-end;
        }

        .custom-container {
            width: 90%;
        }
        .sidebar-menu-title {
            padding: 0 !important;
        }
        .fullscreen-overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 1050;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .fullscreen-image {
            max-width: 90vw;
            max-height: 90vh;
            object-fit: contain;
            transition: transform 0.3s ease-in-out;
            border-radius: 8px;
        }

        body.no-scroll {
            overflow: hidden;
        }
        .sidebar-menu-title a {
            color: #6c757d !important; /* Grey */
            text-decoration: none;
        }

        .sidebar-menu-title a:hover {
            color: #0d6efd; /* Bootstrap blue on hover */
        }
        .reaction-item{
            padding: 10px !important;
            min-height: 80px !important;
        }


    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Theme Page')</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" sizes="32x32" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}" type="image/png">
    <link rel="icon" sizes="16x16" href="{{ asset('assets/img/favicon/favicon-16x16.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">
</head>

<body>
<main>
    <div class="main-conainer d-flex">
        {{-- Sidebar --}}
        @include('includes.theme_sidebar')

        {{-- Sidebar Overlay (for mobile) --}}
        <div class="sidebar-overlay fixed-top w-100 h-100 d-xl-none"></div>

        {{-- Content Area --}}
        <div class="content-area w-100">
            {{-- Header --}}
            @include('includes.theme_header')

            {{-- Page Content --}}
            <div class="theme-align-left">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</main>

{{-- Footer --}}
<footer class="footer">
    <p class="copyright-text text-center mb-0 fw-semibold">
        © 2025 InsightHQ. All rights reserved
    </p>
</footer>
@stack('scripts')
<!-- JS -->
<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/s
