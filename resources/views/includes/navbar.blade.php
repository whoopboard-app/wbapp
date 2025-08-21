<header class="header sticky-top bg-white shadow">
    <div class="header-wrapper d-flex align-items-center justify-content-between gap-4 px-4 py-2">

        <!-- Project Name / Logo -->
        <a href="{{ url('/') }}" class="header-logo logo d-inline-block">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="logo" class="h-8">
        </a>

        <!-- Right Side (Profile + Logout) -->
        <div class="profile-container d-flex align-items-center justify-content-end pb-0">

            <div class="profile d-flex align-items-center gap-0 gap-sm-3">
                <!-- Profile Image -->
                <img src="{{ asset('assets/img/profile-img.png') }}" alt="profile-img"
                     class="profile-img rounded-circle object-fit-cover">

                <!-- User Info + Dropdown -->
                <div class="profile-wrapper d-flex align-items-end gap-2">
                    <div class="profile-info">
                        <span class="d-block">Welcome</span>
                        <h6 class="fw-semibold mb-0">{{ Auth::user()->name }}</h6>
                    </div>
                    <!-- Dropdown -->
                    <div class="header-dropdown dropdown">
                        <button type="button" title="action" data-bs-toggle="dropdown" aria-expanded="false"
                                class="header-dropdown-toggle dropdown-toggle d-inline-flex bg-transparent border-0">
                            <i class="fa-solid fa-caret-down"></i>
                        </button>
                        <ul class="dropdown-menu rounded-0 border-top-0 border-bottom-0">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Update Profile</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>

                    <!-- Logout Button (Tooltip Icon) -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" title="Log out" data-bs-toggle="tooltip" data-bs-title="Log out"
                                class="logout-btn d-flex align-items-center justify-content-center bg-transparent border-0 ms-3">
                            <i class="fa-regular fa-arrow-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>
