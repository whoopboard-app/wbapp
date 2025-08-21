<x-guest-layout>

    <div class="text-left mb-6">
         <div class="mb-3">
            <a href="/" class="inline-flex items-center">
                <x-application-logo class="w-20 h-20 fill-current" />
            </a>
        </div>
        <h2 class="text-xl font-bold mt-4 mb-1">Sign up to start your free trial</h2>
        <p class="text-gray-500 text-base font-medium">
            Try Insighthq free, cancel anytime.
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Your full name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Placeholder" pattern="[A-Za-z\s]+" 
            title="Only letters are allowed"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Your email address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Placeholder"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Placeholder" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <!-- <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div> -->
        <div class="flex justify-center items-center mt-4">
            <x-primary-button class="w-full justify-center text-sm">
                {{ __('Sign up') }}
            </x-primary-button>
        </div>

    </form>

    <div class="text-center mt-5">
        <span class="text-gray-600 text-sm">Sign up
            By clicking the button above, you agree to our
            <a href="/" class="underline text-sm text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Terms of Use</a> and <a href="/" class="underline text-sm text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Privacy Policy</a>.
        </span>
    </div>
    
    <div class="text-center mt-5">
        <span class="text-gray-600 text-sm">Already have an account?</span>
        <a href="{{ route('login') }}" class="ml-1 underline text-sm text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Sign in
        </a>
    </div>
</x-guest-layout>
