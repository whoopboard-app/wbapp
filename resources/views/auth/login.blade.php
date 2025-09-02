<x-guest-layout>
      <div class="p-3 absolute right-0 top-0">
        <p class="text-gray-600">New here?
            <a href="{{ route('register') }}" class="ml-1 underline text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Create an Account
            </a>
        </p>
    </div>

    <div class="text-left mb-8">
         <div class="mb-7 mt-16">
            <a href="/" class="inline-flex items-center">
                <x-application-logo class="w-20 h-20 fill-current" />
            </a>
        </div>
        <h2 class="text-xl font-bold mt-3 mb-1">Sign in to your account</h2>
        <p class="text-gray-500 text-base font-medium tracking-[0.5px]">
            Welcome back! Sign in to access your account and continue where you left off. Secure, seamless, and personalized just for you.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mt-5">
            <div class="flex items-center gap-2">
                <x-input-label for="email" :value="__('Your email address')" />
                <i class="fa-solid fa-circle-question text-gray-400 cursor-pointer" title="Use a valid email address."></i>
            </div>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Placeholder"/>
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="mt-6">
            <div class="flex items-center gap-2">
                <x-input-label for="password" :value="__('Password')" />
                <i class="fa fa-question-circle text-gray-300 cursor-pointer" title="Password must be at least 8 characters with letters, numbers & a special character."></i>
            </div>
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

        <div class="flex justify-center items-center mt-8">
            <x-primary-button class="w-full justify-center text-sm">
                {{ __('Sign in') }}
            </x-primary-button>
        </div>
        <div class="flex items-center mt-6">
            @if (Route::has('password.request'))
                🔑 
                <a class="underline ml-2 text-sm text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>
    </form>
  
</x-guest-layout>
