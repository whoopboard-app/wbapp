<x-guest-layout>
    @if ($errors->any())
        <x-alert type="error" :message="$errors->first()" />
    @endif
    <div class="container py-0 mb-4">
        <div class="card p-0 bg-white">
            <div class="border-title">
                <h2 class="text-xl font-semibold">Member Sign Up</h2>
                
            </div>
            <div class="content-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <div class="flex items-center gap-2">
                            <x-input-label for="name" :value="__('Full Name')" />
                        
                        </div>
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Placeholder" pattern="[A-Za-z\s]+" 
                        title="Only letters are allowed"/>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-3">
                        <div class="flex items-center gap-2">
                            <x-input-label for="email" :value="__('Email Address')" />
                        </div>
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Placeholder"/>
                        <!-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> -->
                    </div>

                    <!-- Password -->
                    <div class="mt-3" x-data="{ password: '' }">
                        <div class="flex items-center gap-2">
                            <x-input-label for="password" :value="__('Password')" />
                        </div>

                        <!-- Password Input -->
                        <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    x-model="password"
                                    placeholder="Enter password"
                                    required autocomplete="new-password" />

                        <!-- <x-input-error :messages="$errors->first('password')" class="mt-2" /> -->

                        <!-- Password Requirements -->
                        <ul class="my-3 text-sm text-gray-500 space-y-1">
                            <li class="flex items-center" :class="password.length >= 8 ? 'text-green-500' : 'text-gray-500'">
                                <i class="fa-regular fa-circle-check mr-2" :class="password.length >= 8 ? 'text-green-500' : 'text-gray-500'"></i> Minimum 8 Characters
                            </li>
                            <li class="flex items-center" :class="/[A-Z]/.test(password) ? 'text-green-500' : 'text-gray-500'">
                                <i class="fa-regular fa-circle-check mr-2" :class="/[A-Z]/.test(password) ? 'text-green-500' : 'text-gray-500'"></i> At least one uppercase letter
                            </li>
                            <li class="flex items-center" :class="/[\W_]/.test(password) ? 'text-green-500' : 'text-gray-500'">
                                <i class="fa-regular fa-circle-check mr-2" :class="/[\W_]/.test(password) ? 'text-green-500' : 'text-gray-500'"></i> At least one special character
                            </li>
                            <li class="flex items-center" :class="/[0-9]/.test(password) ? 'text-green-500' : 'text-gray-500'">
                                <i class="fa-regular fa-circle-check mr-2" :class="/[0-9]/.test(password) ? 'text-green-500' : 'text-gray-500'"></i> At least one number
                            </li>
                        </ul>
                    </div>

                    <!-- Confirm Password -->
                    <!-- <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div> -->
                    <div class="flex justify-center items-center mt-3">
                        <x-primary-button class="w-full justify-center text-sm">
                            {{ __('Member Sign Up') }}
                        </x-primary-button>
                    </div>

                </form>
                <div class="flex text-sm mt-3">
                    <p class="text-gray-600 text-sm">
                        Back to 
                        <a href="{{ route('login') }}" class="underline text-sm text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ">
                        Login
                        </a>
                    </p>
                </div>
            </div>
        </div>
</x-guest-layout>
