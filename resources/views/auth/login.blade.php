<x-guest-layout>
    <div class="text-left mb-6">
         <div class="mb-3">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current" />
            </a>
        </div>
        <h2 class="text-xl font-bold mt-4 mb-1">Sign In</h2>
        <p class="text-gray-500 text-base font-medium">
            Welcome back! Sign in to access your account and continue where you left off. Secure, seamless, and personalized just for you.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Your email address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Placeholder"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="Placeholder"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <!-- <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div> -->

        <div class="flex justify-center items-center mt-4">
            <x-primary-button class="w-full justify-center text-sm">
                {{ __('Sign in') }}
            </x-primary-button>
        </div>
        <div class="flex justify-center items-center mt-5">
             @if (Route::has('password.request'))
                <a class="underline text-sm text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
    </form>
    <div class="text-center mt-5">
        <span class="text-gray-600 text-sm">Don't have an account?</span>
        <a href="{{ route('register') }}" class="ml-2 underline text-sm text-blue-600 hover:text-gray-900 font-medium">
            Sign up
        </a>
    </div>
</x-guest-layout>
