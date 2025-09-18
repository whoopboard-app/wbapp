@extends('layouts.app')
@section('content')
<style>
    .breadcrumb-item {
        font-size: 15px !important;
    }
    .p-text {
        font-size: 17px !important;
    }
    .p-text1 {
        font-size: 15px !important;
    }
    .theme-btn {
        line-height: unset !important;
    }
    .widget-item-btn
    {
        line-height: unset !important;
    }
    .card{
        padding: 20px 35px 20px 20px !important;
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
</style>
<div class="mt-4 mx-auto w-100">
    <!-- breadcrumbs start -->

    <div class="max-w-6xl mx-auto px-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item text-black" aria-current="page">Announcement Listings</li>
            </ol>
        </nav>
        <h2 class="fw-semibold fs-4">@customLabel('Announcement')</h2>
        <p class="text-gray-900 mt-1 mb-3 p-text">
            Keep track of all product updates in one place. Search, filter, and manage your @customLabel('Announcement') entries with ease.
        </p>
    </div>
    @if($announcements->isEmpty() && $filter == 'all')
        <div class="announcement-wrapper mx-auto max-w-2xl w-full">
            <div class="btn-wrapper d-flex align-items-center justify-content-center gap-2 flex-wrap mb-4">
                <a href="{{ route('changelog.create')}}" class="theme-btn sm fw-semibold rounded d-inline-block">
                    <i class="fa fa-plus"></i> Add Your First @customLabel('Announcement')
                </a>
                <a href="#" class="theme-btn sm secondary fw-semibold rounded d-inline-block">
                    @customLabel('Announcement') Settings
                </a>
            </div>
            <img src="{{ asset('assets/img/empty.png') }}" alt="empty" class="empty-img">
            <div class="get-started-changelog">
                <div class="mb-4">
                    <h6 class="fw-semibold mb-1 pb-1">Get started with the @customLabel('Announcement')</h6>
                    <p class="mb-0 text-gray-600 p-text">Here is a list of recommended actions to help you get the most out of our @customLabel('Announcement') module.</p>
                </div>

                <div class="get-started-card-wrapper">
                    <div class="row">
                        <div class="col-sm-6 mb-4">
                            <div class="get-started-card card align-items-start rounded-0 bg-white h-100 border-blue-400">
                                <h5 class="card-title mb-2 fw-semibold text-black">Import email subscribers</h5>
                                <p class="card-desc mb-3">Import your email list to send notification emails to your users.</p>
                                <a href="#" class="widget-item-btn d-inline-block rounded fw-semibold">@customLabel('Announcement') Settings</a>
                            </div>
                        </div>

                        <div class="col-sm-6 mb-4">
                            <div class="get-started-card card align-items-start rounded-0 bg-white h-100 border-blue-400">
                                <h5 class="card-title mb-2 fw-semibold text-black">Embed the @customLabel('Announcement') in your app</h5>
                                <p class="card-desc mb-3">Embed the @customLabel('Announcement') widget in your app to show your users what's new.</p>
                                <a href="#" class="widget-item-btn d-inline-block rounded fw-semibold">Embed Widget</a>
                            </div>
                        </div>

                        <div class="col-sm-6 mb-4">
                            <div class="get-started-card card align-items-start rounded-0 bg-white h-100 border-blue-400">
                                <h5 class="card-title mb-2 fw-semibold text-black">Share your public @customLabel('Announcement') page</h5>
                                <p class="card-desc mb-3">Share your public @customLabel('Announcement') page to show your users what's new.</p>
                                <a href="#" class="widget-item-btn d-inline-block rounded fw-semibold">Copy Public Link</a>
                            </div>
                        </div>

                        <div class="col-sm-6 mb-4">
                            <div class="get-started-card card align-items-start rounded-0 bg-white h-100 border-blue-400">
                                <h5 class="card-title mb-2 fw-semibold text-black">Publish your first @customLabel('Announcement')</h5>
                                <p class="card-desc mb-3">Create your first @customLabel('Announcement') to start tracking changes to your app.</p>
                                <a href="#" class="widget-item-btn d-inline-block rounded fw-semibold">Create @customLabel('Announcement')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
  
        <div class="announcement-wrapper max-w-6xl mx-auto px-2">
            <div class="btn-wrapper d-flex align-items-center gap-2 flex-wrap mb-4">
                <a href="{{ route('changelog.create')}}" class="theme-btn sm fw-semibold rounded d-inline-block">
                    <i class="fa fa-plus"></i> Add @customLabel('Announcement')
                </a>
            </div>

            <div class=" border-bottom-0 mb-4 d-flex align-items-start">
                <nav class="d-flex align-items-center justify-content-center">
                    <div class="nav nav-tabs justify-content-center rounded">
                        <a href="{{ route('announcement.filter', ['filter' => 'all']) }}"
                        class="p-text1 dt-filter-btn nav-link rounded position-relative {{ request('filter', 'all') === 'all' ? 'active' : '' }}">
                        All
                        </a>

                        <a href="{{ route('announcement.filter', ['filter' => 'bugs']) }}"
                        class="p-text1 dt-filter-btn nav-link rounded position-relative {{ request('filter') === 'bugs' ? 'active' : '' }}">
                        Bugs
                        </a>

                        <a href="{{ route('announcement.filter', ['filter' => 'new-features']) }}"
                        class="p-text1 dt-filter-btn nav-link rounded position-relative {{ request('filter') === 'new-features' ? 'active' : '' }}">
                        New Features
                        </a>

                        <a href="{{ route('announcement.filter', ['filter' => 'prem-features']) }}"
                        class="p-text1 dt-filter-btn nav-link rounded position-relative {{ request('filter') === 'prem-features' ? 'active' : '' }}">
                        Premium Features
                        </a>

                        <a href="{{ route('announcement.filter', ['filter' => 'enhancement']) }}"
                        class="p-text1 dt-filter-btn nav-link rounded position-relative {{ request('filter') === 'enhancement' ? 'active' : '' }}">
                        Enhancement
                        </a>

                    </div>
                </nav>
                
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class=" position-relative form-group d-flex align-items-center">
                    <input type="search" id="search" name="search" class="input-field w-100 rounded ps-5" placeholder="Search">
                    <img src="/assets/img/icon/search.svg" class="position-absolute search-icon ml-3" alt="">
                </div>
                <div class="d-flex gap-2">
                <!-- Filter -->
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

            <div class="announcement-list space-y-4">
                    @include('changelog.partials.announcement_cards', ['announcements' => $announcements])
            </div>
        </div> 
         
    @endif
</div>

@endsection
