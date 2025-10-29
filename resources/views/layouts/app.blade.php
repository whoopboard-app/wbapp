<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'My Project') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/corban-works.css') }}" />

</head>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

<body class="bg-white-100 font-sans antialiased">

<div class="min-h-screen flex flex-col">
    {{-- Top Navbar --}}
    @include('includes.navbar')

    <div class="flex flex-1">
        {{-- Sidebar --}}
{{--
        <div class="{{ isset($disableSidebar) && $disableSidebar ? 'opacity-60 pointer-events-none select-none' : '' }}">
            @include('includes.sidebar')
        </div>
--}}

        {{-- Main Content Area --}}
        <main class="flex-1 p-8 pb-48">
            @yield('content')
        </main>

        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        @if (session('info'))
            <x-alert type="info" :message="session('info')" />
        @endif

        @if (session('warning'))
            <x-alert type="warning" :message="session('warning')" />
        @endif

    </div>
</div>
{{-- Footer --}}
<footer class="bg-white text-center py-2 border-t">
    <p class="text-md font-bold text-gray-600">
        © 2025 <span class="font-bold">InsightHQ</span>. All rights reserved.
    </p>
</footer>
@stack('scripts')
</body>
</html>
