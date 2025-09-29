@extends('layouts.app')

@section('content')
    <div class="mt-4 mx-auto w-100">
        <!-- Breadcrumb -->
        <div class="max-w-6xl mx-auto px-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item text-black">
                        @customLabel('Knowledge Board')
                    </li>
                    <li class="breadcrumb-item text-black"> {{ ($board->name) }}</li>
                    <li class="breadcrumb-item">
                        <a href="#" class="text-primary">{{$category->name}}</a>
                    </li>
                </ol>
            </nav>
        </div>
        <div class="main-content mx-auto w-100 pt-2">
            <div class="section-title mb-4 d-flex justify-content-between align-items-center">
                <h2 class="fw-semibold mb-2 pb-1 fs-1">{{ $article->title }}</h2>
                <div class="d-inline-block">
                    <a href="{{ url('kbarticle/boards/' . $article->board->id . '/categories') }}"
                       class="theme-btn fw-semibold rounded border-0">
                        Back To Category Listing
                    </a>
                </div>
            </div>
            <div class="tags-wrapper d-flex flex-wrap mt-2">
                @foreach($article->tag_list as $tag)
                    <span class="tag d-inline-flex align-items-center rounded-pill fw-semibold me-2">
            <span class="tag-color green d-block rounded-circle"></span>
            {{ $tag->tag_name }}
        </span>
                @endforeach
            </div>
            <div class="report-wrapper mb-4 mt-4 pt-3">
                <div class="row gy-4 gx-2">
                    <div class="col-lg-3 col-sm-6">
                        <div class="report-card card align-items-start rounded boarder bg-white h-100">
                            <h5 class="card-title sm mb-2 fw-semibold text-black">Page View</h5>
                            <span class="card-number d-block mb-2">440</span>
                            <p class="card-date">March 20, 2024 - March 20, 2025</p>
                            <a href="#" class="widget-item-btn sm rounded fw-semibold">Changelog Settings</a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="report-card card align-items-start rounded bg-white h-100">
                            <h5 class="card-title sm mb-2 fw-semibold text-black">Unique Visitors</h5>
                            <span class="card-number d-block mb-2">22</span>
                            <p class="card-date">March 20, 2024 - March 20, 2025</p>
                            <a href="#" class="widget-item-btn sm rounded fw-semibold">Changelog Settings</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="report-card card align-items-start rounded bg-white h-100">
                            <h5 class="card-title sm mb-4 pb-2 fw-semibold text-black">Reactions</h5>
                            <p class="fw-semibold mb-0">Was this article helpful?</p>
                            <p class="form-para">5 out of 10 found this helpful</p>
                            <div class="reaction-item d-flex align-items-start bg-transparent border-0 ps-0 gap-3">
                                <div class="d-flex gap-2 justify-content-start">
                                    <a href="#" class="text-black border like-btn rounded fw-semibold"
                                       data-value="75">
                                        <span class="percentage">75%</span> says Yes
                                    </a>
                                    <a href="#" class="text-black border like-btn rounded fw-semibold"
                                       data-value="25">
                                        <span class="percentage">25%</span> says Yes
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mx-auto">
                <div class="changelog-detail-item-list d-flex flex-column">
                    <div class="changelog-detail-item d-flex flex-column">
                        <div class="changelog-detail-item-thumb rounded-1 overflow-hidden">
                            <img src="{{ asset('assets/img/changelog-detail-thumb-1.jpg') }}"
                                 alt="changelog detail thumb"
                                 class="w-100 h-100 object-fit-cover">
                        </div>
                        <div class="changelog-detail-item-content text-black">
                            <h2 class="fw-semibold mb-3">Article Discription</h2>
                            <p class="label text-dusk">
                                    {{$article->description}}
                            </p>
                            <h2 class="fw-semibold mb-3">Category Discripition</h2>
                            <p class="label mb-0 text-dusk">
                                    {{$category->short_desc}}
                            </p>
                            <h2 class="fw-semibold mb-3">Board Description</h2>
                            <p class="mb-0 label text-dusk">
                                {{$board->description}}
                            </p>
                        </div>
                    </div>
                    <div class="reaction-item d-flex align-items-center justify-content-between flex-wrap rounded-3">
                        <div>
                            <h6 class="fw-semibold mb-2">Was this article helpful?</h6>
                            <p class="mb-0">0 out of 0 found this helpful</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <button type="button" class="like-btn d-flex align-items-center justify-content-center rounded">
                                <img src="{{ asset('assets/img/icon/thumbs-up.svg') }}" alt="thumbs-up">
                            </button>

                            <button type="button" class="like-btn d-flex align-items-center justify-content-center rounded">
                                <img src="{{ asset('assets/img/icon/thumbs-down.svg') }}" alt="thumbs-down">
                            </button>
                        </div>
                    </div>
                    <div class="reaction-item d-flex align-items-center justify-content-between flex-wrap rounded-3">
                        <div>
                            <h6 class="fw-semibold mb-2">Was this article helpful?</h6>
                            <p class="mb-0">0 out of 0 found this helpful</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <button type="button" class="like-btn  rounded fw-semibold">Yes</button>
                            <button type="button" class="like-btn  rounded fw-semibold">No</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
@endsection
