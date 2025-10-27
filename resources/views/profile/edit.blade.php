@extends('layouts.app')

@section('content')
<style>
    .para {
        font-size: 15px !important;
    }
    .let_spc{
        letter-spacing: 0.4px !important;
    }.input-field{
        border: 1px solid #d1d9e0 !important;
    }
    .input-field[readonly]
    {
        background-color: #59636E1A;
        border: 1px solid #D1D9E0;
        pointer-events: none;
    }
    .tooltip-icon:hover i {
        color: #007bff; /* Bootstrap blue on hover */
        cursor: pointer;
    }
    .label {
        font-size: 15px;
    }
    main.flex-1.p-8.pb-48{
        padding-top : 0px !important;
        padding-left : 0px !important;
        padding-right : 0px !important;
    }
    @media (min-width: 992px) {
        .section-content-center {
            max-width: 898px;
          
        }
    }
</style>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <x-alert type="error" :message="$errors->first()" />
    @endforeach
@endif

<section class="section-content-center my-profile-wrapper main-content-wrapper">
        <div class="d-flex justify-content-between">
            <h4 class="fw-medium font-16 mb-0">My Profile / Change Password</h4>
            <div class="btn-wrapper d-flex align-items-center justify-content-center gap-2 flex-wrap mb-2">
                <a href="{{route('app.settings')}}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-flex align-items-center gap-2">
                    <img src="{{ asset('assets/img/chevron-left.svg') }}" alt="Back" class="align-text-bottom">
                    Back to Listing Page
                </a>
            </div>
        </div>
    <div class="d-inline-block w-100 mt-10px">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">My Profile</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-password-tab" data-bs-toggle="pill" data-bs-target="#pills-password" type="button" role="tab" aria-controls="pills-password" aria-selected="false" tabindex="-1">Change Password</button>
            </li>
            
        </ul>
        
    </div>
    <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="row mt-20">
                    <div class="col-lg-12 view-changelog-details">
                        <div class="card p-0 bg-white mb-3">
                            <form action="{{ route('profile.update') }}" method="POST" class=" w-100" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="d-flex align-items-center border-title justify-content-between">
                                    <h4 class="fw-medium mb-0">Last Updated on {{ $user->updated_at ? $user->updated_at->format('F d, Y') : 'Never' }}</h4>
                                    <div class="btn-wrapper mb-0 d-flex align-items-center justify-content-center gap15 flex-wrap">
                                        <button class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block"  type="reset">Cancel</button>
                                        
                                    </div>
                                </div>
                                <div class="mx-auto p-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <h6>Update your profile image</h6>
                                        <h6 class="color-support fw-normal label">[Optional]</h6>
                                    </div>
                                   
                                    <div class="upload-input text-center">
                                        <input type="file" class="visually-hidden" id="profileImg" name="profileImg" accept="image/*" onchange="showPreview(event)">
                                        <label for="profileImg" class="d-block text-center rounded-3">
                                        <span class="upload-btn d-inline-block rounded fw-semibold mb-2"><img src="{{ asset('assets/img/icon/upload.svg') }}" alt=""></span>
                                             <h6 class="fw-semibold">Drop files or browse</h6>
                                            <span class="upload-input-text d-block mb-3">Format: .jpeg, .png &amp; Max file size: 25 MB</span>
                                            <span class="theme-btn sm fw-semibold rounded ">Browse Files</span>
                                            <span id="file-name" class="d-block mt-2 fw-medium">
                                                {{ $user->profile_img ? basename($user->profile_img) : '' }}
                                            </span>
                                            <img id="preview-img"
                                                src="{{ $user->profile_img ? asset('storage/'.$user->profile_img) : '' }}"
                                                alt="Preview"
                                                class="mt-2 mx-auto rounded shadow-sm {{ $user->profile_img ? '' : 'd-none' }}"
                                                width="100"
                                                height="100">
                                        </label>
                                    </div>
                                    <div class="basic-information mt-3">
                                        <div class="d-flex justify-content-between px-0 border-title">
                                            <h6 class="text-gray">Basic Information</h6>
                                            <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="Help" data-bs-original-title="Help">
                                                <a href="#"><img src="assets/img/icons/help.svg" alt=""></a>
                                            </span>
                                        </div>
                                        <p class="label color-support fw-medium mt-2">
                                            Provide the core details of your update, including the title, category, and description. This information helps users understand what the changelog is about.
                                        </p>
                                        <div class="row mt-3">
                                        <div class="col-12 col-lg-6 mb-3">
                                            <div class="">
                                                <label for="firstName" class="input-label mb-1 fw-medium">First Name
                                                </label>
                                                <input id="first_name"
                                                    name="first_name"
                                                    class="input-field w-100 rounded"
                                                    placeholder="Placeholder"
                                                    value="{{ old('first_name', $user->name) }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6 mb-3">
                                            <div class="">
                                                <label for="lastName" class="input-label mb-1 fw-medium">Last Name
                                                </label>
                                                <input id="last_name"
                                                    name="last_name"
                                                    class="input-field w-100 rounded"
                                                    placeholder="Placeholder"
                                                    value="{{ old('last_name', $user->last_name) }}"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6 mb-3">
                                            <div class="">
                                                <label for="email" class="input-label mb-1 fw-medium"> Email
                                                </label>
                                                <input type="email" id="email" name="email" class="input-field w-100 rounded" placeholder="Placeholder" value="{{ old('email', $user->email) }}" readonly required>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6 mb-3">
                                            <div class="">
                                                <label for="user_type" class="input-label mb-1 fw-medium"> Current Role
                                                </label>
                                                <select id="user_type" name="user_type" class="input-field w-100 rounded" required readonly>
                                                    <option value="">-- Select Role --</option>
                                                    <option value="1" {{ $user->user_type == 1 ? 'selected' : '' }} >Super Administrator (Owner)</option>
                                                    <option value="2" {{ $user->user_type == 2 ? 'selected' : '' }}>Administrator</option>
                                                    <option value="3" {{ $user->user_type == 3 ? 'selected' : '' }}>Manager</option>
                                                    <option value="4" {{ $user->user_type == 4 ? 'selected' : '' }}>Editor</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <div class=" ">
                                                <div class="">
                                                    <label for="short-desc" class="input-label mb-1 fw-medium">Short Description
                                                    </label>
                                                    <textarea type="text" name="short-desc"  id="short-desc" rows="3" id="desc" class="input-field w-100 rounded" maxlength="200" placeholder="Placeholder" required>{{ old('short-desc', $user->short_desc) }}</textarea>
                                                    <span class="label color-support fw-normal">Note : Maximum of 200 Character</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    </div>
                                    
                                    
                                    
                                </div>
                            <div class="card-footer gap15 px-3 bg-white d-flex justify-content-start">
                                <button type="submit" class="theme-btn sm fw-semibold rounded d-inline-block">Save</button>
                                <button class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block"  type="reset">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            
            </div>
            </div>
            <div class="tab-pane fade" id="pills-password" role="tabpanel" aria-labelledby="pills-password-tab">
                <div class="row mt-20">
                    <div class="col-lg-12 view-changelog-details">
                        <div class="card p-0 bg-white mb-3">
                            <form action="{{ route('profile.changePassword') }}" method="POST" class="form">
                                @csrf
                                @method('PATCH')
                                <div class="d-flex align-items-center border-title justify-content-between">
                                    <h4 class="fw-medium mb-0">Last Updated on {{ $user->updated_at ? $user->updated_at->format('F d, Y') : 'Never' }}</h4>
                                        <div class="btn-wrapper mb-0 d-flex align-items-center justify-content-center gap15 flex-wrap">
                                        <button class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block"  type="reset">Cancel</button>
                                            
                                        </div>
                                </div>
                                    <div class="mx-auto p-3">
                                    
                                
                                    <div class="basic-information">
                                        <div class="d-flex justify-content-between px-0 border-title">
                                            <h6 class="text-gray">Password Security</h6>
                                            <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="Help" data-bs-original-title="Help">
                                                <a href="#"><img src="assets/img/icons/help.svg" alt=""></a>
                                            </span>
                                            </div>
                                            
                                            <div class="row mt-3">
                                        <div class="col-12 mb-3">
                                            <div class="">
                                                <label for="current_password" class="input-label mb-1 fw-medium">Current Password
                                                </label>
                                                <input type="password" name="current_password" class="input-field w-100 rounded" placeholder="Placeholder" required>
                                            </div>
                                        </div>
                                       
                                        <div x-data="{ new_password: '', confirm_password: '',
                                            get isValid() {
                                                return this.new_password.length >= 8
                                                    && /[A-Z]/.test(this.new_password)
                                                    && /[\W_]/.test(this.new_password)
                                                    && /[0-9]/.test(this.new_password)
                                                    && this.new_password === this.confirm_password;
                                            } }">
                                            <!-- Password -->
                                            <div class="">
                                                <label for="new_password" class="input-label mb-1 fw-medium">New Password
                                                </label>
                                                <x-text-input 
                                                    id="new_password" 
                                                    class="block mt-1 w-full" 
                                                    type="password" 
                                                    name="new_password" 
                                                    x-model="new_password"
                                                    required 
                                                    autocomplete="new-password" 
                                                    placeholder="Placeholder"
                                                />
                                                <!-- <x-input-error :messages="$errors->first('password')" class="mt-2" /> -->
                                            </div>

                                            <!-- Confirm Password -->
                                            <div class="mt-3">
                                                <label for="confirm_password" class="input-label mb-1 fw-medium">Confirm Password
                                                </label>
                                                <x-text-input id="confirm_password" class="block mt-1 w-full"
                                                    type="password"
                                                    x-model="confirm_password"
                                                    name="confirm_password" required autocomplete="new-password" 
                                                    placeholder="Placeholder"/>
                                                <!-- <x-input-error :messages="$errors->first('password_confirmation')" class="mt-2" /> -->
                                            </div>

                                            <!-- Password Requirements -->
                                            <ul class="my-4 text-sm text-gray-500 space-y-1">
                                                <li class="flex items-center" :class="new_password.length >= 8 ? 'text-green-500' : 'text-gray-500'">
                                                    <i class="fa-regular fa-circle-check mr-2" :class="new_password.length >= 8 ? 'text-green-500' : 'text-gray-500'"></i> Minimum 8 Characters
                                                </li>
                                                <li class="flex items-center" :class="/[A-Z]/.test(new_password) ? 'text-green-500' : 'text-gray-500'">
                                                    <i class="fa-regular fa-circle-check mr-2" :class="/[A-Z]/.test(new_password) ? 'text-green-500' : 'text-gray-500'"></i> At least one uppercase letter
                                                </li>
                                                <li class="flex items-center" :class="/[\W_]/.test(new_password) ? 'text-green-500' : 'text-gray-500'">
                                                    <i class="fa-regular fa-circle-check mr-2" :class="/[\W_]/.test(new_password) ? 'text-green-500' : 'text-gray-500'"></i> At least one special character
                                                </li>
                                                <li class="flex items-center" :class="/[0-9]/.test(new_password) ? 'text-green-500' : 'text-gray-500'">
                                                    <i class="fa-regular fa-circle-check mr-2" :class="/[0-9]/.test(new_password) ? 'text-green-500' : 'text-gray-500'"></i> At least one number
                                                </li>
                                                <li class="flex items-center" :class="new_password && new_password === confirm_password ? 'text-green-500' : 'text-gray-500'">
                                                    <i class="fa-regular fa-circle-check mr-2" :class="new_password && new_password === confirm_password ? 'text-green-500' : 'text-gray-500'"></i>
                                                    Passwords match
                                                </li>
                                            </ul>
                                            <div class="card-footer gap15 px-3 bg-white d-flex justify-content-start">
                                    <button type="submit" class="theme-btn sm fw-semibold rounded d-inline-block"  :disabled="!isValid"
                                    :class="!isValid ? 'opacity-50 cursor-not-allowed' : ''">Save</button>
                                    <button class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block"  type="reset">Cancel</button>
                                </div>
                                        </div>
                                    </div>
                                    </div>
                                    
                                
                                </div>
                                
                            </form>
                </div>
            </div>
            
            </div>
            </div>
    </div>
    
