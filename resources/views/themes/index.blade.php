@extends('layouts.app')

@section('content')
    <section class="section-content-center w-100 listing-changelog main-content-wrapper p-0">
        <div class="d-flex justify-content-between mb-3">
            <h4 class="fw-medium font-16">Theme Settings</h4>
            <div class="btn-wrapper d-flex align-items-center justify-content-center gap-2 flex-wrap">
                <a href="{{ route('app.settings') }}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-flex align-items-center gap-2">
                    <img src="{{ asset('assets/img/chevron-left.svg') }}" alt="Back" class="align-text-bottom">
                    Back to Listing Page
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 view-changelog-details">
                <div class="card p-0 bg-white mb-3">
                    <div class="d-flex align-items-center border-title justify-content-between px-3 py-2">
                        <h4 class="fw-medium mb-0">Themes & Settings</h4>
                    </div>

                    <div class="mx-auto px-3">
                        <div class="basic-information">
                            <p class="label color-support fw-medium my-4">
                                Make your board truly yours. Pick a theme that matches your brand’s style — you can always change it later.
                            </p>

                            <div class="card card-badge modal-note-card mb-3">
                                <p class="mb-0 fw-medium text-primary label">
                                    You can rename modules to match your business language. For example, change “Changelog” to “Announcements” or “Knowledge Board” to “Help Center.”
                                </p>
                            </div>
                            @php
                                $defaultTheme = $themes->first();
                                $activeTheme = $userTheme ?? $defaultTheme;
                            @endphp
                            <form id="customizeThemeForm_{{ $activeTheme->id }}"
                                  method="POST"
                                  action="{{ route('themes.customize') }}"
                                  enctype="multipart/form-data"
                                  class="form">
                                @csrf
                                <input type="hidden" name="theme_id" value="{{ $activeTheme->id }}">
                                <input type="hidden" name="theme_title" value="{{ $activeTheme->theme_title }}">
                                <input type="hidden" name="short_description" value="{{ $activeTheme->short_description ?? $activeTheme->description }}">
                                <input type="hidden" name="welcome_message" value="{{ $activeTheme->welcome_message }}">
                                <input type="hidden" name="theme_flag" value="{{ $activeTheme->theme_flag ?? 0 }}">

                                <!-- Theme Card Display -->
                                <div class="theme-card d-flex mb-3 flex-column flex-md-row align-items-start gap-0 rounded border py-2">
                                    <!-- Left Image -->
                                    <div class="p-2 w-75">
                                        @if(!empty($userTheme->feature_banner))
                                            <div class="img-block position-relative">
                                                <img src="{{ asset('storage/' . $userTheme->feature_banner) }}"
                                                     alt="banner"
                                                     class="theme-banner object-fit-cover rounded">
                                            </div>
                                        @else
                                            <img src="{{ asset($activeTheme->theme_image ?? 'assets/img/icon/theme-card-user.svg') }}"
                                                 alt="{{ $activeTheme->theme_title }}"
                                                 class="theme-banner object-fit-cover rounded w-100">
                                        @endif
                                    </div>

                                    <!-- Right Content -->
                                    <div class="flex-grow-1">
                                        <p class="theme-header fw-bold mb-0 mt-1">{{ old('theme_title', $userTheme->theme_title ?? $defaultTheme->theme_title) }}</p>
                                        <p class="text-muted mb-2">
                                            {{ old('theme_title', $userTheme->description ?? $defaultTheme->short_description) }}
                                        </p>

                                        <!-- Trigger Buttons -->
                                        <div class="mt-8">
                                        <a href="#"
                                           class="widget-item-btn mb-1 text-primary bg-white d-inline-block rounded fw-normal font-12"
                                           data-bs-toggle="modal"
                                           data-bs-target="#themeSettings_{{ $activeTheme->id }}">
                                            Theme Settings
                                        </a>

                                            <a href="#"
                                               class="widget-item-btn mb-1 text-primary bg-white d-inline-block rounded fw-normal font-12"
                                               data-bs-toggle="modal"
                                               data-bs-target="#contentSettings_{{ $activeTheme->id }}">
                                                Content Settings
                                            </a>

                                            <a href="#"
                                               class="widget-item-btn mb-1 text-primary bg-white d-inline-block rounded fw-normal font-12"
                                               data-bs-toggle="modal"
                                               data-bs-target="#analyticsSettings_{{ $activeTheme->id }}">
                                                Analytics Settings
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="basic-information mt-10px mb-2">
                                    <div class="form-condition-container border-bottom-0 mb-0 pb-0">
                                        <span class="label fw-medium" style="color: #CBD5E1;">Click Save & Finish to Update User Theme</span>

                                    </div>
                                </div>
                            @include('themes.partials.customize-modal', ['theme' => $activeTheme])
                            @include('themes.partials.content-model', ['theme' => $activeTheme])
                            @include('themes.partials.analytic-model', ['theme' => $activeTheme])
                        </div>
                    </div>

                    <div class="card-footer gap15 px-3 bg-light min-height-66 d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary fw-semibold rounded btn-md" style="width: 245px;">
                            Save & Finish
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection

