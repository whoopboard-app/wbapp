<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'My Project') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans antialiased">

<div class="min-h-screen flex flex-col">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Top Navbar --}}
    @include('includes.navbar')

    <div class="flex flex-1">
        {{-- Sidebar --}}
        @include('includes.sidebar')

        {{-- Main Content Area --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

</div>

</body>
</html>