</section>

<!-- <section class="section-content-center">
    <div class="container py-4">
        <h4 class="fw-bold fs-4 mb-2 let_spc">Update Profile</h4>
        <p class="text-muted label mb-4 para">
            Keep your information up to date. Edit your details below to personalize your account and improve your experience.
        </p>
        <form action="{{ route('profile.update') }}" method="POST" class=" w-100" enctype="multipart/form-data">
            @csrf
             @method('PATCH')
                <div class="card bg-white mb-3">

                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="">
                                <label for="first_name" class="input-label mb-1 fw-medium">First Name
                                <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="First name" data-bs-original-title="First name"><i class="fa fa-question-circle"></i></span>
                                </label>
                                 <input id="first_name"
                                    name="first_name"
                                    class="input-field w-100 rounded"
                                    placeholder="Placeholder"
                                    value="{{ old('first_name', $user->name) }}"
                                    required>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="">
                                <label for="last_name" class="input-label mb-1 fw-medium">Last Name
                                <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="Last name" data-bs-original-title="Last name"><i class="fa fa-question-circle"></i></span>
                                </label>
                                 <input id="last_name"
                                    name="last_name"
                                    class="input-field w-100 rounded"
                                    placeholder="Placeholder"
                                    value="{{ old('last_name', $user->last_name) }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="upload-input text-center">
                                <input type="file" class="visually-hidden" id="profileImg" name="profileImg" accept="image/*" onchange="showPreview(event)">
                                <label for="profileImg" class="d-block text-center rounded-3">
                                    <span class="upload-btn widget-item-btn d-inline-block rounded fw-semibold mb-2">Upload Your Profile</span>
                                    <span class="upload-input-text d-block">Recommended size 200 / 200</span>
                                    <span id="file-name" class="d-block mt-1 fw-medium">
                                        {{ $user->profile_img ? basename($user->profile_img) : '' }}
                                    </span>
                                    <img id="preview-img"
                                        src="{{ $user->profile_img ? asset('storage/'.$user->profile_img) : '' }}"
                                        alt="Preview"
                                        class="mt-2 mx-auto rounded shadow-sm {{ $user->profile_img ? '' : 'd-none' }}"
                                        width="100"
                                        height="100">
                                </label>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="">
                                <label for="email" class="mb-1 fw-medium">Email Address
                                <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="Email Address" data-bs-original-title="email"><i class="fa fa-question-circle"></i></span>
                                </label>
                                <input type="email" id="email" name="email" class="input-field w-100 rounded" placeholder="Placeholder" value="{{ old('email', $user->email) }}" readonly required>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="">
                                <label for="user_type" class="input-label mb-1 fw-medium">Current Role
                                <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="First name" data-bs-original-title="Role"><i class="fa fa-question-circle"></i></span>
                                </label>
                                <select id="user_type" name="user_type" class="input-field w-100 rounded" required readonly>
                                    <option value="">-- Select Role --</option>
                                    <option value="1" {{ $user->user_type == 1 ? 'selected' : '' }} >Super Administrator (Owner)</option>
                                    <option value="2" {{ $user->user_type == 2 ? 'selected' : '' }}>Administrator</option>
                                    <option value="3" {{ $user->user_type == 3 ? 'selected' : '' }}>Manager</option>
                                    <option value="4" {{ $user->user_type == 4 ? 'selected' : '' }}>Editor</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="">
                                <label for="aboutme" class="input-label mb-1 fw-medium">About Me
                                <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="About Me" data-bs-original-title="About Me"><i class="fa fa-question-circle"></i></span>
                                </label>
                                <textarea name="aboutme" id="aboutme" rows="3" class="input-field w-100 rounded"></textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="theme-btn rounded border-0 fw-bold let_spc">Update Profile</button>
                        </div>
                    </div>

                </div>

        </form>


    </div>

</section> -->

<script>
    function showPreview(event) {
        const input = event.target;
        const file = input.files[0];
        const fileName = file ? file.name : "";
        document.getElementById('file-name').textContent = fileName;

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImg = document.getElementById('preview-img');
                previewImg.src = e.target.result;
                previewImg.classList.remove('d-none'); // nayi file select hui to image dikhao
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
