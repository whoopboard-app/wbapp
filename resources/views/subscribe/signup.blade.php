<x-guest-layout>
    <style>
        .flex.flex-col.items-center.p-4.relative {
            padding: 0px !important;
        }
    </style>
    <div class="container py-0">
        <div class="card p-0 bg-white">
            <div class="border-title">
                <h2 class="text-xl font-semibold">Subscribe</h2>
                
            </div>
            <div class="content-body">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('subscribe.signup') }}">
                    @csrf

                    <div class="">
                        <div class="flex items-center gap-2">
                            <x-input-label for="full_name" :value="__('Full Name')" />
                        </div>
                        <x-text-input id="full_name" class="block mt-1 w-full" type="text" name="full_name" :value="old('full_name')" required autofocus autocomplete="username" placeholder="Placeholder"/>
                        <x-input-error :messages="$errors->get('full_name')" class="mt-1" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-3">
                        <div class="flex items-center gap-2">
                            <x-input-label for="email" :value="__('Email Address')" />
                        </div>
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Placeholder"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>
                   
                    <div class="flex justify-center items-center mt-3">
                        <x-primary-button class="w-full justify-center text-sm">
                            {{ __('Subscribe') }}
                        </x-primary-button>
                    </div>
                    <p class="form-para color-support fw-medium small mt-2 mb-0">
                        Your will receive a email to confirm your subscriptions    
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
