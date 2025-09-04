<x-guest-layout>
    <div class="text-left mb-8">
         <div class="mb-7 mt-16">
            <a href="/" class="inline-flex items-center">
                <x-application-logo class="w-20 h-20 fill-current" />
            </a>
        </div>
        <h2 class="text-2xl font-bold mt-4 mb-1">Reset your password</h2>
        <p class="text-gray-500 text-base font-medium">
            Please enter your new password below to regain access to your account.
        </p>
    </div>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->first('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->first('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-primary-button class="w-full justify-center text-sm">
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
