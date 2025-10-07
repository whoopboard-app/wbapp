@extends('layouts.theme')

@section('title', 'Theme Details')

@section('content')
    <div class="custom-container">
        <div class="container-fluid">
            <div class="row">
                <!-- Main Content -->
                <div class="col-12 col-md-9">
                    <div class="theme-align-{{ $theme->alignment ?? 'center' }}">
                        <div class="main-content railway px-0 center-layout" style="width: 80%">
                            <div class="card theme-card">
                                <h5 class="fw-semibold text-primary">Product Updates</h5>
                                <p class="label mb-0">
                                    Manage Feature Requests, Roadmap, NPS, and in-app notifications alongside product announcements. Stay connected, gather feedback, and keep users informed—all in one platform.
                                </p>
                            </div>
                            <div class="img-block mt-3 position-relative">
                                <img src="assets/img/image 7.png" class="w-100" alt="">
                                <!-- Expand Icon -->
                                <button type="button" class="btn btn-light btn-sm position-absolute bottom-0 end-0 m-2 shadow expand-btn">
                                    <i class="fa fa-expand"></i>
                                </button>
                            </div>
                            <div class="mt-3 border-bottom-1 pb-3">
                                <h5 class="fw-semibold mb-2 pb-1 post-title">
                                    Introducing the New Centralized Widget Settings Layout
                                </h5>
                                <div class="tags-wrapper d-flex flex-wrap">
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color green d-block rounded-circle"></span> New Features</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color yellow d-block rounded-circle"></span> Announcement</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color red d-block rounded-circle"></span> Bug fix</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color blue d-block rounded-circle"></span> Enhancement</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color purple d-block rounded-circle"></span> Request</span>
                                </div>
                                <p class="mt-2 post-description">
                                    We’ve introduced a brand new Widget Configuration Layout to make customizing your widgets easier, faster, and more intuitive.
                                    Previously, settings like “Edit Theme,” “Widget Configurator,” and “Booster Settings” were split across separate sections. Now, they are all unified under one single menu — categorized into clear, easy-to-navigate tabs: General Settings, Style, Launcher Settings, Boosters, and Implementation.
                                </p>
                                <a href="#" class="read-more">Read more</a>
                            </div>
                            <div class="mt-3 border-bottom-1 pb-3">
                                <h5 class="fw-semibold mb-2 pb-1 post-title">
                                    Disable Feedback & Reactions per Post
                                </h5>
                                <div class="tags-wrapper d-flex flex-wrap">
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color green d-block rounded-circle"></span> New Features</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color yellow d-block rounded-circle"></span> Announcement</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color red d-block rounded-circle"></span> Bug fix</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color blue d-block rounded-circle"></span> Enhancement</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color purple d-block rounded-circle"></span> Request</span>
                                </div>
                                <p class="mt-2 post-description">
                                    We’ve added more flexibility to how you manage engagement on your updates.
                                    You can now disable feedback and reactions on individual posts directly from the post editor — just look under More Features.
                                    This allows you to control the interaction level on a post-by-post basis based on its purpose.
                                </p>
                                <a href="#" class="read-more">Read more</a>
                            </div>
                            <div class="img-block mt-3 position-relative">
                                <img src="assets/img/image 8.png" class="w-100" alt="">
                                <!-- Expand Icon -->
                                <button type="button" class="btn btn-light btn-sm position-absolute bottom-0 end-0 m-2 shadow expand-btn">
                                    <i class="fa fa-expand"></i>
                                </button>
                            </div>
                            <div class="mt-3 border-bottom-1 pb-3">
                                <h5 class="fw-semibold mb-2 pb-1 post-title">
                                    Introducing the New Centralized Widget Settings Layout
                                </h5>
                                <div class="tags-wrapper d-flex flex-wrap">
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color green d-block rounded-circle"></span> New Features</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color yellow d-block rounded-circle"></span> Announcement</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color red d-block rounded-circle"></span> Bug fix</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color blue d-block rounded-circle"></span> Enhancement</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color purple d-block rounded-circle"></span> Request</span>
                                </div>
                                <p class="mt-2 post-description">
                                    Flutter is increasingly popular among developers building cross-platform experiences. With this SDK, you can now embed AnnounceKit widgets inside your app with minimal effort, helping you keep users informed and engaged — right where it matters most.
                                </p>
                                <a href="#" class="read-more">Read more</a>
                            </div>
                            <div class="img-block mt-3 position-relative" >
                                <img src="assets/img/image 9.png" class="w-100" alt="">
                                <!-- Expand Icon -->
                                <button type="button" class="btn btn-light btn-sm position-absolute bottom-0 end-0 m-2 shadow expand-btn">
                                    <i class="fa fa-expand"></i>
                                </button>
                            </div>
                            <div class="mt-3 border-bottom-1 pb-3">
                                <h5 class="fw-semibold mb-2 pb-1 post-title">
                                    🚀 Official Release: AnnounceKit’s Enhanced Analytics - Overview Dashboard 🚀
                                </h5>
                                <div class="tags-wrapper d-flex flex-wrap">
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color green d-block rounded-circle"></span> New Features</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color yellow d-block rounded-circle"></span> Announcement</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color red d-block rounded-circle"></span> Bug fix</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color blue d-block rounded-circle"></span> Enhancement</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color purple d-block rounded-circle"></span> Request</span>
                                </div>
                                <p class="mt-2 post-description">
                                    Flutter is increasingly popular among developers building cross-platform experiences. With this SDK, you can now embed AnnounceKit widgets inside your app with minimal effort, helping you keep users informed and engaged — right where it matters most.
                                </p>
                                <a href="#" class="read-more">Read more</a>
                            </div>
                            <div class="mt-3 border-bottom-1 pb-3">
                                <h5 class="fw-semibold mb-2 pb-1 post-title">
                                    Disable Feedback & Reactions per Post
                                </h5>
                                <div class="tags-wrapper d-flex flex-wrap">
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color green d-block rounded-circle"></span> New Features</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color yellow d-block rounded-circle"></span> Announcement</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color red d-block rounded-circle"></span> Bug fix</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color blue d-block rounded-circle"></span> Enhancement</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color purple d-block rounded-circle"></span> Request</span>
                                </div>
                                <p class="mt-2 post-description">
                                    We’ve added more flexibility to how you manage engagement on your updates.
                                    You can now disable feedback and reactions on individual posts directly from the post editor — just look under More Features.
                                    This allows you to control the interaction level on a post-by-post basis based on its purpose.
                                </p>
                                <a href="#" class="read-more">Read more</a>
                            </div>
                            <div class="mt-3 border-bottom-1 pb-3">
                                <h5 class="fw-semibold mb-2 pb-1 post-title">
                                    Disable Feedback & Reactions per Post
                                </h5>
                                <div class="tags-wrapper d-flex flex-wrap">
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color green d-block rounded-circle"></span> New Features</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color yellow d-block rounded-circle"></span> Announcement</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color red d-block rounded-circle"></span> Bug fix</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color blue d-block rounded-circle"></span> Enhancement</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color purple d-block rounded-circle"></span> Request</span>
                                </div>
                                <p class="mt-2 post-description">
                                    We’ve added more flexibility to how you manage engagement on your updates.
                                    You can now disable feedback and reactions on individual posts directly from the post editor — just look under More Features.
                                    This allows you to control the interaction level on a post-by-post basis based on its purpose.
                                </p>
                                <a href="#" class="read-more">Read more</a>
                            </div>
                            <div class="img-block mt-3 position-relative" >
                                <img src="assets/img/image 8.png" class="w-100" alt="">
                                <!-- Expand Icon -->
                                <button type="button" class="btn btn-light btn-sm position-absolute bottom-0 end-0 m-2 shadow expand-btn">
                                    <i class="fa fa-expand"></i>
                                </button>
                            </div>
                            <div class="mt-3 border-bottom-1 pb-3">
                                <h5 class="fw-semibold mb-2 pb-1 post-title">
                                    Introducing the New Centralized Widget Settings Layout
                                </h5>
                                <div class="tags-wrapper d-flex flex-wrap">
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color green d-block rounded-circle"></span> New Features</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color yellow d-block rounded-circle"></span> Announcement</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color red d-block rounded-circle"></span> Bug fix</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color blue d-block rounded-circle"></span> Enhancement</span>
                                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold"><span class="tag-color purple d-block rounded-circle"></span> Request</span>
                                </div>
                                <p class="mt-2 post-description">
                                    Flutter is increasingly popular among developers building cross-platform experiences. With this SDK, you can now embed AnnounceKit widgets inside your app with minimal effort, helping you keep users informed and engaged — right where it matters most.
                                </p>
                                <a href="#" class="read-more">Read more</a>
                            </div>
                            <div class="d-inline-block mt-3">
                                <a href="#" class="theme-btn fw-semibold secondary sm rounded border">Next</a>
                                <a href="#" class="theme-btn fw-semibold secondary sm rounded border">Previous</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 d-none d-md-block right-sidebar-container px-0 w-25">
                    <div class="main-content px-3 right-sidebar text-start">
                        <div class="mb-4 text-start">
                            <h6 class="sidebar-menu-title fw-semibold text-uppercase mb-2">Quick Links</h6>
                            <ul class="list-unstyled mb-0">
                                <li><a href="#" class="sidebar-menu-title">| All Post</a></li>
                                <li><a href="#" class="sidebar-menu-title">| New Feature</a></li>
                                <li><a href="#" class="sidebar-menu-title">| Improvement</a></li>
                                <li><a href="#" class="sidebar-menu-title">| Fix</a></li>
                                <li><a href="#" class="sidebar-menu-title">| Beta</a></li>
                                <li><a href="#" class="sidebar-menu-title">| Announcement</a></li>
                            </ul>
                        </div>
                        <div>
                            <h6 class="sidebar-menu-title fw-semibold text-uppercase mb-2">Jump to year & month</h6>
                            <select class="form-select w-100 rounded mb-2" id="year">
                                <option value="">Select</option>
                                <option value="2009">2009</option>
                                <option value="2010">2010</option>
                                <option value="2011">2011</option>
                            </select>
                            <select class="form-select w-100 rounded" id="month">
                                <option value="">Select</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
