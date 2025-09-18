<header class="header sticky-top bg-white">
    <div class="header-wrapper d-flex align-items-center justify-content-between gap-4 px-1f">

        <!-- Project Name / Logo -->
        <a href="{{ url('/') }}" class="header-logo logo d-inline-block">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="logo" class="h-12">
        </a>
        <!-- Close Button on Right -->
        <a href="{{ url()->previous() }}">
            <img src="{{ asset('assets/img/icon/close.svg') }}" alt="logo" class="h-auto">
        </a>
    </div>
</header>
