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
    <style>
        .let_spc {
            letter-spacing: 0.4px !important;
        }
        @media (min-width:992px) {
            .section-content-center{
                max-width: 983px;
                margin: 0 auto;
            }
        }
    </style>
</head>
<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

<body class="bg-white-100 font-sans antialiased">
    @include('includes.changelog_header')
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
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-alert type="error" :message="$errors->first()" />
        @endforeach
    @endif
    <section class="section-content-center py-4">
        <div class="text-left mb-3">
            
            <h2 class="text-2xl font-bold mt-4 mb-1 let_spc">Update Password</h2>
            <p class="text-gray-500 text-base">
                Enter a new password to secure your account. Once updated, you’ll be logged out and will need to log in again with your new password.
            </p>
        </div>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <div class="card bg-white mb-3">
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <input type="hidden" name="email" value="{{ $request->email }}">
                <div x-data="{ password: '', confirm: '' }">
                    <!-- Password -->
                    <div class="">
                        <label for="password" class="input-label mb-1 fw-sm">
                            New Password
                            <span class="tooltip-icon " data-bs-toggle="tooltip" title="Add new password">
                                <i class="fa fa-question-circle hover-blue"></i>
                            </span>
                        </label>
                        <x-text-input 
                            id="password" 
                            class="block mt-1 w-full" 
                            type="password" 
                            name="password" 
                            x-model="password"
                            required 
                            autocomplete="new-password" 
                        />
                        <!-- <x-input-error :messages="$errors->first('password')" class="mt-2" /> -->
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-3">
                        <label for="password_confirmation" class="input-label mb-1 fw-sm">
                            Confirm New Password
                            <span class="tooltip-icon " data-bs-toggle="tooltip" title="Confirm new password">
                                <i class="fa fa-question-circle hover-blue"></i>
                            </span>
                        </label>
                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password"
                                            x-model="confirm"
                                            name="password_confirmation" required autocomplete="new-password" />
                        <!-- <x-input-error :messages="$errors->first('password_confirmation')" class="mt-2" /> -->
                    </div>

                    <!-- Password Requirements -->
                    <ul class="mt-4 text-sm text-gray-500 space-y-1">
                        <li class="flex items-center" :class="password.length >= 8 ? 'text-green-500' : 'text-gray-500'">
                            <i class="fa-regular fa-circle-check mr-2" :class="password.length >= 8 ? 'text-green-500' : 'text-gray-500'"></i> Minimum 8 Characters
                        </li>
                        <li class="flex items-center" :class="/[A-Z]/.test(password) ? 'text-green-500' : 'text-gray-500'">
                            <i class="fa-regular fa-circle-check mr-2" :class="/[A-Z]/.test(password) ? 'text-green-500' : 'text-gray-500'"></i> At least one uppercase letter
                        </li>
                        <li class="flex items-center" :class="/[\W_]/.test(password) ? 'text-green-500' : 'text-gray-500'">
                            <i class="fa-regular fa-circle-check mr-2" :class="/[\W_]/.test(password) ? 'text-green-500' : 'text-gray-500'"></i> At least one special character
                        </li>
                        <li class="flex items-center" :class="/[0-9]/.test(password) ? 'text-green-500' : 'text-gray-500'">
                            <i class="fa-regular fa-circle-check mr-2" :class="/[0-9]/.test(password) ? 'text-green-500' : 'text-gray-500'"></i> At least one number
                        </li>
                        <li class="flex items-center" :class="password && password === confirm ? 'text-green-500' : 'text-gray-500'">
                            <i class="fa-regular fa-circle-check mr-2" :class="password && password === confirm ? 'text-green-500' : 'text-gray-500'"></i>
                            Passwords match
                        </li>
                    </ul>
                </div>
                <div class="flex items-center mt-3">
                    <x-primary-button class="text-sm">
                        {{ __('Update Password') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </section> 
</body>
</html>