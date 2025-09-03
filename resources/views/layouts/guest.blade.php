<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
         <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <style>
            .pg-top{
    top: -20px !important;
}
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
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
        <div class="flex min-h-screen">
            <!-- Left Column -->
            <div class="basis-[57%] flex flex-col items-center p-6 relative">

                <div class="w-full max-w-md px-6 py-4 bg-white overflow-hidden rounded-lg">
                    {{ $slot }}
                </div>
            </div>

            <!-- Right Column -->
            <div class="basis-[43%] flex flex-col justify-center items-center pt-6 pl-6 bg-[#fbfaf8]">
                <!-- Put your right column content here -->
                <div class="signup-right d-flex flex-column justify-content-between">
                    <div class="testimonial-slider swiper w-full max-w-md mt-4">
                        <div class="swiper-wrapper">
                            <!-- Slide 1 -->
                            <div class="swiper-slide p-4 rounded-lg">
                                <div class="flex justify-start mb-2">
                                    @for ($i = 0; $i < 5; $i++)
                                        <img src="{{ asset('images/star.svg') }}" alt="star" class="w-5 h-5">
                                    @endfor
                                </div>
                                <p class="mb-2 font-bold text-xl">
                                    One of the more comprehensive budgeting apps I've tried. Great for if you share expenses with a partner.
                                </p>
                                <span class="text-gray-600">— David D</span>
                            </div>

                            <!-- Slide 2 -->
                            <div class="swiper-slide p-4 rounded-lg">
                                <div class="flex justify-start mb-2">
                                    @for ($i = 0; $i < 4; $i++)
                                        <img src="{{ asset('images/star.svg') }}" alt="star" class="w-5 h-5">
                                    @endfor
                                </div>
                                <p class="font-bold mb-2 text-xl">
                                    Excellent tool! Helps me track every expense with ease.
                                </p>
                                <span class="text-gray-600">— Sarah K</span>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="testimonial-slider-pagination swiper-pagination pg-top mt-4" ></div>
                    </div>
                    <div class="signup-thumb relative top-[22px]">
                        <img src="{{ asset('images/site-thumb.png') }}" alt="signup thumb" class="w-100">
                    </div>
                </div>
            -</div>
        </div>
    </body>
</html>
