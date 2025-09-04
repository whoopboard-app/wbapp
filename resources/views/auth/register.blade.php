<x-guest-layout>
    @if ($errors->any())
        <x-alert type="error" :message="$errors->first()" />
    @endif
    <div class="p-3 absolute right-0 top-0">
        <p class="text-gray-600">Already have an account?
            <a href="{{ route('login') }}" class="ml-1 underline text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Sign in
            </a>
        </p>
    </div>

    <div class="text-left mb-8">
         <div class="mb-7 mt-16">
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
            <div class="flex items-center gap-2">
                <x-input-label for="name" :value="__('Your full name')" />
                <i class="fa-solid fa-circle-question cursor-pointer relative"
                    x-data="{ show: false }"
                    @mouseenter="show = true" 
                    @mouseleave="show = false"
                    :class="show ? 'text-blue-600' : 'text-gray-300'">

                        <!-- Tooltip -->
                        <div x-show="show"
                            x-transition
                            class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-black text-white text-sm px-2 py-2 border border-gray-700 rounded-lg shadow-lg z-50 font-sans whitespace-normal inline-block min-w-[200px] max-w-xs font-medium">
                            Enter your complete name as it appears officially.

                        
                          <div class="absolute top-[50] left-1/2 -translate-x-1/2 w-3 h-3 bg-black rotate-45"></div>

                        </div>

                </i>

            </div>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Placeholder" pattern="[A-Za-z\s]+" 
            title="Only letters are allowed"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <div class="flex items-center gap-2">
                <x-input-label for="email" :value="__('Your email address')" />
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
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Placeholder"/>
            <!-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> -->
        </div>

        <!-- Password -->
        <div class="mt-4" x-data="{ password: '' }">
            <div class="flex items-center gap-2">
                <x-input-label for="password" :value="__('Password')" />
                <i class="fa-solid fa-circle-question cursor-pointer relative"
                x-data="{ show: false }"
                @mouseenter="show = true" 
                @mouseleave="show = false"
                :class="show ? 'text-blue-600' : 'text-gray-300'">
                
                    <!-- Tooltip -->
                    <div x-show="show"
                        x-transition
                        class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-black text-white text-sm px-3 py-2 border border-gray-700 rounded-lg font-medium shadow-lg z-50 font-sans whitespace-normal inline-block min-w-[220px] max-w-xs">
                        Password must be at least 8 characters with letters, numbers & a special character.
                        <!-- Arrow -->
                        <div class="absolute top-[95%] left-1/2 -translate-x-1/2 w-3 h-3 bg-black rotate-45"></div>
                    </div>
                </i>
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
            <ul class="my-8 text-sm text-gray-500 space-y-1">
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
        <div class="flex justify-center items-center mt-4">
            <x-primary-button class="w-full justify-center text-sm">
                {{ __('Sign up') }}
            </x-primary-button>
        </div>

    </form>

    <div class="mt-5">
        <p class="text-gray-600 text-sm">
            By clicking the button above, you agree to our
            <a href="/" class="underline text-sm text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Terms of Use</a> <b>and</b> <a href="/" class="underline text-sm text-blue-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Privacy Policy</a>.
        </p>
    </div>
    
    
</x-guest-layout>
