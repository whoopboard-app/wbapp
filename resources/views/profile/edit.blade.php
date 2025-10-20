@extends('layouts.add_changelog')

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
    @media (min-width: 992px) {
        .section-content-center {
            max-width: 983px;
            margin: 0 auto;
        }
    }
</style>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <x-alert type="error" :message="$errors->first()" />
    @endforeach
@endif

<section class="section-content-center">
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

</section>
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
