<header class="topbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <div class="d-flex align-items-center gap-2">
                <!-- Menu Toggle Button -->
                <div class="topbar-item">
                    <button type="button" class="button-toggle-menu topbar-button">
                        <iconify-icon icon="solar:hamburger-menu-broken" class="fs-24 align-middle"></iconify-icon>
                    </button>
                </div>

                <!-- App Search-->
                <form class="app-search d-none d-md-block me-auto">
                    <div class="position-relative">
                        <input type="search" class="form-control" placeholder="Search..." autocomplete="off">
                        <iconify-icon icon="solar:magnifer-broken" class="search-widget-icon"></iconify-icon>
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center gap-1">
                <!-- Theme Setting -->
                <div class="topbar-item d-none d-md-flex">
                    <button type="button" class="topbar-button" id="theme-settings-btn"
                        data-bs-toggle="offcanvas" data-bs-target="#theme-settings-offcanvas"
                        aria-controls="theme-settings-offcanvas">
                        <iconify-icon icon="solar:settings-bold-duotone" class="fs-24 align-middle"></iconify-icon>
                    </button>
                </div>

                <!-- User -->
                <div class="dropdown topbar-item">
                    <a type="button" class="topbar-button" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle" width="32"
                                src="{{ asset('assets/admin/images/users/avatar-1.jpg') }}" alt="avatar">
                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end">
                        <h6 class="dropdown-header">Welcome, {{ auth('admin')->user()->first_name ?? 'Admin' }}!</h6>

                        <a class="dropdown-item" href="#">
                            <iconify-icon icon="solar:calendar-bold-duotone"
                                class="align-middle me-2 fs-18"></iconify-icon>
                            <span class="align-middle">My Schedules</span>
                        </a>

                        <a class="dropdown-item" href="#">
                            <iconify-icon icon="solar:wallet-bold-duotone"
                                class="align-middle me-2 fs-18"></iconify-icon>
                            <span class="align-middle">Pricing</span>
                        </a>

                        <a class="dropdown-item" href="#">
                            <iconify-icon icon="solar:help-bold-duotone"
                                class="align-middle me-2 fs-18"></iconify-icon>
                            <span class="align-middle">Help</span>
                        </a>

                        <div class="dropdown-divider my-1"></div>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <iconify-icon icon="solar:logout-3-bold-duotone"
                                    class="align-middle me-2 fs-18"></iconify-icon>
                                <span class="align-middle">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
