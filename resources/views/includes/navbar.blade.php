<header class="header sticky-top bg-white">
    <div class="header-wrapper d-flex align-items-center justify-content-between gap-4 px-1f">

        <!-- Project Name / Logo -->
        <a href="{{ url('/') }}" class="header-logo logo d-inline-block">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="logo" class="h-12">
        </a>

        <!-- Right Side (Profile + Logout) -->
        <div class="profile-container d-flex align-items-center justify-content-end pb-0">

        <div class="profile d-flex align-items-center gap-0 gap-sm-3">
            @php
                $instanceClasses = [
                    'UAT' => 'bg-danger text-white',
                    'Production' => 'bg-success text-white',
                    'Staging' => 'bg-warning text-dark',
                ];
                $instance = config('app.instance');
            @endphp

            <span class="badge {{ $instanceClasses[$instance] ?? 'bg-secondary' }}">
                 {{ $instance }}
                @php
                    $instance = config('app.instance');
                @endphp

                @if($instance == 'UAT')
                    <p>User ID: {{ Auth::user()->id }}</p>
                    <p>Tenant ID: {{ Auth::user()->tenant_id }}</p>
                @endif

                </span>

            <!-- Profile Image -->
            <img src="{{ Auth::user()->profile_img ? asset('storage/' . Auth::user()->profile_img) : asset('assets/img/profile-img.png') }}" 
                alt="profile-img"
                class="profile-img rounded-circle object-fit-cover">

            <!-- User Info + Dropdown -->
            <div class="profile-wrapper d-flex align-items-end gap-2">
                <div class="profile-info">
                    <span class="d-block tracking-[0.4px]">Welcome</span>
                    <h6 class="fw-semibold capitalize mb-0">{{ Auth::user()->name }}</h6>
                </div>
                <!-- Dropdown -->
                <div class="header-dropdown dropdown">
                    <button type="button" title="action" data-bs-toggle="dropdown" aria-expanded="false"
                            class="header-dropdown-toggle dropdown-toggle d-inline-flex bg-transparent border-0">
                        <i class="fa-solid fa-caret-down"></i>
                    </button>
                    <ul class="dropdown-menu rounded-0 border-top-0 border-bottom-0">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Update Profile</a><br>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Log Out</button>
                            </form>
                        </li>
                    </ul>
                </div>


            </div>
        </div>

            <!-- Logout Button (Tooltip Icon) -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" title="Log out" data-bs-toggle="tooltip" data-bs-title="Log out"
                        class="logout-btn d-flex align-items-center justify-content-center bg-transparent border-0 ms-3">
                    <img src="{{ asset('assets/img/icon/logout.svg') }}" alt="logo" class="h-7">
                </button>
            </form>
        </div>
    </div>
</header>
