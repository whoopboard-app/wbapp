<header class="header sticky-top">
      <div class="header-wrapper d-flex align-items-center justify-content-between gap-4">
         <div class="d-inline-block">
            <a href="#" class="inline-flex items-center">
                <x-application-logo class="w-20 h-20 fill-current" />
            </a>
         </div>
         <div class="gap15 d-flex align-items-center justify-content-end pb-0">
            <div class="d-flex align-items-center gap15">
                 @if (request()->is('verify-email'))
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="theme-btn text-primary sm bg-white secondary fw-semibold rounded d-inline-block">
                            Logoff
                        </button>
                    </form>
                @else
                    <a href="#" class="theme-btn text-primary sm bg-white secondary fw-semibold rounded d-inline-block">Back to Home Page</a>
                    <a href="{{ route('register') }}" class="theme-btn  sm fw-normal rounded border-0">New here? Create an Account</a>
                @endif
            </div>
            
        </div>
      </div>
   </header>