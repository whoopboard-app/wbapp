@extends('layouts.app')

@section('content')
    <div class="mt-4 mx-auto w-100">
        <!-- Breadcrumb -->
        <div class="max-w-6xl mx-auto px-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    <li class="breadcrumb-item text-black" aria-current="page">@customLabel('Knowledge Board')</li>
                </ol>
            </nav>
            <h2 class="fw-semibold fs-4">@customLabel('Knowledge Board')</h2>
            <p class="text-gray-900 mt-1 mb-3 p-text">
                Create dedicated boards for your help guides, product manuals, and documentation.
                Each board focuses on a single document type, making it easy for users to find the right resources quickly.
            </p>
        </div>

        {{-- Empty State --}}
        @if($announcements->isEmpty() && $filter == 'all')
            <div class="announcement-wrapper mx-auto max-w-2xl w-full text-center">
                <img src="{{ asset('assets/img/empty.png') }}" alt="empty" class="empty-img">

                <div class="get-started-changelog mt-4">
                    <h6 class="fw-semibold mb-2">🚀 Get started with the @customLabel('Knowledge Board')</h6>
                    <p class="text-gray-600 p-text">
                        Create your first board to organize help docs, manuals, or product guides.
                        Once your board is ready, you can start adding content right away.
                    </p>

                    <div class="btn-wrapper d-flex align-items-center justify-content-center gap-2 flex-wrap mt-4">
                        <a href="javascript:void(0);"
                           class="theme-btn sm fw-semibold rounded d-inline-block"
                           data-bs-toggle="modal" data-bs-target="#createBoardModal">
                            <i class="fa fa-plus"></i> Add @customLabel('Knowledge Board')
                        </a>
                        <a href="{{ route('kbarticle.create') }}"
                           class="theme-btn sm secondary fw-semibold rounded d-inline-block">
                            <i class="fa fa-plus"></i> Add Article
                        </a>
                    </div>
                </div>
            </div>
        @else
            {{-- Non-empty State --}}
            <div class="announcement-wrapper max-w-6xl mx-auto px-2">
                <div class="btn-wrapper d-flex align-items-center gap-2 flex-wrap mb-4">
                    <a href="javascript:void(0);"
                       class="theme-btn sm fw-semibold rounded d-inline-block"
                       data-bs-toggle="modal" data-bs-target="#createBoardModal">
                        <i class="fa fa-plus"></i> Add @customLabel('Knowledge Board')
                    </a>
                    <a href="javascript:void(0);"
                       class="theme-btn sm secondary fw-semibold rounded d-inline-block"
                       data-bs-toggle="modal" data-bs-target="#createArticleModal">
                        <i class="fa fa-plus"></i> Add Article
                    </a>
                </div>

                {{-- Tabs --}}
                <div class="border-bottom-0 mb-4 d-flex align-items-start">
                    <nav class="d-flex align-items-center justify-content-center">
                        <div class="nav nav-tabs justify-content-center rounded">
                            @php $filters = ['all' => 'All', 'bugs' => 'Bugs', 'new-features' => 'New Features', 'prem-features' => 'Premium Features', 'enhancement' => 'Enhancement']; @endphp
                            @foreach($filters as $key => $label)
                                <a href="{{ route('announcement.filter', ['filter' => $key]) }}"
                                   class="p-text1 dt-filter-btn nav-link rounded position-relative {{ request('filter', 'all') === $key ? 'active' : '' }}">
                                    {{ $label }}
                                </a>
                            @endforeach
                        </div>
                    </nav>
                </div>

                {{-- Search + Actions --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="position-relative form-group d-flex align-items-center">
                        <input type="search" id="search" name="search"
                               class="input-field w-100 rounded ps-5" placeholder="Search">
                        <img src="/assets/img/icon/search.svg" class="position-absolute search-icon ml-3" alt="">
                    </div>
                    <div class="d-flex gap-2">
                        <a href="#" class="theme-btn secondary rounded fw-medium btn-icon-text">
                            <div class="icon-text-wrap d-flex gap-2">
                                <img src="/assets/img/icon/filter.svg" alt="">
                                <span>Filter</span>
                            </div>
                        </a>
                        <a href="#" class="theme-btn secondary rounded fw-medium btn-icon-text">
                            <div class="icon-text-wrap d-flex gap-2">
                                <img src="/assets/img/icon/view-as.svg" alt="">
                                <span>View as</span>
                            </div>
                        </a>
                    </div>
                </div>

                {{-- Announcements List --}}
                <div class="announcement-list space-y-4">
                    @include('changelog.partials.announcement_cards', ['announcements' => $announcements])
                </div>
            </div>
        @endif
    </div>

    {{-- Include Modals --}}
    @include('kbarticle.partials.create_board_model')
@endsection
