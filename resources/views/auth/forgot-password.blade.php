<x-guest-layout>
    @if (session('success'))
    <x-alert type="success" :message="session('success')" />
    @endif

    @if (session('error'))
        <x-alert type="error" :message="session('error')" />
    @endif
    <div class="text-left mb-8">
         <div class="mb-7 mt-16">
            <a href="/" class="inline-flex items-center">
                <x-application-logo class="w-20 h-20 fill-current" />
            </a>
        </div>
        
            <h2 class="text-xl font-bold text-gray-800 mt-6 mb-2 flex items-center gap-2 tracking-tight">
                <span>🔑</span>
                Forgot your password?
            </h2>
            <p class="text-gray-500 text-base font-medium tracking-[0.5px]">
                No worries — enter your email address and we’ll send you a secure link to reset your password.
            </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('')" />
            <div class="flex items-center gap-2">
                <x-input-label for="email" :value="__('Email Address')" />
                <i class="fa-solid fa-circle-question cursor-pointer relative"
                    x-data="{ show: false }"
                    @mouseenter="show = true" 
                    @mouseleave="show = false"
                    :class="show ? 'text-blue-600' : 'text-gray-300'">
                    
                        <!-- Icon -->
                        
                        <!-- Tooltip -->
                        <div x-show="show"
                            x-transition
                            class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-black text-white text-sm px-2 py-2 border border-gray-700 rounded-lg font-medium shadow-lg z-50 font-sans whitespace-normal inline-block min-w-[200px] max-w-xs">
                            Use a valid email address to receive verification.
                            <div class="absolute top-[50] left-1/2 -translate-x-1/2 w-3 h-3 bg-black rotate-45"></div>
                        </div>

                </i>
            </div>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="Placeholder"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-8">
            <x-primary-button class="w-full justify-center text-sm">
                {{ __('Send Reset Link') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-4 flex  text-sm mt-8">
        <p class="text-gray-600 text-sm">
            Back to 
            <a href="{{ route('login') }}" class="underline text-sm text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ">
            Login
            </a> or <a href="{{ route('register') }}" class="ml-1 underline text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Sign up
            </a>
        </p>
    </div>
</x-guest-layout>
