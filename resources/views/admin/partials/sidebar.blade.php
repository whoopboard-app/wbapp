<style>
    .sub-nav-link {
        text-decoration: none !important;
    }

    #sidebar-scroll {
    height: 100vh;
    overflow-y: auto;
    transition: all 0.3s ease;
}

/* 🧠 When menu is condensed */
html[data-menu-size="condensed"] #sidebar-scroll {
    overflow: visible !important; /* allow submenu flyouts */
}

/* Also make sure SimpleBar doesn’t clip content */
html[data-menu-size="condensed"] .simplebar-content-wrapper {
    overflow: visible !important;
}
  
</style>
<div class="main-nav">
    <!-- Sidebar Logo -->
    <div class="logo-box">
        <a href="{{ route('admin.dashboard') }}" class="logo-dark">
            <img src="{{ asset('assets/admin/images/logo-sm.png') }}" class="logo-sm" alt="logo sm">
            <img src="{{ asset('assets/admin/images/logo-dark.png') }}" class="logo-lg" alt="logo dark">
        </a>

        <a href="{{ route('admin.dashboard') }}" class="logo-light">
            <img src="{{ asset('assets/admin/images/logo-sm.png') }}" class="logo-sm" alt="logo sm">
            <img src="{{ asset('assets/admin/images/logo-light.png') }}" class="logo-lg" alt="logo light">
        </a>
    </div>

    <!-- Menu Toggle Button (sm-hover) -->
    <button type="button" class="button-sm-hover" aria-label="Show Full Sidebar">
        <iconify-icon icon="solar:hamburger-menu-broken" class="button-sm-hover-icon"></iconify-icon>
    </button>

    <div class="scrollbar" data-simplebar id="sidebar-scroll">
        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title">Menu</li>

            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <span class="nav-icon">
                        <iconify-icon icon="solar:widget-5-bold-duotone"></iconify-icon>
                    </span>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#clients" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="clients">
                    <span class="nav-icon">
                        <iconify-icon icon="teenyicons:users-solid"></iconify-icon>
                    </span>
                    <span class="nav-text">Clients</span>
                </a>
                <div class="collapse" id="clients">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link no-underline" href="#">Clients</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="#">Client on Hold</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="#">Client Verification</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="nav-icon">
                        <iconify-icon icon="streamline-plump:announcement-megaphone-solid"></iconify-icon>
                    </span>
                    <span class="nav-text">Announcement</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="nav-icon">
                        <iconify-icon icon="dashicons:feedback"></iconify-icon>
                    </span>
                    <span class="nav-text">Feedback</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="nav-icon">
                        <iconify-icon icon="carbon:roadmap"></iconify-icon>
                    </span>
                    <span class="nav-text">Product Roadmap</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="nav-icon">
                        <iconify-icon icon="dashicons:testimonial"></iconify-icon>
                    </span>
                    <span class="nav-text">Testimonials</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="nav-icon">
                        <iconify-icon icon="carbon:ibm-watson-knowledge-studio"></iconify-icon>
                    </span>
                    <span class="nav-text">Knowledge Board</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="nav-icon">
                        <iconify-icon icon="game-icons:archive-research"></iconify-icon>
                    </span>
                    <span class="nav-text">Research Repo</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="nav-icon">
                        <iconify-icon icon="fa7-solid:list"></iconify-icon>
                    </span>
                    <span class="nav-text">Subscribe List</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="nav-icon">
                        <iconify-icon icon="ph:line-segments-bold"></iconify-icon>
                    </span>
                    <span class="nav-text">Subscribe Segmentation</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="nav-icon">
                        <iconify-icon icon="material-symbols-light:personal-injury"></iconify-icon>
                    </span>
                    <span class="nav-text">Personas</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="nav-icon">
                        <iconify-icon icon="icon-park-outline:mind-mapping"></iconify-icon>
                    </span>
                    <span class="nav-text">Journey Mapping</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-arrow" href="#appSettings" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="appSettings">
                    <span class="nav-icon">
                        <iconify-icon icon="material-symbols:settings-rounded"></iconify-icon>
                    </span>
                    <span class="nav-text">App Settings</span>
                </a>
                <div class="collapse" id="appSettings">
                    <ul class="nav sub-navbar-nav">
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="#">Admin User</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="#">SMTP Service</a>
                        </li>
                        <li class="sub-nav-item">
                            <a class="sub-nav-link" href="#">Modular Component</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
