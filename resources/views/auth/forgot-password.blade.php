<x-guest-layout>
    @if (session('success'))
    <x-alert type="success" :message="session('success')" />
    @endif

    @if (session('error'))
        <x-alert type="error" :message="session('error')" />
    @endif
    <div class="container py-0">
        <div class="card p-0 bg-white">
            <div class="border-title">
                <h2 class="text-xl font-semibold">Forgot Password?</h2>
                
            </div>
            <div class="content-body">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}" >
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('')" />
                        <div class="flex items-center gap-2">
                            <x-input-label for="email" :value="__('Email Address')" />
                        </div>
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="Placeholder"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="w-full justify-center text-sm">
                            {{ __('Send New Password Request') }}
                        </x-primary-button>
                    </div>
                </form>

                <div class="flex text-sm mt-3">
                    <p class="text-gray-600 text-sm">
                        Back to 
                        <a href="{{ route('login') }}" class="underline text-sm text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ">
                        Login
                        </a> or <a href="{{ route('register') }}" class="ml-1 underline text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Sign up
                        </a>
                    </p>
                </div>
            </div>
        </div>
</x-guest-layout>
