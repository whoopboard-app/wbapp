<aside class="w-64 bg-white shadow-md">
    <nav>
        <h6 class="text-xs font-semibold uppercase mt-4 text-gray-400 px-4 py-2" style="letter-spacing:1px;">Navigation</h6>
        <ul class="space-y-2">
            <li class="sidebar-menu-item">
                <a href="{{ route('dashboard') }}" 
                    class="flex items-center px-4 py-2 hover:bg-gray-100 
                         font-medium transition {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-600 hover:bg-blue-50' : 'text-gray-700' }}">
                
                    <img src="{{ asset('assets/img/icon/home.png') }}" 
                            alt="home" 
                            class="w-6 h-6 mr-3 {{ request()->routeIs('dashboard') ? 'filter-blue' : '' }}">

                    <span class="sidebar-menu-link-text">Dashboard</span>
                </a>
            </li>    
          
            <li class="sidebar-menu-item mt-0">
                <a href="/" 
                    class="flex items-center px-4 py-2 hover:bg-gray-100 
                         font-medium transition {{ request()->routeIs('/') ? 'bg-blue-50 text-blue-600 hover:bg-blue-50' : 'text-gray-700' }}">
                
                    <img src="{{ asset('assets/img/icon/megaphone.png') }}" 
                            alt="home" 
                            class="w-6 h-6 mr-3 {{ request()->routeIs('/') ? 'filter-blue' : '' }}">

                    <span class="sidebar-menu-link-text">Announcement</span>
                </a>
            </li>
            
            <li class="sidebar-menu-item mt-0">
                <a href="/" 
                    class="flex items-center px-4 py-2 hover:bg-gray-100 
                         font-medium transition {{ request()->routeIs('/') ? 'bg-blue-50 text-blue-600 hover:bg-blue-50' : 'text-gray-700' }}">
                
                    <img src="{{ asset('assets/img/icon/feedback.png') }}" 
                            alt="home" 
                            class="w-6 h-6 mr-3 {{ request()->routeIs('/') ? 'filter-blue' : '' }}">

                    <span class="sidebar-menu-link-text">Feedback</span>
                </a>
            </li>
           
            <li class="sidebar-menu-item mt-0">
                <a href="/" 
                    class="flex items-center px-4 py-2 hover:bg-gray-100 
                         font-medium transition {{ request()->routeIs('/') ? 'bg-blue-50 text-blue-600 hover:bg-blue-50' : 'text-gray-700' }}">
                
                    <img src="{{ asset('assets/img/icon/roadmap.png') }}" 
                            alt="home" 
                            class="w-6 h-6 mr-3 {{ request()->routeIs('/') ? 'filter-blue' : '' }}">

                    <span class="sidebar-menu-link-text">Product Roadmap</span>
                </a>
            </li>
          
            <li class="sidebar-menu-item mt-0">
                <a href="/" 
                    class="flex items-center px-4 py-2 hover:bg-gray-100 
                         font-medium transition {{ request()->routeIs('/') ? 'bg-blue-50 text-blue-600 hover:bg-blue-50' : 'text-gray-700' }}">
                
                    <img src="{{ asset('assets/img/icon/star-comment.png') }}" 
                            alt="home" 
                            class="w-6 h-6 mr-3 {{ request()->routeIs('/') ? 'filter-blue' : '' }}">

                    <span class="sidebar-menu-link-text">Testimonials</span>
                </a>
            </li>
          
            <li class="sidebar-menu-item mt-0">
                <a href="/" 
                    class="flex items-center px-4 py-2 hover:bg-gray-100 
                         font-medium transition {{ request()->routeIs('/') ? 'bg-blue-50 text-blue-600 hover:bg-blue-50' : 'text-gray-700' }}">
                
                    <img src="{{ asset('assets/img/icon/book.png') }}" 
                            alt="home" 
                            class="w-6 h-6 mr-3 {{ request()->routeIs('/') ? 'filter-blue' : '' }}">

                    <span class="sidebar-menu-link-text">Knowledge Board</span>
                </a>
            </li>
          
            <li class="sidebar-menu-item mt-0">
                <a href="/" 
                    class="flex items-center px-4 py-2 hover:bg-gray-100 
                         font-medium transition {{ request()->routeIs('/') ? 'bg-blue-50 text-blue-600 hover:bg-blue-50' : 'text-gray-700' }}">
                
                    <img src="{{ asset('assets/img/icon/research-repository.svg') }}" 
                            alt="home" 
                            class="w-6 h-6 mr-3 {{ request()->routeIs('/') ? 'filter-blue' : '' }}">

                    <span class="sidebar-menu-link-text">Research Repo</span>
                </a>
            </li>
          
        </ul>

        <h6 class="text-xs font-semibold uppercase mt-4 text-gray-400 px-4 py-2" style="letter-spacing:1px;">User</h6>
        <ul class="space-y-2">
            <li class="sidebar-menu-item mt-0">
                <a href="/" 
                    class="flex items-center px-4 py-2 hover:bg-gray-100 
                         font-medium transition {{ request()->routeIs('/') ? 'bg-blue-50 text-blue-600 hover:bg-blue-50' : 'text-gray-700' }}">
                
                    <img src="{{ asset('assets/img/icon/list.png') }}" 
                            alt="home" 
                            class="w-6 h-6 mr-3 {{ request()->routeIs('/') ? 'filter-blue' : '' }}">

                    <span class="sidebar-menu-link-text">Subscribe List</span>
                </a>
            </li>
        </ul>
       
    </nav>
</aside>
