@extends('layouts.app')

@section('content')
    <section class="section-content-center w-100 listing-changelog main-content-wrapper p-0">
        <div class="d-flex justify-content-between mb-3">
            <h4 class="fw-medium font-16">Theme Settings</h4>
            <div class="btn-wrapper d-flex align-items-center justify-content-center gap-2 flex-wrap">
                <a href="{{ route('app.settings') }}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-flex align-items-center gap-2">
                    <img src="{{ asset('assets/img/chevron-left.svg') }}" alt="Back" class="align-text-bottom">
                    Back to App Settings
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
                            @endphp

                                <!-- Single Form Wrapper -->
                            <form id="customizeThemeForm"
                                  method="POST"
                                  action="{{ route('themes.customize') }}"
                                  enctype="multipart/form-data"
                                  class="form">
                                @csrf

                                <div class="theme-list">
                                    @php
                                        // Use userTheme if exists, otherwise defaultTheme
                                        $themeToShow = $userTheme ?? $defaultTheme;
                                    @endphp

                                    @if ($themeToShow)
                                        <div class="theme-card d-flex mb-3 flex-column flex-md-row align-items-start gap-0 rounded border py-2 px-2">
                                            <!-- Radio for selection (optional, can remove if only one theme) -->
                                            <div class="form-check mt-2 ms-2">
                                                <input class="form-check-input"
                                                       type="radio"
                                                       name="theme_id"
                                                       value="{{ $themeToShow->id }}"
                                                       id="themeSelect_{{ $themeToShow->id }}"
                                                       checked>
                                            </div>

                                            <!-- Theme Preview -->
                                            <div class="p-2 flex-shrink-0" style="width: 300px;">
                                                <div class="theme-preview position-relative overflow-hidden rounded" style="width:100%; height:150px;">
                                                    @if(!empty($themeToShow->feature_banner))
                                                        <img src="{{ asset('storage/' . $themeToShow->feature_banner) }}"
                                                             alt="banner"
                                                             class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover">
                                                    @else
                                                        <img src="{{ asset($themeToShow->theme_image ?? 'assets/img/icon/theme-card-user.svg') }}"
                                                             alt="{{ $themeToShow->theme_title }}"
                                                             class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover">
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Details -->
                                            <div class="flex-grow-1">
                                                <h6 class="fw-bold mb-0 mt-1">{{ $themeToShow->theme_title }}</h6>
                                                <p class="text-muted mb-2" style="height: 70px;">
                                                    {{ $themeToShow->short_description ?? $themeToShow->description }}
                                                </p>

                                                <!-- Trigger Buttons -->
                                                <div class="mt-8">
                                                    <a href="#"
                                                       class="widget-item-btn mb-1 text-primary bg-white d-inline-block rounded fw-normal font-12"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#contentSettings_{{ $themeToShow->id }}">
                                                        Content Settings
                                                    </a>
                                                    <a href="#"
                                                       class="widget-item-btn mb-1 text-primary bg-white d-inline-block rounded fw-normal font-12"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#themeSettings_{{ $themeToShow->id }}">
                                                        Theme Settings
                                                    </a>
                                                    <a href="#"
                                                       class="widget-item-btn mb-1 text-primary bg-white d-inline-block rounded fw-normal font-12"
                                                       data-bs-toggle="modal"
                                                       data-bs-target="#analyticsSettings_{{ $themeToShow->id }}">
                                                        Analytics Settings
                                                    </a>
                                                </div>
                                            </div>

                                            @include('themes.partials.customize-modal', ['theme' => $themeToShow])
                                            @include('themes.partials.content-model', ['theme' => $themeToShow])
                                            @include('themes.partials.analytic-model', ['theme' => $themeToShow])
                                        </div>
                                    @endif
                                </div>
                                <div class="basic-information my-2">
                                    <div class="form-condition-container border-bottom-0 mb-0 pb-0">
                                        @php
                                            $subdomain = $tenant->custom_url ?? 'mysubdomain';
                                            $domain = $mainDomain ?? 'domainname.com';
                                            $url = "http://{$subdomain}.{$domain}/announcementlist";
                                            $urlroot = "http://{$subdomain}.{$domain}";
                                        @endphp

                                        @if(isset($userTheme) && $userTheme->is_visible == 1)
                                            <span class="label fw-medium" style="color: #CBD5E1;">
                                            Subdomain is available at
                                            <a href="{{ $url }}" target="_blank">{{ $urlroot }}</a>
                                        </span>
                                                                    @else
                                                                        <span class="label fw-medium" style="color: #F87171;"> <!-- red text for not published -->
                                            Subdomain Not Available Yet.
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <!-- Footer Save Button -->
                                <div class="card-footer gap15 bg-white d-flex justify-content-start border-top"
                                     style="margin-left: -16px; margin-right: -16px; padding: 12px 16px;">
                                    <button type="submit" id="saveThemeBtn" class="theme-btn sm fw-semibold rounded d-inline-block">
                                        Save & Finish
                                    </button>
                                    <a href="{{route('themes.index')}}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Cancel</a>
                                </div>
                            </form>
                            <!-- End Form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
