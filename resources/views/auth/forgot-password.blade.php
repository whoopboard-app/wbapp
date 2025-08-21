<x-guest-layout>
    <div class="mb-3">
        <a href="/">
            <x-application-logo class="w-20 h-20 fill-current" />
        </a>
    </div>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="Placeholder"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-5">
            <x-primary-button class="w-full justify-center text-sm">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-4 flex justify-center text-sm mt-4">
        <a href="{{ route('login') }}" class="underline text-sm text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ">
            {{ __('Back to Login') }}
        </a>

    </div>
</x-guest-layout>
