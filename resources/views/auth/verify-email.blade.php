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
</head>
<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

<body class="bg-white-100 font-sans antialiased">
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
    <div class="w-full max-w-md mx-auto mt-10 p-6 bg-white h-auto">    
        <div class="text-left mb-2">
            <div class="mb-7 mt-2">
                <a href="/" class="inline-flex items-center">
                    <x-application-logo class="w-20 h-20 fill-current" />
                </a>
            </div>
            
            <h2 class="text-xl fw-bold text-gray-800 mt-6 mb-2 flex items-center gap-2 tracking-tight">
                <span>🔐</span>
                Verify your identity
            </h2>
            <p class="text-gray-500 text-base font-normal tracking-tight">
                {{ __('We’ve sent a one-time passcode (OTP) to your registered email address [email@domain.com]. Enter it below to continue.') }}
            </p>
        </div>

        <div
            x-data="countdownTimer({{ $expiresAt }})"
            x-init="startTimer()"
            class="my-2 text-sm text-gray-600"
        >
            Code expires in:
            <span class="font-semibold text-red-600" x-text="timeLeft"></span>
        </div>

        <form method="POST" action="{{ route('verify.code') }}">
            @csrf
            <div>
                <div class="flex items-center gap-2 mt-4">
                    <x-input-label for="name" :value="__('Verification code')" />
                    <i class="fa-solid fa-circle-question cursor-pointer relative"
                            x-data="{ show: false }"
                            @mouseenter="show = true" 
                            @mouseleave="show = false"
                            :class="show ? 'text-blue-600' : 'text-gray-300'">

                                <!-- Tooltip -->
                                <div x-show="show"
                                    x-transition
                                    class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-black text-white text-sm px-2 py-2 border border-gray-700 rounded-lg shadow-lg z-50 font-sans whitespace-normal inline-block min-w-[200px] max-w-xs font-medium">
                                    Enter the 6-digit code sent to your email.

                                
                                <div class="absolute top-[50] left-1/2 -translate-x-1/2 w-3 h-3 bg-black rotate-45"></div>

                                </div>

                    </i>
                </div>
                <div class="flex justify-between gap-3 mt-3">
                    @for ($i = 0; $i < 6; $i++)
                        <input type="text" maxlength="1" inputmode="numeric" pattern="\d*"
                            required
                            class="w-12 h-12 text-center border border-gray-300 rounded-lg text-lg font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500 otp-input">
                    @endfor
                </div>

                <input type="hidden" id="code" name="code" maxlength="6" required pattern="\d{6}">

                @error('code')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
                <div>
                    <x-primary-button class="w-full justify-center text-sm mt-4">
                        {{ __('Verify & Continue') }}
                    </x-primary-button>
                    
                </div>
            </div>
        </form>
        <div class="mt-3 flex items-center">
            <form method="POST" action="{{ route('verification.send') }}" x-data="{ countdown: 20 }" x-init="setInterval(() => { if(countdown > 0) countdown-- }, 1000)">
                @csrf
                <p class="text-sm text-gray-600">
                    Didn't get the code? 

                    <button 
                        type="submit" 
                        :disabled="countdown > 0"
                        class="underline text-sm rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        :class="countdown > 0 ? 'text-gray-400 cursor-not-allowed' : 'text-blue-600 hover:text-gray-900'"
                    >
                        <span x-show="countdown === 0">Resend one-time passcode (OTP)</span>
                        <span x-show="countdown > 0">Resend available in <span x-text="countdown"></span>s</span>
                    </button>
                </p>
            </form>


            <!-- <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Log Out') }}
                </button>
            </form> -->
        </div>
    </div>


        <script>
            function countdownTimer(expiryTimestamp) {
                return {
                    timeLeft: '',
                    startTimer() {
                        const expiresAt = expiryTimestamp * 1000;

                        const update = () => {
                            const now = new Date().getTime();
                            const distance = expiresAt - now;

                            if (distance <= 0) {
                                this.timeLeft = 'Expired';
                                return;
                            }

                            const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
                            const minutes = Math.floor((distance / (1000 * 60)) % 60);
                            const seconds = Math.floor((distance / 1000) % 60);

                            this.timeLeft = `${hours}h ${minutes}m ${seconds}s`;
                        };

                        update();
                        setInterval(update, 1000);
                    }
                };
            }
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const inputs = document.querySelectorAll(".otp-input");
                const hiddenInput = document.getElementById("code");

                inputs.forEach((input, index) => {
                    input.addEventListener("input", function (e) {
                        const value = this.value.replace(/\D/g, ""); // Remove non-digits
                        this.value = value;

                        if (value && index < inputs.length - 1) {
                            inputs[index + 1].focus();
                        }

                        updateHidden();
                    });

                    input.addEventListener("keydown", function (e) {
                        if (e.key === "Backspace" && this.value === "" && index > 0) {
                            inputs[index - 1].focus();
                        }
                    });

                    input.addEventListener("paste", function (e) {
                        e.preventDefault();
                        const pasteData = (e.clipboardData || window.clipboardData).getData("text").replace(/\D/g, "");
                        pasteData.split("").forEach((char, i) => {
                            if (inputs[i]) inputs[i].value = char;
                        });
                        updateHidden();
                    });
                });

                function updateHidden() {
                    hiddenInput.value = Array.from(inputs).map(i => i.value).join("");
                }
            });
        </script>

</body>
</html>
