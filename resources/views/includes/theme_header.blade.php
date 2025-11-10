<header class="header sticky-top">
    <div class="header-wrapper d-flex align-items-center justify-content-between gap-4">
        <div class="header-left d-flex align-items-center gap-3">
            <h5 class="fw-semibold mb-0">Announcement</h5>
            <img src="{{ asset('assets/img/mobile-logo.svg') }}" class="mobile-logo d-none" alt="Logo">
        </div>

        <div class="profile-container d-flex align-items-center justify-content-end pb-0">
            <div class="profile-wrapper d-flex align-items-end gap-2">
                <div class="d-inline-block buttons-group">
                   
                    <a href="#" class="theme-btn rounded sm border-0 fw-semibold">Suggest a Feature</a>
                    <a href="#" class="theme-btn secondary sm rounded fw-semibold mx-1">
                        <i class="fa fa-plus"></i> New Discussion
                    </a>
                     <a href="{{ route('subscribe.create', ['subdomain' => $tenant->custom_url]) }}" class="theme-btn rounded sm border-0 fw-semibold">Subscribe Signup</a>

                    <a href="#" class="theme-btn secondary sm rounded fw-semibold">Get Help</a>
                </div>
                <button type="button" title="toggle sidebar" class="sidebar-toggle bg-transparent border-0 fs-5 d-xl-none">
                    <img src="{{ asset('assets/img/icons/toggle.svg') }}" alt="Toggle">
                </button>
            </div>
        </div>
    </div>
</header>
