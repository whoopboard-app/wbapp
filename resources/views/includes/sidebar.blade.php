<aside class="sidebar sticky-top overflow-auto bg-white flex-shrink-0">
    <div class="sidebar-header sticky-top text-end d-xl-none p-3">
        <button type="button" title="close sidebar" class="sidebar-toggle bg-transparent border-0 fs-5"><i class="fa-regular fa-xmark"></i></button>
    </div>
    <div class="sidebar-menu d-flex flex-column">
        <div class="sidebar-menu-block">
            <h6 class="sidebar-menu-title fw-semibold text-uppercase">Navigation</h6>
            <ul class="sidebar-menu-list">
                @if(isset($user) && $user->quick_setup == '0')
                <li class="sidebar-menu-item">
                    <a href="{{ route('guide_setup') }}"
                       class="sidebar-menu-link d-flex align-items-center {{ request()->routeIs('guide_setup') ? 'active text-primary' : 'text-gray-600' }}">
                        <img src="/assets/img/icon/home.png" alt="home" class="sidebar-menu-link-icon flex-shrink-0">
                        <span class="sidebar-menu-link-text">Quick Setup</span>
                    </a>
                </li>
                @endif
                <li class="sidebar-menu-item">
                    <a href="{{ route('dashboard', ['tenant' => Auth::user()->tenant->custom_url]) }}"
                       class="sidebar-menu-link d-flex align-items-center {{ request()->routeIs('dashboard') ? 'active text-blue-600' : 'text-gray-600' }}">
                        <img src="/assets/img/icon/home.png" alt="home" class="sidebar-menu-link-icon flex-shrink-0">
                        <span class="sidebar-menu-link-text">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="{{ route('announcement.list') }}" class="sidebar-menu-link d-flex align-items-center {{ request()->routeIs('announcement.*') ? 'active text-blue-600' : 'text-gray-600' }}">
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
        <div class="sidebar-menu-block">
            <h6 class="sidebar-menu-title fw-semibold text-uppercase">User</h6>
            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-item">
                    <a href="subscribe-list.html" class="sidebar-menu-link d-flex align-items-center">
                        <img src="/assets/img/icon/list.png" alt="list" class="sidebar-menu-link-icon flex-shrink-0">
                        <span class="sidebar-menu-link-text">Subscribe List</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="subscribe-segmentation.html" class="sidebar-menu-link d-flex align-items-center">
                        <img src="/assets/img/icon/user.png" alt="user avatar" class="sidebar-menu-link-icon flex-shrink-0">
                        <span class="sidebar-menu-link-text">Subscribe Segmentation</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-menu-link d-flex align-items-center">
                        <img src="/assets/img/icon/persona.svg" alt="user avatar" class="sidebar-menu-link-icon flex-shrink-0">
                        <span class="sidebar-menu-link-text">Personas</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-menu-link d-flex align-items-center">
                        <img src="/assets/img/icon/journey-mapping.svg" alt="journey-mapping" class="sidebar-menu-link-icon flex-shrink-0">
                        <span class="sidebar-menu-link-text">Journey Mapping</span>
                    </a>
                </li>
            </ul>
        </div>
         @isSuperAdmin
            <div class="sidebar-menu-block">
                <h6 class="sidebar-menu-title fw-semibold text-uppercase">Team members</h6>
                <ul class="sidebar-menu-list">
                    <li class="sidebar-menu-item">
                        <a href="{{ route('invite.create') }}"
                        class="sidebar-menu-link d-flex align-items-center {{ request()->routeIs('invite.create') ? 'active text-blue-600' : 'text-gray-600' }}">
                            <img src="/assets/img/icon/user-plus.png" alt="user plus" class="sidebar-menu-link-icon flex-shrink-0">
                            <span class="sidebar-menu-link-text">Invite a Team Member</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endisSuperAdmin
        <div class="sidebar-menu-block">
            <h6 class="sidebar-menu-title fw-semibold text-uppercase">Settings</h6>
            <ul class="sidebar-menu-list">
                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-menu-link d-flex align-items-center">
                        <img src="/assets/img/icon/settings.png" alt="settings" class="sidebar-menu-link-icon flex-shrink-0">
                        <span class="sidebar-menu-link-text">App Settings</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="#" class="sidebar-menu-link d-flex align-items-center">
                        <img src="/assets/img/icon/website.png" alt="website" class="sidebar-menu-link-icon flex-shrink-0">
                        <span class="sidebar-menu-link-text">View Your Website</span>
                    </a>
                </li>
                <li class="sidebar-menu-item">
                    <a href="widget.html" class="sidebar-menu-link d-flex align-items-center">
                        <img src="/assets/img/icon/widget.png" alt="widget" class="sidebar-menu-link-icon flex-shrink-0">
                        <span class="sidebar-menu-link-text">Your Widget</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
