<x-guest-layout>
    <div class="container py-0">
        <div class="card p-0 bg-white">
            <div class="border-title">
                <h2 class="text-xl font-semibold">Member Sign In</h2>
                
            </div>
            <div class="content-body">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="">
                        <div class="flex items-center gap-2">
                            <x-input-label for="email" :value="__('Email Address')" />
                        </div>
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Placeholder"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Password -->
                    <div class="mt-3">
                        <div class="flex items-center gap-2">
                            <x-input-label for="password" :value="__('Password')" />
                        
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

                    <div class="flex justify-center items-center mt-4">
                        <x-primary-button class="w-full justify-center text-sm">
                            {{ __('Member Sign In') }}
                        </x-primary-button>
                    </div>
                    <div class="flex items-center mt-3">
                        @if (Route::has('password.request'))
                            🔑 
                            <a class="underline ml-2 text-sm text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
