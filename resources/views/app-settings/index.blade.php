@extends('layouts.app') {{-- or your layout file --}}
@section('content')

    <section class="section-content-center w-100 listing-changelog main-content-wrapper p-0">
        <div class="d-flex justify-content-between">
            <h4 class="fw-medium font-16 ">App Settings</h4>
            <a href="{{route('dashboard')}}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-flex align-items-center gap-2">
                <img src="{{ asset('assets/img/chevron-left.svg') }}" alt="Back" class="align-text-bottom">
                Back to Listing Page
            </a>
        </div>
        <div class="row app-settings-content pt-3">
            <div class="col-lg-4 mb-3" style="width:30%;">
                <div class="get-started-card card p-0 align-items-start bg-white h-100">
                    <div class="border-title w-100">
                        <h5 class="card-title my-0 fw-medium text-black">My Profile & Change Password</h5>
                    </div>
                    <div class="content-body">
                        <img src="assets/img/icon/user-profile.svg" alt="">
                        <h5 class="fw-normal label mt-1">My Profile / Change Password</h5>
                        <p class="card-desc mb-2">Keep your profile up-to-date.</p>
                        <a  href="{{ route('profile.edit') }}" class="widget-item-btn mb-1 text-primary bg-white d-inline-block rounded fw-normal font-12">Update profile</a>
                        <a href="{{ route('profile.edit', ['tab' => 'password']) }}" class="widget-item-btn mb-1 text-primary bg-white d-inline-block rounded fw-normal font-12">Change Password</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3" style="width:30%;">
                <div class="get-started-card card p-0 align-items-start bg-white h-100">
                    <div class="border-title w-100">
                        <h5 class="card-title my-0 fw-medium text-black">Team Member</h5>
                    </div>
                    <div class="content-body">
                        <img src="assets/img/icon/user-profile.svg" alt="">
                        <h5 class="fw-normal label mt-1">Team Member ({{$totalTeamMembers}})</h5>
                        <p class="card-desc mb-2">Add Team Member or Invite Member for Login Credentials.</p>
                        <a href="{{ route('invite.create') }}" class="widget-item-btn mb-1 text-primary bg-white d-inline-block rounded fw-normal font-12">Add / Invite Team Member</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3" style="width:30%;">
                <div class="get-started-card card p-0 align-items-start bg-white h-100">
                    <div class="border-title w-100">
                        <h5 class="card-title my-0 fw-medium text-black"> @customLabel('Announcement') Categories</h5>
                    </div>
                    <div class="content-body">
                        <img src="assets/img/icon/user-profile.svg" alt="">
                        <h5 class="fw-normal label mt-1">Add / Edit / Delete Categories</h5>
                        <p class="card-desc mb-2">Track all Categories for @customLabel('Announcement').</p>
                        <a href="{{ route('guide.setup.changelog.category') }}" class="widget-item-btn mb-1 text-primary bg-white d-inline-block rounded fw-normal font-12">Add Categories</a>
                        <a href="{{ route('guide.setup.changelog.category') }}" class="widget-item-btn mb-1 text-primary bg-white d-inline-block rounded fw-normal font-12">Listing Categories</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3" style="width:30%;">
                <div class="get-started-card card p-0 align-items-start bg-white h-100">
                    <div class="border-title w-100">
                        <h5 class="card-title my-0 fw-medium text-black">@customLabel('Announcement') Tags</h5>
                    </div>
                    <div class="content-body">
                        <img src="assets/img/icon/user-profile.svg" alt="">
                        <h5 class="fw-normal label mt-1">Add / Edit / Delete @customLabel('Announcement') Tags </h5>
                            <p class="card-desc mb-2">Track all your Tags for @customLabel('Announcement').</p>
                            <a href="{{ route('guide.setup.changelog.tags') }}" class="widget-item-btn mb-1 text-primary bg-white d-inline-block rounded fw-normal font-12">Add Tags</a>
                            <a href="{{ route('guide.setup.changelog.tags') }}" class="widget-item-btn mb-1 text-primary bg-white d-inline-block rounded fw-normal font-12">Tags Listing</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3" style="width:30%;">
                <div class="get-started-card card p-0 align-items-start bg-white h-100">
                    <div class="border-title w-100">
                        <h5 class="card-title my-0 fw-medium text-black">Themes</h5>
                    </div>
                    <div class="content-body">
                        <img src="assets/img/icon/user-profile.svg" alt="">
                        <h5 class="fw-normal label mt-1">Theme Settings / Custom Labels / Meta Settings</h5>
                        <p class="card-desc mb-2">Select and Customize Themes.Change Label Preference.</p>
                        <a  href="{{ route('themes.index') }}" class="widget-item-btn mb-1 text-primary bg-white d-inline-block rounded fw-normal font-12">Add Theme</a>
                        <a href="{{ route('themes.index') }}" class="widget-item-btn mb-1 text-primary bg-white d-inline-block rounded fw-normal font-12">Theme View</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-3" style="width:30%;">
                <div class="get-started-card card p-0 align-items-start bg-white h-100">
                    <div class="border-title w-100">
                        <h5 class="card-title my-0 fw-medium text-black">Billings & Subscriptions</h5>
                    </div>
                    <div class="content-body">
                        <img src="assets/img/icon/user-profile.svg" alt="">
                        <h5 class="fw-normal label mt-1">Billings / Subscriptions</h5>
                            <p class="card-desc mb-2">Track all your payment, subscriptions plan.</p>
                            <a href="{{ route('billing.index') }}" class="widget-item-btn mb-1 text-primary bg-white d-inline-block rounded fw-normal font-12">Billing History</a>
                            <a href="{{ route('billing.index') }}" class="widget-item-btn mb-1 text-primary bg-white d-inline-block rounded fw-normal font-12">My Subscription</a>
                            <a href="{{ route('billing.index') }}" class="widget-item-btn mb-1 text-primary bg-white d-inline-block rounded fw-normal font-12">Delete Account</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
