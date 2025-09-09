@extends('layouts.navbar-cross')

@section('content')
    <div class="container pt-3 my-md-auto">
        <div class="row">
            <div class="col-10 offset-2">
                <div class="text-start mb-4">
                    <h4 class="text-2xl md:text-2xl font-bold text-gray-900">
                        🎨 Choose Your Theme
                    </h4>
                    <p class="text-muted">
                        Make your board truly yours. Pick a theme that matches your brand’s style — you can always change it later.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-md-auto">
        <div class="theme-setting-wrapper border-1 p-4 rounded" style="margin-left: 17%; width: 70%;">
            <!-- Default Theme Card -->
            @php
                $defaultTheme = $themes->first(); // assuming the first theme is default
            @endphp

            <div class="theme-card d-flex flex-column flex-md-row align-items-start gap-3 rounded-bottom-circle">
                <!-- Left Image -->
                <div>
                    <img src="assets/img/icon/theme-card-user.svg"
                         alt="Theme"
                         class="theme-img"
                         style="width:500px; height:170px;">
                    <!-- Brand Color -->
                    <div class="mb-3">
                        <div class="form-input color-group border-0">
                            <label for="brand-color" class="input-label mb-1 fw-medium">Brand Color</label>
                            <div class="input-group align-items-center">
                                <div class="position-relative">

                                    <!-- Circle preview (clickable) -->
                                    <label for="brandColorPicker"
                                           class="position-absolute top-50 start-0 translate-middle-y ms-2 rounded-circle overflow-hidden"
                                           style="width:30px; height:30px; cursor:pointer; background-color: {{ $defaultTheme->default_color ?? old('color_hex', '#f44336') }};">
                                        <input
                                            type="color"
                                            id="brandColorPicker"
                                            class="w-100 h-100 border-0 p-0 opacity-0 cursor-pointer"
                                            value="{{ $defaultTheme->default_color ?? old('color_hex', '#f44336') }}"
                                            onchange="document.getElementById('brandColorHex').value=this.value;this.parentNode.style.backgroundColor=this.value"
                                        >
                                    </label>

                                    <!-- Hex field -->
                                    <input id="brandColorHex"
                                           type="text"
                                           class="form-control ps-5 rounded border-[#19140035]"
                                           value="{{ $defaultTheme->default_color ?? old('color_hex', '#f44336') }}"
                                           onchange="document.getElementById('brandColorPicker').value=this.value;document.querySelector('label[for=brandColorPicker]').style.backgroundColor=this.value">
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(isset($userTheme))
                        <button class="btn btn-success fw-semibold rounded btn-md">Current Default Theme (Published)</button>
                    @else
                        <button class="btn btn-success fw-semibold rounded btn-md"
                                data-bs-toggle="modal"
                                data-bs-target="#customizeTheme">
                            Customize & Publish Default Theme
                        </button>
                    @endif
                                </div>

                <!-- Right Content -->
                <div class="flex-grow-1">
                    <label class="form-label fw-semibold fs-5 mb-0">{{ $defaultTheme->name }}</label>
                    <p class="text-muted mb-2">{{ $defaultTheme->description }}</p>

                    <div class="mb-3">
                        <label class="form-label fw-semibold fs-5">Website Visibility</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="visibility1">
                            <label class="form-check-label" for="visibility1">
                                On — Your board is live and accessible at [subdomain]
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold fs-5">Password Protected</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="password1">
                            <label class="form-check-label" for="password1">
                                Off (Disabled — Anyone can access your board based on its visibility setting.)
                            </label>
                        </div>
                        <div class="alert alert-light border mt-2 py-2 small fs-6 lh-lg">
                            Enable password protection to keep your board private. Subscribers will be verified by email,
                            and only those with access will receive a secure link to view your subdomain.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @if($userTheme)
    <div class="theme-setting-wrapper border-1 p-4 rounded mt-4" style="margin-left: 19.5%; width: 64.5%;">
        <div class="theme-card d-flex flex-column flex-md-row align-items-start gap-3 rounded-bottom-circle">
            <!-- Left Image -->
            <div>
                <img src="assets/img/icon/theme-card-user.svg"
                     alt="Custom Theme"
                     class="theme-img"
                     style="width:290px; height:170px;">
                <!-- Brand Color -->
                <div class="mb-3">
                    <div class="form-input color-group border-0">
                        <label for="brand-color" class="input-label mb-1 fw-medium">Brand Color</label>
                        <div class="input-group align-items-center">
                            <div class="position-relative">

                                <!-- Circle preview (clickable) -->
                                <label for="brandColorPicker"
                                       class="position-absolute top-50 start-0 translate-middle-y ms-2 rounded-circle overflow-hidden"
                                       style="width:30px; height:30px; cursor:pointer; background-color: {{ $defaultTheme->default_color ?? old('color_hex', '#f44336') }};">
                                    <input
                                        type="color"
                                        id="brandColorPicker"
                                        class="w-100 h-100 border-0 p-0 opacity-0 cursor-pointer"
                                        value="{{ $defaultTheme->default_color ?? old('color_hex', '#f44336') }}"
                                        onchange="document.getElementById('brandColorHex').value=this.value;this.parentNode.style.backgroundColor=this.value"
                                    >
                                </label>

                                <!-- Hex field -->
                                <input id="brandColorHex"
                                       type="text"
                                       class="form-control ps-5 rounded border-[#19140035]"
                                       value="{{ $userTheme->default_color ?? old('color_hex', '#f44336') }}"
                                       onchange="document.getElementById('brandColorPicker').value=this.value;document.querySelector('label[for=brandColorPicker]').style.backgroundColor=this.value">
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary fw-semibold rounded btn-md">Active Theme</button>
            </div>

            <!-- Right Content -->
            <div class="flex-grow-1">
                <label class="form-label fw-semibold fs-5 mb-0">
                    {{ $userTheme->page_title ?? 'Customized Theme' }}
                </label>
                <p class="text-muted mb-2">{{ $userTheme->short_description ?? 'No description added' }}</p>
                <div class="mb-3">
                    <label class="form-label fw-semibold fs-5">Website Visibility</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="visibility1">
                        <label class="form-check-label" for="visibility1">
                            On — Your board is live and accessible at [subdomain]
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold fs-5">Password Protected</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="password1">
                        <label class="form-check-label" for="password1">
                            Off (Disabled — Anyone can access your board based on its visibility setting.)
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="alert alert-light border mt-2 py-2 small fs-6 lh-lg">
                        {{ $userTheme->welcome_message ?? 'No welcome message added yet.' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="theme-setting-wrapper rounded" style="margin-left: 19.5%; width: 70%;">
        <!-- Customize Button -->
        <button class="theme-btn rounded border-0 btn-sm fw-bold mt-3" data-bs-toggle="modal" data-bs-target="#customizeTheme">Customize Theme</button>
        <button class="theme-btn rounded border-0 btn-sm fw-bold mt-3" data-bs-toggle="modal" data-bs-target="#baseConfiguration">Add Base Configuration</button>
    </div>

    {{-- Include the customize modal but keep it hidden initially --}}
    @include('themes.partials.customize-modal', ['userTheme' => $defaultTheme])
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const customizeBtn = document.getElementById('customizeBtn');

            customizeBtn.addEventListener('click', function () {
                // Show confirmation prompt
                if (confirm("Are you sure you want to customize this theme?")) {
                    // If confirmed, open the customize theme modal
                    const customizeModal = new bootstrap.Modal(document.getElementById('customizeTheme'));
                    customizeModal.show();
                }
            });
        });
    </script>
@endsection
