<x-guest-layout>
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
        .input-field {
            padding-left: 0.5rem;
            font-size:14px;
        }

        .input-label{
            font-size:14px;
        }
    </style>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-alert type="error" :message="$errors->first()" />
        @endforeach
    @endif
    <div class="container py-0">
        <div class="card p-0 bg-white">
            <div class="border-title">
                <h2 class="text-xl font-semibold">Member Sign In</h2>
            </div>
            <div class="content-body">
                <form action="{{ route('invite.complete') }}" method="POST" enctype="multipart/form-data">
                
                <div class="bg-white mb-3">
                    @csrf
                     <input type="hidden" name="invite_token" value="{{ $invite->token }}">
                    <div class="row">
                        <div class="col-12">
                            <div class="upload-container">
                                <div class="profile-pic-wrapper">
                                    <img src="{{ asset('assets/img/icon/user-member.svg') }}" width=80 class="profile-pic" id="previewImage" alt="Profile">
                                </div>

                                <label class="theme-btn  text-black sm bg-white secondary mt-2 fw-normal font-12 rounded d-inline-block">
                                    Browse &amp; Upload
                                    <input type="file" id="uploadInput" accept="image/*" hidden="" class="visually-hidden" id="profileImg" name="profileImg" onchange="showFileName(event)">
                                </label>
                                <span id="file-name" class="d-block mt-1 fw-medium text-sm"></span> 
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="">
                                <label for="firstName" class="input-label mb-1 fw-medium">First Name
                               
                                </label>
                                <input type="text" id="firstName" name="firstName" class="input-field w-100 rounded" placeholder="Placeholder" required value="{{ ucfirst($invite->first_name) }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="">
                            <label for="lastName" class="input-label mb-1 fw-medium">Last Name
                                  
                                </label>
                                    <input type="text" id="lastName" class="input-field w-100 rounded" placeholder="Placeholder" name="lastName" required value="{{ ucfirst($invite->last_name) }}">
                            
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="">
                                <label for="email" class="input-label mb-1 fw-medium">Your Email Address
                                
                                </label>
                                <input type="text" id="email" name ="email" value="{{ $invite->email }}" 
                                    readonly class="input-field w-100 rounded" placeholder="Placeholder">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="">
                            <label for="user_type" class="input-label mb-1 fw-medium">Your assigned role
                              
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
                        
                        
                        <div class="col-12">
                            <div class="">
                                <label for="passowrd" class="input-label mb-1 fw-medium">Password
                                  
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
    </div>
</x-guest-layout>

<script>
    function showFileName(event) {
        const input = event.target;
        const fileName = input.files.length > 0 ? input.files[0].name : "";
        document.getElementById("file-name").textContent = fileName;
    }
</script>
</body>
</html>
