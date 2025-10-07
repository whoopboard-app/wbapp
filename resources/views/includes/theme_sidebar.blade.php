<aside class="sidebar sticky-top overflow-auto bg-white flex-shrink-0" style="width: 270px;height: auto">
    <div class="sidebar-header sticky-top text-end d-xl-none p-3">
        <button type="button" title="close sidebar" class="sidebar-toggle bg-transparent border-0 fs-5">
            <img src="{{ asset('assets/img/icons/close.svg') }}" alt="Close">
        </button>
    </div>

    <div class="sidebar-menu d-flex flex-column align-items-center justify-content-start px-3">
        <div class="sidebar-menu-block text-center w-100">
            <!-- Feature Banner -->
            <img src="{{ asset('storage/' . $theme->feature_banner) }}"
                 alt="Feature Banner"
                 class="img-fluid rounded w-100"
                 style="max-width: 230px;">

            <!-- Member Login Button -->
            <a href="#"
               class="theme-btn d-inline-block w-100 mt-3 secondary rounded border fw-semibold"
               style="max-width: 230px;">
                Member Login
            </a>

            <!-- Search Box -->
            <div class="position-relative form-group mt-3 mx-auto" style="max-width: 230px;">
                <input type="search"
                       class="input-field w-100 rounded ps-5 bg-light"
                       placeholder="Search">
                {{-- <img src="{{ asset('assets/img/icon/search.svg') }}" class="position-absolute search-icon" alt=""> --}}
            </div>
        </div>

        <style>
            .sidebar-menu .sidebar-menu-link {
                padding: 8px 12px 8px 10px !important;
            }
        </style>

        <!-- Navigation Section -->
        <div class="sidebar-menu-block w-100" style="max-width: 230px;">
            <h6 class="sidebar-menu-title fw-semibold text-uppercase">Quick Links</h6>
            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-item">
                    <a href="{{ route('announcement.list') }}"
                       class="sidebar-menu-link d-flex align-items-center {{ request()->routeIs('announcement.*') ? 'active text-blue-600' : 'text-gray-600' }}">
                        <img src="/assets/img/icon/megaphone.png" alt="megaphone" class="sidebar-menu-link-icon flex-shrink-0">
                        <span class="sidebar-menu-link-text">@customLabel('Announcement')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-menu-link d-flex align-items-center">
                        <img src="/assets/img/icon/feedback.png" alt="feedback" class="sidebar-menu-link-icon flex-shrink-0">
                        <span class="sidebar-menu-link-text">@customLabel('Feedback')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-menu-link d-flex align-items-center">
                        <img src="/assets/img/icon/roadmap.png" alt="roadmap" class="sidebar-menu-link-icon flex-shrink-0">
                        <span class="sidebar-menu-link-text">@customLabel('Product Road Map')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-menu-link d-flex align-items-center">
                        <img src="/assets/img/icon/star-comment.png" alt="star-comment" class="sidebar-menu-link-icon flex-shrink-0">
                        <span class="sidebar-menu-link-text">@customLabel('Testimonials')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('board.index') }}"
                       class="sidebar-menu-link d-flex align-items-center {{ request()->routeIs('kbboard.*') ? 'active text-blue-600' : 'text-gray-600' }}">
                        <img src="/assets/img/icon/book.png" alt="megaphone" class="sidebar-menu-link-icon flex-shrink-0">
                        <span class="sidebar-menu-link-text">@customLabel('Knowledge Board')</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-menu-link d-flex align-items-center">
                        <img src="/assets/img/icon/research-repository.svg" alt="research-repository" class="sidebar-menu-link-icon flex-shrink-0">
                        <span class="sidebar-menu-link-text">@customLabel('Research Repo')</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Resources Section -->
        <div class="sidebar-menu-block mt-4 w-100" style="max-width: 230px;">
            <h6 class="sidebar-menu-title fw-semibold text-uppercase">Resources</h6>
            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-menu-link d-flex align-items-center">
                        <img src="{{ asset('assets/img/icon/list.png') }}" alt="list" class="sidebar-menu-link-icon flex-shrink-0">
                        <span class="sidebar-menu-link-text">Technical Notes</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-menu-link d-flex align-items-center">
                        <img src="{{ asset('assets/img/icon/list.png') }}" alt="user avatar" class="sidebar-menu-link-icon flex-shrink-0">
                        <span class="sidebar-menu-link-text">Getting Started</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-menu-link d-flex align-items-center">
                        <img src="{{ asset('assets/img/icon/list.png') }}" alt="user avatar" class="sidebar-menu-link-icon flex-shrink-0">
                        <span class="sidebar-menu-link-text">Guide</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-menu-link d-flex align-items-center">
                        <img src="{{ asset('assets/img/icon/list.png') }}" alt="user avatar" class="sidebar-menu-link-icon flex-shrink-0">
                        <span class="sidebar-menu-link-text">Resource Center</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="sidebar-menu-block">
            <h6 class="sidebar-menu-title fw-semibold text-uppercase px-0">Follow & Visit</h6>
            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-item">
                    <a href="#" class="d-inline-block"><img src="{{ asset('assets\img\icon\facebook.svg') }}" alt="facebook"></a>
                    <a href="#" class="d-inline-block"><img src="{{ asset('assets\img\icon\youtube.svg') }}" alt=""></a>
                    <a href="#" class="d-inline-block"><img src="{{ asset('assets\img\icon\x.svg') }}" alt=""></a>
                    <a href="#" class="d-inline-block"><img src="{{ asset('assets\img\icon\instagram.svg') }}" alt=""></a>
                    <a href="#" class="d-inline-block"><img src="{{ asset('assets\img\icon\linkedin.svg') }}" alt=""></a>
                </li>

            </ul>
        </div>
    </div>
</aside>
