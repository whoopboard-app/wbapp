@extends('layouts.theme')

@section('title')
    {{ request('category')
        ? 'Announcement - ' . ($categories->firstWhere('id', request('category'))->category_name ?? 'Unknown')
        : 'Announcement' }}
@endsection


@section('content')
    <div class="custom-container">
        <div class="container-fluid">
            <div class="row">
                <!-- Main Content -->
                <div class="col-12 col-md-9">
                    <div class="theme-align-{{ $theme->alignment ?? 'center' }}">
                        <div class="main-content railway px-0 center-layout pb-2" style="width: 80%">
                            <div class="card theme-card mb-2">
                                <h5 class="fw-semibold text-primary">Product Updates</h5>
                                <p class="label mb-0">
                                    Manage Feature Requests, Roadmap, NPS, and in-app notifications alongside product announcements. Stay connected, gather feedback, and keep users informed—all in one platform.
                                </p>
                            </div>
                            @forelse($announcements as $log)
                                @if($log->feature_banner)
                                    <div class="img-block mt-3 position-relative">
                                        <img src="{{ asset('storage/' . $log->feature_banner) }}" class="w-100" alt="">
                                        <button type="button" class="btn btn-light btn-sm position-absolute bottom-0 end-0 m-2 shadow expand-btn">
                                            <i class="fa fa-expand"></i>
                                        </button>
                                    </div>
                                @endif
                                    <div class="card theme-card mb-2 mt-2">
                                        <h5 class="fw-semibold text-primary">{{ $log->title }}</h5>
                                        <p class="label mb-0">{{ $log->short_description ?? '' }}</p>
                                    </div>
                                    <div class="mt-3 pb-3">
                                    <h5 class="fw-semibold mb-2 pb-1 post-title">{{ $log->title }}</h5>

                                        <div class="tags-wrapper">
                                            <div class="d-flex flex-wrap mb-1">
                                                @foreach($log->category_names as $cat)
                                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold">
                                                    <span class="tag-color green d-block rounded-circle"></span> {{ $cat }}
                                                </span>
                                                @endforeach
                                            </div>
                                            <div class="d-flex flex-wrap">
                                                @foreach($log->tag_names as $tag)
                                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold">
                                                    <span class="tag-color blue d-block rounded-circle"></span> {{ $tag }}
                                                </span>
                                                @endforeach
                                            </div>
                                        </div>

                                        <p class="mt-2 post-description">
                                        {{ Str::limit($log->description, 300) }}
                                    </p>
                                    <div class="border-bottom p-1">
                                    <a href="{{--{{ route('changelog.show', $log->id) }}--}}" class="read-more">Read more</a>
                                    </div>
                                </div>
                            @empty
                                <p>No announcements found.</p>
                            @endforelse
                            <!-- Pagination -->
                            @if ($announcements->total() > 0)
                                <div class="d-flex justify-content-between align-items-center mt-2 flex-wrap">
                                    <!-- Left side: Showing info -->
                                    <div class="text-muted small mb-2 mb-md-0">
                                        Showing {{ $announcements->firstItem() }} to {{ $announcements->lastItem() }}
                                        of {{ $announcements->total() }} entries
                                    </div>

                                    <!-- Right side: Previous/Next buttons -->
                                    <div class="d-flex gap-2">
                                        @if ($announcements->onFirstPage())
                                            <button class="btn btn-outline-secondary btn-sm" disabled>Previous</button>
                                        @else
                                            <a href="{{ $announcements->previousPageUrl() }}"
                                               class="btn btn-outline-primary btn-sm">Previous</a>
                                        @endif

                                        @if ($announcements->hasMorePages())
                                            <a href="{{ $announcements->nextPageUrl() }}"
                                               class="btn btn-outline-primary btn-sm">Next</a>
                                        @else
                                            <button class="btn btn-outline-secondary btn-sm" disabled>Next</button>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 d-none d-md-block right-sidebar-container px-0">
                    <div class="main-content px-0 right-sidebar">
                        <!-- Quick Links -->
                        <div class="mb-4 sidebar-menu-title">
                            <h6 class="fw-semibold text-uppercase mb-3">Quick Links</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <a href="{{ route('themes.details') }}"
                                       class="d-block py-1 {{ !request('category') ? 'fw-semibold text-primary' : '' }}">
                                        | All Post
                                    </a>
                                </li>
                                @foreach($categories as $category)
                                    <li class="mb-2">
                                        <a href="{{ request()->fullUrlWithQuery(['category' => $category->id]) }}"
                                           class="d-block py-1 {{ request('category') == $category->id ? 'fw-semibold text-primary' : '' }}">
                                            | {{ $category->category_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>



                        <!-- Jump to year & month -->
                        <div>
                            <h6 class="sidebar-menu-title text-uppercase mb-3">Jump to year & month</h6>

                            <form method="GET" action="{{ route('themes.details') }}">
                                <div class="mb-3">
                                    <select class="form-select rounded" name="year" onchange="this.form.submit()">
                                        <option value="">Select Year</option>
                                        @foreach($years as $year)
                                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <select class="form-select rounded" name="month" onchange="this.form.submit()">
                                        <option value="">Select Month</option>
                                        @foreach(['January','February','March','April','May','June','July','August','September','October','November','December'] as $month)
                                            <option value="{{ $month }}" {{ request('month') == $month ? 'selected' : '' }}>
                                                {{ $month }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.expand-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const imgSrc = this.previousElementSibling.src;

                    // If overlay already open, remove it (toggle off)
                    const existingOverlay = document.querySelector('.fullscreen-overlay');
                    if (existingOverlay) {
                        existingOverlay.remove();
                        document.body.classList.remove('no-scroll');
                        return;
                    }

                    // Create overlay
                    const overlay = document.createElement('div');
                    overlay.classList.add('fullscreen-overlay');

                    // Create cloned image
                    const fullscreenImg = document.createElement('img');
                    fullscreenImg.src = imgSrc;
                    fullscreenImg.classList.add('fullscreen-image');

                    // Append to DOM
                    overlay.appendChild(fullscreenImg);
                    document.body.appendChild(overlay);
                    document.body.classList.add('no-scroll');

                    // Close when clicking outside image
                    overlay.addEventListener('click', function (e) {
                        if (e.target === overlay) {
                            overlay.remove();
                            document.body.classList.remove('no-scroll');
                        }
                    });
                });
            });
        });
    </script>
@endpush
