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
            <p class="text-center p-2 mb-0">
                {{ $instance }} - User ID: {{ $user->id }}, Client ID: {{ $user->tenant_id }}, Tenant ID: {{ $user->tenant_id }}
            </p>
        </div>
    @endif
    @php
        $isGuideSetup = request()->is('guide_setup*'); // true if current page is guide_setup
    @endphp
</div>

<!-- header section start -->
<header class="header sticky-top bg-white" style="padding-left: 18px">
    <div class="header-wrapper d-flex align-items-center justify-content-between gap-4">

        <!-- Left icon -->
        @if(
            ($user->user_type == 1 && isset($user->onboarding) && $user->onboarding->completed != '0')
            || ($user->user_type != 1)
        )
        <div class="d-inline-block">
            <ul class="d-flex mb-0">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('dashboard', ['tenant' => Auth::user()->tenant->custom_url]) }}"
                           data-bs-toggle="tooltip"
                           data-bs-placement="bottom"
                           title="Dashboard"
                           class="sidebar-menu-link d-flex align-items-center
                           {{(request()->routeIs('dashboard') ? 'active text-blue-600' : 'text-gray-600') }}">
                        <img src="/assets/img/icon/home.png" alt="home" class="sidebar-menu-link-icon flex-shrink-0">
                        </a>
                    </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('announcement.list') }}"
                       data-bs-toggle="tooltip"
                       data-bs-placement="bottom"
                       title=" @customLabel('Announcement') Listing"
                       class="sidebar-menu-link d-flex align-items-center
                       {{ request()->routeIs('announcement.*') ? 'active text-blue-600' : 'text-gray-600' }}">
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
                       class="sidebar-menu-link d-flex align-items-center {{ request()->is('kbboards*') ? 'active text-blue-600' : 'text-gray-600' }}">
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
                <li class="sidebar-menu-item">
                    <a href="{{ route('subscribe.index') }}"
                       data-bs-toggle="tooltip"
                       data-bs-placement="bottom"
                       title="Subscribe Listing"
                       class="sidebar-menu-link d-flex align-items-center {{ request()->routeIs('subscribe.*') ? 'active text-blue-600' : 'text-gray-600' }}">
                        <img src="{{ asset('assets/img/icon/list.svg') }}" alt="subscribelist" class="sidebar-menu-link-icon flex-shrink-0">
                    </a>
                </li>
            </ul>
        </div>
        @else
            <h4 class="fw-semibold mb-0 text-lg pl-6">Welcome {{$user->name}} ! Finish setting you account</h4>
        @endif
        <!-- Right icon & Profile -->

        <div class="gap15 d-flex align-items-center justify-content-end pb-0">

            <div class="d-flex align-items-center gap-3">
                <!-- Add Dropdown -->
                @if(
                    ($user->user_type == 1 && isset($user->onboarding) && $user->onboarding->completed != '0')
                    || ($user->user_type != 1)
                )
                <div class="header-dropdown dropdown">
                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false"
                            class="align-baseline header-dropdown-toggle dropdown-toggle text-white theme-btn rounded border-0 w-100 py-1">
                        Add
                    </button>
                    <ul class="dropdown-menu rounded-0 border-top-0 border-bottom-0">
                        <li><a class="dropdown-item" href="{{ route('changelog.create')}}" >Add @customLabel('Announcement')</a></li>
                        <li><a class="dropdown-item" href="{{ route('kbarticle.create') }}">New Article</a></li>
                        <li><a class="dropdown-item" href="#">New Testimonial</a></li>
                        <li><a class="dropdown-item" href="#">New Feedback</a></li>
                        <li><a class="dropdown-item" href="{{route('board.create')}}">New @customLabel('Knowledge Board')</a></li>
                    </ul>
                </div>

                <!-- Action icon -->
                <a href="#"><img src="{{ asset('assets/img/icon/team.svg') }}" alt="team"></a>
                <a href="#"><img src="{{ asset('assets/img/icon/dashboard.svg') }}" alt="Dashboard"></a>



                    <ul class="d-flex mb-0">
                        <li class="sidebar-menu-item">
                            <a href="{{ route('app.settings') }}"
                               data-bs-toggle="tooltip"
                               data-bs-placement="bottom"
                               title="Settings"
                               class="sidebar-menu-link d-flex align-items-center
                           {{ $isGuideSetup ? 'text-gray-400 pointer-events-none' : (request()->routeIs('app.settings') ? 'active text-blue-600' : 'text-gray-600') }}">
                                <img src="{{ asset('assets/img/icon/gear.svg') }}" alt="Settings" class="sidebar-menu-link-icon flex-shrink-0">
                            </a>
                        </li>
                    </ul>
            </div>
            @endif

            <!-- Profile Dropdown -->
            @if($user)
                <div class="d-flex align-items-center gap-3 pl-4">
                    <div class="header-dropdown dropdown">
                        <div class="profile-wrapper d-flex align-items-center gap-2" role="button"
                             data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ Auth::user()->profile_img ? asset('storage/' . Auth::user()->profile_img) : asset('assets/img/profile-img.png') }}"
                                 alt="profile-img"
                                 class="profile-img rounded-circle object-fit-cover">

                            <div class="profile-info">
                                <h6 class="fw-semibold mb-0">{{ $user->name }}</h6>
                            </div>

                            <button type="button" class="align-baseline header-dropdown-toggle dropdown-toggle d-inline-flex bg-transparent border-0">
                                <i class="fa-solid fa-caret-down"></i>
                            </button>
                        </div>

                        <ul class="dropdown-menu rounded-0 border-top-0 border-bottom-0">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">My Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit', ['tab' => 'password']) }}">Change Password</a></li>
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
