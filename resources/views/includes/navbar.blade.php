<!-- Instance Bar (keep this part as in your old code) -->
<div id="instance" style="width: 100%;">
    @php
        $instanceClasses = [
            'UAT' => 'bg-danger text-white',
            'Production' => 'bg-success text-white',
            'Staging' => 'bg-warning text-dark',
        ];
        $instance = config('app.instance');
        $class = $instanceClasses[$instance] ?? '';
        $user = Auth::user();
    @endphp

    @if($instance == 'UAT' && $user)
        <div class="{{ $class }}">
            <p class="text-center p-2">
                {{ $instance }} - User ID: {{ $user->id }}, Client ID: {{ $user->tenant_id }}, Tenant ID: {{ $user->tenant_id }}
            </p>
        </div>
    @endif
</div>

<!-- header section start -->
<header class="header sticky-top bg-white" style="padding-left: 10px">
    <div class="header-wrapper d-flex align-items-center justify-content-between gap-4 px-3">

        <!-- Left icon -->
        <div class="d-inline-block">
            <ul class="d-flex mb-0">
                @if(isset($user) && $user->quick_setup == '0')
                    <li class="sidebar-menu-item">
                        <a href="{{ route('guide_setup') }}"
                           data-bs-toggle="tooltip"
                           data-bs-placement="bottom"
                           title="Quick Setup"
                           class="{{ request()->routeIs('guide_setup') ? 'active text-primary' : 'text-gray-600' }}">
                            <img src="/assets/img/icon/home.png" alt="home" class="sidebar-menu-link-icon flex-shrink-0">
                        </a>
                    </li>
                @endif
                    <li class="sidebar-menu-item">
                        <a href="{{ route('dashboard', ['tenant' => Auth::user()->tenant->custom_url]) }}"
                           data-bs-toggle="tooltip"
                           data-bs-placement="bottom"
                           title="Dashboard"
                           class="sidebar-menu-link d-flex {{ request()->routeIs('dashboard') ? 'active text-blue-600' : 'text-gray-600' }}">
                            <img src="/assets/img/icon/home.png" alt="home" class="sidebar-menu-link-icon flex-shrink-0">
                        </a>
                    </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('announcement.list') }}"
                       data-bs-toggle="tooltip"
                       data-bs-placement="bottom"
                       title="Announcement Listing"
                       class="sidebar-menu-link d-flex align-items-center {{ request()->routeIs('announcement.*') ? 'active text-blue-600' : 'text-gray-600' }}">
                        <img src="/assets/img/icon/megaphone.png" alt="megaphone" class="sidebar-menu-link-icon flex-shrink-0">
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#"
                       data-bs-toggle="tooltip"
                       data-bs-placement="bottom"
                       title="Feedback Listing"
                       class="sidebar-menu-link d-flex align-items-center">
                        <img src="/assets/img/icon/feedback.png" alt="feedback" class="sidebar-menu-link-icon flex-shrink-0">
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#"
                       data-bs-toggle="tooltip"
                       data-bs-placement="bottom"
                       title="RoadMap Listing"
                       class="sidebar-menu-link d-flex align-items-center">
                        <img src="/assets/img/icon/roadmap.png" alt="roadmap" class="sidebar-menu-link-icon flex-shrink-0">
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#"
                       data-bs-toggle="tooltip"
                       data-bs-placement="bottom"
                       title="Feedback Listing"
                       class="sidebar-menu-link d-flex align-items-center">
                        <img src="/assets/img/icon/star-comment.png" alt="star-comment" class="sidebar-menu-link-icon flex-shrink-0">
                    </a>
                </li>
                <li class="sidebar-menu-item">

                    <a href="{{ route('board.index') }}"
                       data-bs-toggle="tooltip"
                       data-bs-placement="bottom"
                       title="Board Listing"
                       class="sidebar-menu-link d-flex align-items-center {{ request()->routeIs('kbboard.*') ? 'active text-blue-600' : 'text-gray-600' }}">
                        <img src="/assets/img/icon/book.png" alt="megaphone" class="sidebar-menu-link-icon flex-shrink-0">
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#"
                       data-bs-toggle="tooltip"
                       data-bs-placement="bottom"
                       title="Research Listing"
                       class="sidebar-menu-link d-flex align-items-center">
                        <img src="/assets/img/icon/research-repository.svg" alt="research-repository" class="sidebar-menu-link-icon flex-shrink-0">
                    </a>
                </li>
            </ul>
        </div>

        <!-- Right icon & Profile -->
        <div class="gap15 d-flex align-items-center justify-content-end pb-0">

            <div class="d-flex align-items-center gap-3">
                <!-- Add Dropdown -->
                <div class="header-dropdown dropdown">
                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false"
                            class="align-baseline header-dropdown-toggle dropdown-toggle text-white theme-btn sm fw-semibold rounded border-0">
                        Add
                    </button>
                    <ul class="dropdown-menu mt-15px rounded-0 border-top-0 border-bottom-0">
                        <li><a class="dropdown-item" href="{{ route('changelog.create')}}" >Add @customLabel('Announcement')</a></li>
                        <li><a class="dropdown-item" href="#">New Article</a></li>
                        <li><a class="dropdown-item" href="#">New Testimonial</a></li>
                        <li><a class="dropdown-item" href="#">New Feedback</a></li>
                        <li><a class="dropdown-item" href="#">New Research Board</a></li>
                    </ul>
                </div>

                <!-- Action icon -->
                <a href="#"><img src="{{ asset('assets/img/icon/window.svg') }}" alt="Window"></a>
                <a href="#"><img src="{{ asset('assets/img/icon/dashboard.svg') }}" alt="Dashboard"></a>
                <a href="#"><img src="{{ asset('assets/img/icon/gear.svg') }}" alt="Settings"></a>
            </div>

            <!-- Profile Dropdown -->
            @if($user)
                <div class="d-flex align-items-center gap-3 pl-4">
                    <div class="header-dropdown dropdown">
                        <div class="profile-wrapper d-flex align-items-center gap-2" role="button"
                             data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ $user->profile_img ? asset('storage/' . $user->profile_img) : asset('assets/img/icon/profile.svg') }}"
                                 alt="profile-img" class="rounded-circle object-fit-cover" style="width: 35px; height: 35px;">

                            <div class="profile-info">
                                <h6 class="fw-semibold mb-0">{{ $user->name }}</h6>
                            </div>

                            <button type="button" class="align-baseline header-dropdown-toggle dropdown-toggle d-inline-flex bg-transparent border-0">
                                <i class="fa-solid fa-caret-down"></i>
                            </button>
                        </div>

                        <ul class="dropdown-menu rounded-0 border-top-0 border-bottom-0">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">My Profile</a></li>
                            <li><a class="dropdown-item" href="#">Change Password</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif

        </div>
    </div>
</header>
<!-- header section end -->
