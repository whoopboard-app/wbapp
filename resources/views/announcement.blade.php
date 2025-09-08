@extends('layouts.app')
@section('content')

<div class="mt-4 mx-auto w-100">    
    <!-- breadcrumbs start -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-2">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item text-black" aria-current="page">Announcement Listings</li>
        </ol>
    </nav>       

    <h2 class="fw-bold text-xl">Changelog</h2>
    <p class="text-gray-800 mt-1 mb-3">
        Keep track of all product updates in one place. Search, filter, and manage your changelog entries with ease.
    </p>

    <div class="announcement-wrapper mx-auto max-w-[638px] w-full">
        <div class="btn-wrapper d-flex align-items-center justify-content-center gap-2 flex-wrap mb-4">
            <a href="{{ route('add_changelog')}}" class="theme-btn sm fw-semibold rounded d-inline-block">
                <i class="fa fa-plus"></i> Add Your First Changelog
            </a>
            <a href="#" class="theme-btn sm secondary fw-semibold rounded d-inline-block">
                Changelog Settings
            </a>
        </div>

        <img src="{{ asset('assets/img/empty.png') }}" alt="empty" class="empty-img">

        <div class="get-started-changelog">
            <div class="mb-4">
                <h6 class="fw-semibold mb-2 pb-1">Get started with the Changelog</h6>
                <p class="mb-0 text-gray-600">Here is a list of recommended actions to help you get the most out of our Changelog module.</p>
            </div>

            <div class="get-started-card-wrapper">
                <div class="row">
                    <div class="col-sm-6 mb-4">
                        <div class="get-started-card card align-items-start rounded-0 bg-white h-100 border-blue-400">
                            <h5 class="card-title mb-2 fw-semibold text-black">Import email subscribers</h5>
                            <p class="card-desc mb-3">Import your email list to send notification emails to your users.</p>
                            <a href="#" class="widget-item-btn d-inline-block rounded fw-semibold">Changelog Settings</a>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-4">
                        <div class="get-started-card card align-items-start rounded-0 bg-white h-100 border-blue-400">
                            <h5 class="card-title mb-2 fw-semibold text-black">Embed the changelog in your app</h5>
                            <p class="card-desc mb-3">Embed the changelog widget in your app to show your users what's new.</p>
                            <a href="#" class="widget-item-btn d-inline-block rounded fw-semibold">Embed Widget</a>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-4">
                        <div class="get-started-card card align-items-start rounded-0 bg-white h-100 border-blue-400">
                            <h5 class="card-title mb-2 fw-semibold text-black">Share your public changelog page</h5>
                            <p class="card-desc mb-3">Share your public changelog page to show your users what's new.</p>
                            <a href="#" class="widget-item-btn d-inline-block rounded fw-semibold">Copy Public Link</a>
                        </div>
                    </div>

                    <div class="col-sm-6 mb-4">
                        <div class="get-started-card card align-items-start rounded-0 bg-white h-100 border-blue-400">
                            <h5 class="card-title mb-2 fw-semibold text-black">Publish your first changelog</h5>
                            <p class="card-desc mb-3">Create your first changelog to start tracking changes to your app.</p>
                            <a href="#" class="widget-item-btn d-inline-block rounded fw-semibold">Create Changelog</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /.announcement-wrapper -->
</div>
@endsection