@extends('layouts.app')
@section('content')
<style>

    .p-text {
        font-size: 17px !important;
    }
    .p-text1 {
        font-size: 15px !important;
    }
    .theme-btn {
        line-height: unset !important;
    }
    .card{
        padding: 0px !important;
    }

    .badge.status-active {
        background-color: #E0FFE9;
        color: #1C8139;
    }
    .badge.status-draft {
        background-color: #D5E8FF;
        color: #0969DA;
    }

    .badge {
        letter-spacing: 0.4px; /* thoda gap */
    }

    .badge.status-inactive {
        background-color: #FFF7E0;
        color: #9A6B16;
    }

    .img-fixed {
        height: 400px;
        object-fit: cover;
        width: 100%;
    }

    .custom-border {
    border: var(--bs-border-width, 1px) solid var(--bs-border-color, #dee2e6) !important;
    }
</style>
<div class="mx-auto w-100">

    @if($announcements->isEmpty() && $filter == 'all')
        <section class="section-content-center">
            <div class="container">
                        <div class="card pt-0 px-0 bg-white">
                            <div class="border-title">
                                <h4 class="fw-medium mb-0">Change Log</h4>
                            </div>
                            <div class="content-body">
                            <img src="{{ asset('assets/img/placeholder.png') }}" alt="placeholder" class="empty-img">
                            <div class="get-started-changelog">
                        <div class="get-started-changelog-title mb-4">
                            <h6 class="fw-semibold mb-2 pb-1">Get started with the Changelog</h6>
                            <p class="mb-0">Here is a list of recommended actions to help you get the most out of our Changelog module.</p>
                        </div>
                        <div class="btn-wrapper d-flex align-items-center justify-content-center gap-2 flex-wrap mb-4">
                        <a href="{{ route('changelog.create')}}" class="theme-btn sm fw-semibold rounded d-inline-block"> Add @customLabel('Announcement')</a>
                        <a href="#" class="theme-btn sm bg-white secondary fw-semibold rounded d-inline-block">@customLabel('Announcement') Settings</a>
                        </div>
                        <div class="get-started-card-wrapper">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="get-started-card card align-items-start rounded-0 bg-white h-100">
                                    <img src="{{ asset('assets/img/email-color.svg') }}" alt="email-color">
                                    <h5 class="card-title my-2 fw-semibold text-black">Import email subscribers</h5>
                                    <p class="card-desc mb-3">Import your email list to send notification emails to your users.</p>
                                    <a href="#" class="widget-item-btn bg-white d-inline-block rounded fw-semibold">Changelog Settings</a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="get-started-card card align-items-start rounded-0 bg-white h-100">
                                    <img src="{{ asset('assets/img/email-color.svg') }}" alt="email-color">
                                    <h5 class="card-title my-2 fw-semibold text-black">Embed the changelog in your app</h5>
                                    <p class="card-desc mb-3">Embed the changelog widget in your app to show your users what's new.</p>
                                    <a href="#" class="widget-item-btn bg-white d-inline-block rounded fw-semibold">Embed Widget</a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="get-started-card card align-items-start rounded-0 bg-white h-100">
                                <img src="{{ asset('assets/img/email-color.svg') }}" alt="email-color">
                                    <h5 class="card-title my-2 fw-semibold text-black">Share your public changelog page</h5>
                                    <p class="card-desc mb-3">Share your public changelog page to show your users what's new.</p>
                                    <a href="#" class="widget-item-btn bg-white d-inline-block rounded fw-semibold">Copy Public Link</a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="get-started-card card align-items-start rounded-0 bg-white h-100">
                                    <img src="{{ asset('assets/img/email-color.svg') }}" alt="email-color">
                                    <h5 class="card-title my-2 fw-semibold text-black">Publish your first changelog</h5>
                                    <p class="card-desc mb-3">Create your first changelog to start tracking changes to your app.</p>
                                    <a href="#" class="widget-item-btn bg-white d-inline-block rounded fw-semibold">Create Changelog</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                            </div>
                        </div>
            </div>
        </section>
    @else

        <div class="announcement-wrapper mx-auto px-2">
            <div class="d-flex justify-content-between">
                    <h4 class="fw-medium font-16 ">@customLabel('Announcement')</h4>
                    <div class="btn-wrapper d-flex align-items-center justify-content-center gap-2 flex-wrap mb-4">
                        <a href="{{route('dashboard')}}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-flex align-items-center gap-2">
                            <img src="{{ asset('assets/img/chevron-left.svg') }}" alt="Back" class="align-text-bottom">
                            Back to Listing Page
                        </a>
                        <a href="{{ route('changelog.create')}}" class="theme-btn sm fw-semibold rounded d-inline-block"> Add @customLabel('Announcement')</a>
                    </div>
               </div>

            <!-- <div class=" border-bottom-0 mb-4 d-flex align-items-start">
                <nav class="d-flex align-items-center justify-content-center">
                    <div class="nav nav-tabs justify-content-center rounded">

                        <a href="{{ route('announcement.filter', ['filter' => 'all']) }}"
                        class="p-text1 dt-filter-btn nav-link rounded position-relative {{ request('filter', 'all') === 'all' ? 'active' : '' }}">
                        All
                        </a>

                        @foreach($categories as $category)
                            <a href="{{ route('announcement.filter', ['filter' => $category->id]) }}"
                            class="p-text1 dt-filter-btn nav-link rounded position-relative {{ request('filter') == $category->id ? 'active' : '' }}">
                                {{ ucfirst($category->category_name) }}
                            </a>
                        @endforeach

                    </div>
                </nav>

            </div> -->

            <!-- <div class="d-flex justify-content-between align-items-center mb-4">
                <div class=" position-relative form-group d-flex align-items-center">
                    <input type="search" id="search" name="search" class="input-field w-100 rounded ps-5" placeholder="Search">
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
            </div> -->
            <div class="card pt-0 px-0 bg-white">
                <div class="d-flex border-title align-items-center justify-content-between">
                    <h4 class="fw-medium mb-0 ">{{ $totalCount }} @customLabel('Announcement')</h4>
                    <div class="btn-wrapper d-flex align-items-center justify-content-center gap15 flex-wrap mb-0">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="showImg">
                            <label class="form-check-label" for="showImg">
                            Show Image
                            </label>
                        </div>
                        <div class="position-relative form-group" style="width: 250px;">
                            <input type="search" id="searchInput" class="input-field w-100 rounded ps-5" placeholder="Search By Title">
                            <img src="{{ asset('assets/img/icon/search.svg') }}" alt="search"
                                class="position-absolute top-50 start-0 translate-middle-y ms-3">
                        </div>

                        <div class="form-group">
                        <select id="statusFilter" class="form-select rounded custom-border">
                                    <option value="">Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="draft">Draft</option>
                        </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="announcement-list space-y-4" id="announcement-list">
                    @include('changelog.partials.announcement_cards', ['announcements' => $announcements,'categories' => $categories])
            </div>
        </div>

    @endif
</div>
<script>
    $(document).ready(function() {
    function fetchAnnouncements(page = 1) {
        let search = $('#searchInput').val();
        let status = $('#statusFilter').val();

        $.ajax({
            url: "{{ route('announcement.filter') }}",
            type: "GET",
            data: { search, status, page },
            beforeSend: function() {
                $('#announcement-list').html('<p class="text-center">Loading...</p>');
            },
            success: function(response) {
                $('#announcement-list').html(response);
            },
            error: function() {
                $('#announcement-list').html('<p class="text-danger text-center">Error loading data.</p>');
            }
        });
    }

    // Search input with delay
    let typingTimer;
        $('#searchInput').on('input keyup', function() {
            clearTimeout(typingTimer);
            const value = $(this).val();
            if (value === '') {
                fetchAnnouncements(1);
            } else {
                typingTimer = setTimeout(() => fetchAnnouncements(1), 400);
            }
        });


    $('#statusFilter').on('change', function() {
        fetchAnnouncements(1);
    });

    // Handle pagination clicks
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let page = $(this).data('page');
            if(page) fetchAnnouncements(page);
        });
    });

</script>

@endsection
