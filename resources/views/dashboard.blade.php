@extends('layouts.app')

@section('content')
    <main class="mb-240 dashboard">
        <div class="mx-auto">
            <section class="main-content-wrapper p-0">
                <div class="row">
                    @if($announcement || $board)
                        {{-- ✅ WHEN DATA EXISTS --}}
                        <div class="col-lg-8">
                            {{-- ====== Analytics Section ====== --}}
                            <div class="card bg-white mb-3">
                                <h5 class="fw-medium font-16">Your top analytics for release page and announcement widgets</h5>
                                <div class="report-wrapper mb-4 mt-2">
                                    <div class="row gy-4 gx-2">
                                        <div class="col-lg-4">
                                            <div class="report-card card align-items-start rounded bg-white h-100">
                                                <h5 class="card-title sm mb-2 fw-medium text-black">Release Page View</h5>
                                                <span class="card-number d-block mb-2">440</span>
                                                <p class="card-date">March 20, 2024 - March 20, 2025</p>
                                                <span class="badge rounded-pill status-active mb-2">
                                                12% <i class="fa fa-arrow-up"></i>
                                            </span>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="report-card card align-items-start rounded bg-white h-100">
                                                <h5 class="card-title sm mb-2 fw-medium text-black">Unique Visitors</h5>
                                                <span class="card-number d-block mb-2">22</span>
                                                <p class="card-date">March 20, 2024 - March 20, 2025</p>
                                                <span class="badge rounded-pill status-danger mb-2">
                                                12% <i class="fa fa-arrow-down"></i>
                                            </span>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="report-card card align-items-start rounded bg-white h-100">
                                                <h5 class="card-title sm mb-2 fw-medium text-black">Ready To Broadcast</h5>
                                                <span class="card-number d-block mb-2">12</span>
                                                <p class="card-date">March 20, 2024 - March 20, 2025</p>
                                                <span class="badge rounded-pill status-danger mb-2">
                                                12% <i class="fa fa-arrow-down"></i>
                                            </span>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="report-card card align-items-start rounded bg-white h-100">
                                                <h5 class="card-title sm mb-2 fw-medium text-black">Reactions</h5>
                                                <img src="{{ asset('assets/img/icons/emoji-smiling.svg') }}" alt="">
                                                <p class="card-date">March 20, 2024 - March 20, 2025</p>
                                                <span class="badge rounded-pill status-active mb-2">
                                                68 Yes <i class="fa fa-arrow-up"></i>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="report-card card align-items-start rounded bg-white h-100">
                                                <h5 class="card-title sm mb-2 fw-medium text-black">Release Overall Sentiments</h5>
                                                <img src="{{ asset('assets/img/icons/emoji-smiling.svg') }}" alt="">
                                                <p class="card-date">March 20, 2024 - March 20, 2025</p>
                                                <span class="badge rounded-pill status-active mb-2">
                                                68 Natural <i class="fa fa-arrow-up"></i>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ====== Knowledge Base Section ====== --}}
                            <div class="card bg-white mb-3">
                                <h5 class="fw-medium font-16">Knowledge Base at a Glance</h5>
                                <div class="report-wrapper mb-4 mt-2">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="report-card card align-items-start rounded bg-white h-100">
                                                <h5 class="card-title sm mb-2 fw-medium text-black">Published Article</h5>
                                                <span class="card-number d-block mb-2">440</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="report-card card align-items-start rounded bg-white h-100">
                                                <h5 class="card-title sm mb-2 fw-medium text-black">Draft Article</h5>
                                                <span class="card-number d-block mb-2">12</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="report-card card align-items-start rounded bg-white h-100">
                                                <h5 class="card-title sm mb-2 fw-medium text-black">Categories</h5>
                                                <span class="card-number d-block mb-2">6</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="report-card card align-items-start rounded bg-white h-100">
                                                <h5 class="card-title sm mb-2 fw-medium text-black">No View (Published)</h5>
                                                <span class="card-number d-block mb-2">8</span>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="report-card card align-items-start rounded bg-white h-100">
                                                <h5 class="card-title sm mb-2 fw-medium text-black">Search (Zero Result)</h5>
                                                <span class="card-number d-block mb-2">440</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="report-card card align-items-start rounded bg-white h-100">
                                                <h5 class="card-title sm mb-2 fw-medium text-black">Article Six Months Old</h5>
                                                <span class="card-number d-block mb-2">8</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="report-card card align-items-start rounded bg-white h-100">
                                                <h5 class="card-title sm mb-2 fw-medium text-black">Board</h5>
                                                <span class="card-number d-block mb-2">0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ====== Right Column: Feedback ====== --}}
                        <div class="col-lg-4">
                            <div class="card bg-white mb-3 p-0">
                                <div class="d-flex align-items-center border-title justify-content-between">
                                    <h4 class="fw-medium mb-0">New Feedback Request</h4>
                                </div>

                                @for ($i = 0; $i < 4; $i++)
                                    <div class="p-3 feedback-request">
                                    <span class="tag d-inline-flex align-items-center rounded fw-semibold">
                                        {{ $i == 3 ? 'New Feature' : 'Bug fix' }}
                                        <span class="tag-color {{ $i == 3 ? 'yellow' : 'red' }} d-block rounded-circle"></span>
                                    </span>
                                        <p class="label fw-normal text-black mt-2 mb-2">
                                            Workflows & automations for the Support Platform
                                        </p>
                                        <p class="color-support fw-normal label mb-2">
                                            Set up custom automations and workflows based on the rules you define, like.....
                                        </p>
                                        <a href="#" class="font-12 fw-normal">Read more</a>
                                    </div>
                                @endfor

                                <div class="card-footer gap15 px-3 bg-white d-flex justify-content-start">
                                    <a href="#" class="font-12 fw-normal">View more Feedback request</a>
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- ❌ WHEN NO DATA --}}
                        <div class="col-12">
                            <div class="card bg-white text-center py-5" >
                                <img src="{{ asset('assets/img/image 13.svg') }}" alt="" class="mx-auto mb-3" style="max-width: 400px;">
                                <p class="font-12 fw-normal mb-4">
                                    Currently no data to display. Please add any one of the items
                                </p>
                                <div class="d-flex flex-wrap gap-2 justify-content-center">
                                    <a href="#" class="text-white theme-btn sm fw-bold rounded border-0">Add New Change Log</a>
                                    <a href="#" class="text-white theme-btn sm fw-bold rounded border-0">Add New Knowledge Board</a>
                                    <a href="#" class="text-white theme-btn sm fw-bold rounded border-0">Add New Feedback</a>
                                    <a href="#" class="text-white theme-btn sm fw-bold rounded border-0">Add New Personas</a>
                                    <a href="#" class="text-white theme-btn sm fw-bold rounded border-0">Add New Research Repo</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </section>
        </div>
    </main>
@endsection
