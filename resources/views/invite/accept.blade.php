<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'My Project') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <style>
        .let_spc{
            letter-spacing: 0.4px !important;
        }
        .text-muted {
            font-size: 14px !important;
        }
        .input-field[readonly]
        {
            background-color: #59636E1A;
            border: 1px solid #D1D9E0;
            pointer-events: none;
        }
    </style>
</head>
<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

<body class="bg-white-100 font-sans antialiased">
    @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        @if (session('info'))
            <x-alert type="info" :message="session('info')" />
        @endif

        @if (session('warning'))
            <x-alert type="warning" :message="session('warning')" />
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-alert type="error" :message="$errors->first()" />
            @endforeach
        @endif
    <div class="w-full max-w-md mx-auto mt-10 p-6 bg-white h-auto">
        <div class="mb-2">
           <form action="{{ route('invite.complete') }}" method="POST" class="signup-form mx-auto" enctype="multipart/form-data">
                <img src="{{ asset('images/insighthq-logo.svg') }}" alt="Logo">
                <h1 class="fw-bold mt-3 fs-4 let_spc">Please verify your email</h1>
                <p class="text-muted let_spc mt-2 mb-3 label">
                    Please click the link or enter the verification code we’ve sent to your email to complete the process. If you don’t see it in your inbox, check your spam folder.
                </p>
                <div class="bg-white mb-3">
                    @csrf
                     <input type="hidden" name="invite_token" value="{{ $invite->token }}">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="">
                                <label for="email" class="input-label mb-1 fw-medium">Your Email Address
                                <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="Email" data-bs-original-title="Email"><i class="fa fa-question-circle"></i></span>
                                </label>
                                <input type="text" id="email" name ="email" value="{{ $invite->email }}" 
                                    readonly class="input-field w-100 rounded" placeholder="Placeholder">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="">
                            <label for="user_type" class="input-label mb-1 fw-medium">Your assigned role
                                <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="User Type" data-bs-original-title="User Type">
                                    <i class="fa fa-question-circle"></i>
                                </span>
                            </label>

                            <select id="user_type" name="user_type" class="input-field w-100 rounded" readonly>
                                <option value="1" {{ $invite->user_type == 1 ? 'selected' : '' }}>Super Administrator (Owner)</option>
                                <option value="2" {{ $invite->user_type == 2 ? 'selected' : '' }}>Administrator</option>
                                <option value="3" {{ $invite->user_type == 3 ? 'selected' : '' }}>Manager</option>
                                <option value="4" {{ $invite->user_type == 4 ? 'selected' : '' }}>Editor</option>
                            </select>
                                    <!-- <input type="text" id="role" readonly class="input-field w-100 rounded" placeholder="Placeholder" value="{{ $invite->role }}"> -->
                            
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="">
                                <label for="firstName" class="input-label mb-1 fw-medium">First Name
                                <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="First name" data-bs-original-title="First name"><i class="fa fa-question-circle"></i></span>
                                </label>
                                <input type="text" id="firstName" name="firstName" class="input-field w-100 rounded" placeholder="Placeholder" required value="{{ ucfirst($invite->first_name) }}">
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="">
                            <label for="lastName" class="input-label mb-1 fw-medium">Last Name
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="Last name" data-bs-original-title="Last name"><i class="fa fa-question-circle"></i></span>
                                </label>
                                    <input type="text" id="lastName" class="input-field w-100 rounded" placeholder="Placeholder" name="lastName" required>
                            
                            </div>
                        </div>
                       <div class="col-12 mb-3">
                            <div class="upload-input">
                                <input type="file" class="visually-hidden" id="feature-banner" name="profileImg" onchange="showFileName(event)">
                                <label for="feature-banner" class="d-block text-center rounded-3">
                                    <span class="upload-btn widget-item-btn d-inline-block rounded fw-semibold mb-2">Upload Your Profile</span>
                                    <span class="upload-input-text d-block">Recommended size 200 / 200 Size</span>
                                    <span id="file-name" class="d-block mt-1 fw-medium"></span> <!-- File name will appear here -->
                                </label>
                            </div>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <div class="">
                                <label for="passowrd" class="input-label mb-1 fw-medium">Password
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="Password" data-bs-original-title="Password"><i class="fa fa-question-circle"></i></span>
                                </label>
                                <!-- Password -->
                                <div class="" x-data="{ password: '' }">
                                    <!-- Password Input -->
                                    <x-text-input id="password" class="block mt-1 w-full"
                                                type="password"
                                                name="password"
                                                x-model="password"
                                                placeholder="Enter password"
                                                required autocomplete="new-password" />

                                    <!-- <x-input-error :messages="$errors->first('password')" class="mt-2" /> -->

                                    <!-- Password Requirements -->
                                    <ul class="mt-4 mb-2 text-sm text-gray-500 space-y-1">
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
                            
                            </div>
                        </div>
                       
                        <div class="col-12">
                            <button type="submit" class="theme-btn rounded border-0 w-100 fw-bold">Continue</button>
                        </div>
                    </div>

                </div>
        </form>
        </div>
    </div>
<script>
    function showFileName(event) {
        const input = event.target;
        const fileName = input.files.length > 0 ? input.files[0].name : "";
        document.getElementById("file-name").textContent = fileName;
    }
</script>
</body>
</html>
