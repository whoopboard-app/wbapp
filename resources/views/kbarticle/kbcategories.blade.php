@extends('layouts.app')

@section('content')
    <style>
        main.flex-1.p-8.pb-48{
            padding-top : 0px !important;
            padding-left : 0px !important;
            padding-right : 0px !important;
        }
        .font-19{
            font-size: 19px !important;
        }
        .icon-sm {
            width: 14px;
            height: 14px;
            object-fit: contain;
        }
        .border-radius-card{
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .border-title {
            border-bottom: none !important;
        }
        a.disabled-link {
            opacity: 0.5;
            pointer-events: none;
            cursor: default;
        }
        
        
    </style>
        <section class=" main-content-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card  p-0 bg-white mb-3">
                        <div class="d-flex align-items-center border-title justify-content-between">
                            <h4 class="fw-medium mb-0">33 Impression</h4>
                             <div class="btn-wrapper d-flex align-items-center justify-content-center gap15 flex-wrap mb-0">
                                <a href="{{route('board.index')}}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Back to Listing</a>
                                 <div class="icon-box">
                                    <a href="#"><img src="{{ asset('assets/img/icon/edit.svg') }}" alt=""></a>
                                    <div class="divider"></div>
                                    <a href="#"><img src="{{ asset('assets/img/icon/oval.svg') }}" alt=""></a>
                                    <div class="divider"></div>
                                    <a href="#"><img src="{{ asset('assets/img/icon/trash.svg') }}" alt=""></a>
                                </div>
                             </div>
                        </div>
                         <div class=" p-3">
                        <div class="d-flex justify-content-start">
                                <div class="d-inline-block">
                                    <a href="#"><span class="badge fw-normal bg-white published rounded-pill">Published</span></a>
                                    <a href="#"><span class="badge fw-normal bg-white scheduled rounded-pill">Scheduled</span></a>
                                    <a href="#"><span class="badge fw-normal bg-white draft rounded-pill">Draft</span></a>
                                    <a href="#"><span class="badge fw-normal bg-white inactive rounded-pill">Draft</span></a>
                                </div>
                        </div>
              

                        <div class="section-title mb-4 mt-12">
                                
                                <h2 class="fw-semibold mb-2 pb-1 fs-2">
                                    Freshdesk Omni 
                                </h2>
                                <span class="font-12 mb-0 fw-normal color-support">
                                    Description
                                </span>
                                <p class="font-19 fw-normal text-black">
                                    Explore How-To's and learn best practices from our knowledge base
                                </p>
                                
                            </div>  
                    <div class="d-inline-block w-100 mt-10px">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-articles-tab" data-bs-toggle="pill" data-bs-target="#pills-articles" type="button" role="tab" aria-controls="pills-articles" aria-selected="true">
                                    All Articles
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-kb-tab" data-bs-toggle="pill" data-bs-target="#pills-kb" type="button" role="tab" aria-controls="pills-kb" aria-selected="false" tabindex="-1">
                                    Categories &amp; Sub Categories Group
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-seetings-tab" data-bs-toggle="pill" data-bs-target="#pills-settings" type="button" role="tab" aria-controls="pills-settings" aria-selected="false" tabindex="-1">
                                   Board Settings
                                </button>
                            </li>
                        
                        </ul>
                        
                    </div>
                     <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-articles" role="tabpanel" aria-labelledby="pills-articles-tab">
                        <div class="row mt-20">
                            <div class="col-lg-12">
                                <div class="">
                                    <div class="card p-0 bg-white border-radius-card">
                                        <div class="d-flex border-title align-items-center justify-content-between">
                                            <h4 class="fw-medium mb-0 ">{{ $totalCount }} Articles</h4>
                                            <div class="btn-wrapper d-flex align-items-center justify-content-center gap15 flex-wrap mb-0">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="showImg">
                                                    <label class="form-check-label" for="showImg">
                                                    Show Image
                                                    </label>
                                                </div>
                                                <div class="position-relative form-group" style="width: 250px;">
                                                    <input type="search" id="searchInput" class="input-field w-100 rounded ps-5" placeholder="Search">
                                                    <img src="{{ asset('assets/img/icon/search.svg') }}" alt="search"
                                                        class="position-absolute top-50 start-0 translate-middle-y ms-3">
                                                </div>
                                                
                                                <div class="form-group">
                                                <select id="statusFilter" class="form-select rounded custom-border">
                                                            <option value="">Name</option>
                                                            <option value="active">Active</option>
                                                            <option value="inactive">Inactive</option>
                                                            <option value="draft">Draft</option>
                                                </select>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="article-list space-y-4" id="article-list">
                                        <div class="table-responsive">
                                            <div id="listingArticles_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer"><table id="listingArticles" class="table table-bordered align-middle dataTable" style="width: 100%;"><colgroup><col data-dt-column="0" style="width: 99.7604px;"><col data-dt-column="1" style="width: 200.531px;"><col data-dt-column="2" style="width: 201.615px;"><col data-dt-column="3" style="width: 150px;"><col data-dt-column="4" style="width: 121.49px;"><col data-dt-column="5" style="width: 62.125px;"></colgroup>
                                                <thead class="table-light">
                                                    <tr><th data-dt-column="0" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc dt-ordering-asc" aria-sort="ascending"><span class="dt-column-title">Status</span><span class="dt-column-order" role="button" aria-label="Status: Activate to invert sorting" tabindex="0"></span></th><th data-dt-column="1" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc"><span class="dt-column-title">Article Name</span><span class="dt-column-order" role="button" aria-label="Article Name: Activate to sort" tabindex="0"></span></th><th data-dt-column="2" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc"><span class="dt-column-title">Published Date</span><span class="dt-column-order" role="button" aria-label="Published Date: Activate to sort" tabindex="0"></span></th><th data-dt-column="3" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc"><span class="dt-column-title">Category</span><span class="dt-column-order" role="button" aria-label="Category: Activate to sort" tabindex="0"></span></th><th data-dt-column="4" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc"><span class="dt-column-title">Score</span><span class="dt-column-order" role="button" aria-label="Score: Activate to sort" tabindex="0"></span></th><th data-dt-column="5" rowspan="1" colspan="1" class="dt-orderable-asc dt-orderable-desc"><span class="dt-column-title">Action</span><span class="dt-column-order" role="button" aria-label="Action: Activate to sort" tabindex="0"></span></th></tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($board->categories as $category)
                                                        @foreach ($category->articles as $article)
                                                        <tr>
                                                            <td class="sorting_1">
                                                                <span class="badge fw-normal bg-white
                                                                    @if($article->status == 'draft') draft
                                                                    @elseif($article->status == 'inactive') inactive
                                                                    @else published @endif rounded-pill">
                                                                    {{ ucfirst($article->status) }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <span>
                                                                    {{ ucfirst($article->title) }}
                                                                </span>
                                                            </td>
                                                            
                                                            <td>
                                                                <span>
                                                                    {{ $article->created_at->format('F d, Y \\a\\t h:i A') }}
                                                                </span>
                                                            </td>
                                                            <td>
                                                                @php
                                                                    // Collect all category names for this article
                                                                    $catNames = $board->categories->pluck('name')->toArray() ?? [];
                                                                @endphp

                                                                @if(count($catNames) > 0)
                                                                    {{-- Show first 2 category badges --}}
                                                                    @foreach(array_slice($catNames, 0, 2) as $cat)
                                                                        <span class="badge fw-normal bg-white published-category border text-dark rounded-pill">
                                                                            {{ $cat }}
                                                                        </span>
                                                                    @endforeach

                                                                    {{-- Show "+N" badge if there are more --}}
                                                                    @if(count($catNames) > 2)
                                                                        <span class="badge fw-normal bg-white more-category rounded-pill tooltip-icon"
                                                                            data-bs-toggle="tooltip"
                                                                            title="{{ implode(', ', array_slice($catNames, 2)) }}">
                                                                            +{{ count($catNames) - 2 }}
                                                                        </span>
                                                                    @endif
                                                                @else
                                                                    <span class="text-muted">—</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <span class="badge fw-normal bg-white border reaction text-dark d-inline-flex align-items-center gap-1">
                                                                    {{ $article->likes_percent ?? 0 }}%
                                                                    <img src="{{ asset('assets/img/icon/thumbs-up.svg') }}" alt="like" class="icon-sm">
                                                                </span>
                                                                <span class="badge fw-normal bg-white border reaction text-dark d-inline-flex align-items-center gap-1">
                                                                    {{ $article->dislikes_percent ?? 0 }}%
                                                                    <img src="{{ asset('assets/img/icon/thumbs-down.svg') }}" alt="dislike" class="icon-sm">
                                                                </span>
                                                                
                                                            </td>
                                                            <td>
                                                                <span class="badge bg-white border text-dark tooltip-icon" data-bs-toggle="tooltip" title="Action">
                                                                <a href="{{ route('kbarticle.view', $article->id) }}">
                                                                    <img src="{{ asset('assets/img/icon/eye.svg') }}" alt="View">
                                                                </a>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    @endforeach
                                                    </tbody>
                                            <tfoot></tfoot></table><div class="dt-autosize" style="width: 100%; height: 0px;"></div></div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-3 px-3 pagination">
                                        <a href="#" type="button" class="fw-semibold  prev text-dark rounded  sm">&lt; Previous</a>  
                                        <div class="page-numbers d-flex align-items-center gap-2"><a href="#" class="pagination-number active">1</a><a href="#" class="pagination-number">2</a></div>
                                    
                                        <a href="#" type="button" class="next fw-semibold rounded  sm">Next &gt;</a>  
                                    </div>
                            </div>
                            </div>
                    
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-kb" role="tabpanel" aria-labelledby="pills-kb-tab">
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="d-flex justify-content-between border-title"> 
                                    <h5 class="fw-medium font-16">List of Categories &amp; Sub-Categories</h5>
                                    <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="showImg">
                                            <label class="form-check-label" for="showImg">
                                            View Mode
                                            </label>
                                    </div>
                                </div>
                                 <div class="d-inline-block mt-10px">
                                    <a href="#" class="theme-btn bg-white text-primary sm secondary fw-semibold rounded d-inline-block">
                                        Expand All
                                    </a>
                                    <a href="#" class="theme-btn bg-white text-primary sm secondary fw-semibold rounded d-inline-block">
                                        Collapse All
                                    </a>
                                    <a href="#" class="theme-btn disabled-link bg-white text-primary sm secondary fw-semibold rounded d-inline-block">
                                        Edit Parent Categories
                                    </a>
                                    <a href="#" class="theme-btn disabled-link bg-white text-primary sm secondary fw-semibold rounded d-inline-block">
                                        Edit Sub Categories
                                    </a>
                                 </div>
                                 <div class="card pt-0 px-0 bg-white mt-10px mb-3 ">
                                   
                                    <div class="d-flex border-title align-items-center justify-content-between">
                                    <h4 class="fw-medium mb-0 ">5 Categories</h4>
                                    <div class="btn-wrapper d-flex align-items-center justify-content-center gap15 flex-wrap mb-0">
                                        
                                       
                                        <div class="form-group">
                                        <select class="form-select rounded">
                                                    <option value="">Sort by</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                    <option value="draft">Draft</option>
                                        </select>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="" class="table table-bordered align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 50px;">#</th>
                                                    <th>Article Name</th>
                                                    <th style="width: 250px;">Categories / Subcategories</th>
                                                    <th style="width: 200px;">Number of Articles</th>
                                                    <th style="width: 100px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <tr>
                                                    <td>
                                                        <button class="expand-btn border-0 bg-transparent" data-bs-toggle="collapse" data-bs-target="#group1" aria-expanded="true">
                                                            <i class="fa fa-plus-circle"></i>
                                                        </button>
                                                    </td>
                                                    <td>Announcements, Feedback Forms,</td>
                                                    <td>2</td>
                                                    <td>23</td>
                                                    <td>
                                                        <span class="badge bg-white border text-dark tooltip-icon" data-bs-toggle="modal" data-bs-target="#listingOrder" title="Action">
                                                        <a href="#">  <img src="{{ asset('assets/img/icon/eye.svg') }}" alt="View"></a>
                                                        </span>
                                                    </td>
                                                </tr>
                                                 <!-- Level 1 collapse -->
                                                <tr>
                                                <td colspan="5" class="p-0">
                                                    <div class="collapse" id="group1">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                        <!-- Level 1 -->
                                                        <tr class="level-1">
                                                            <td style="width: 50px;"></td>
                                                            <td><button class="expand-btn border-0 bg-transparent" data-bs-toggle="collapse" data-bs-target="#subgroup1" aria-expanded="true">
                                                                <i class="fa fa-plus-circle"></i>
                                                            </button>
                                                            Announcements, Feedback Forms,</td>
                                                            <td style="width: 250px;">1</td>
                                                            <td style="width: 200px;">0</td>
                                                            <td style="width: 100px;">
                                                                 <span class="badge bg-white border text-dark tooltip-icon" data-bs-toggle="tooltip" title="Action">
                                                        <a href="#">  <img src="{{ asset('assets/img/icon/eye.svg') }}" alt="View"></a>
                                                        </span>
                                                            </td>
                                                        </tr>

                                                        <!-- Level 2 collapse -->
                                                        <tr>
                                                            <td colspan="5" class="p-0">
                                                            <div class="collapse" id="subgroup1">
                                                                <table class="table mb-0">
                                                                <tbody>
                                                                    <!-- Level 2 -->
                                                                    <tr class="level-2">
                                                                    <td style="width: 50px;"></td>
                                                                    <td>Announcements, Feedback Forms,</td>
                                                                    <td style="width: 250px;">0</td>
                                                                    <td style="width: 200px;">23</td>
                                                                    <td style="width: 100px;">
                                                                         <span class="badge bg-white border text-dark tooltip-icon" data-bs-toggle="tooltip" title="Action">
                                                        <a href="#">  <img src="{{ asset('assets/img/icon/eye.svg') }}" alt="View"></a>
                                                        </span>
                                                                    </td>
                                                                    </tr>
                                                                </tbody>
                                                                </table>
                                                            </div>
                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                    </div>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <button class="expand-btn border-0 bg-transparent" data-bs-toggle="collapse" data-bs-target="#group2" aria-expanded="true">
                                                            <i class="fa fa-plus-circle"></i>
                                                        </button>
                                                    </td>
                                                    <td>Announcements, Feedback Forms,</td>
                                                    <td>2</td>
                                                    <td>23</td>
                                                    <td>
                                                        <span class="badge bg-white border text-dark tooltip-icon" data-bs-toggle="tooltip" title="Action">
                                                        <a href="#">  <img src="{{ asset('assets/img/icon/eye.svg') }}" alt="View"></a>
                                                        </span>
                                                    </td>
                                                </tr>
                                                 <!-- Level 1 collapse -->
                                                <tr>
                                                <td colspan="5" class="p-0">
                                                    <div class="collapse" id="group2">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                        <!-- Level 1 -->
                                                        <tr class="level-1">
                                                            <td style="width: 50px;"></td>
                                                            <td><button class="expand-btn border-0 bg-transparent" data-bs-toggle="collapse" data-bs-target="#subgroup2" aria-expanded="true">
                                                                <i class="fa fa-plus-circle"></i>
                                                            </button>
                                                            Announcements, Feedback Forms,</td>
                                                            <td style="width: 250px;">1</td>
                                                            <td style="width: 200px;">0</td>
                                                            <td style="width: 100px;">
                                                                 <span class="badge bg-white border text-dark tooltip-icon" data-bs-toggle="tooltip" title="Action">
                                                        <a href="#">  <img src="{{ asset('assets/img/icon/eye.svg') }}" alt="View"></a>
                                                        </span>
                                                            </td>
                                                        </tr>

                                                        <!-- Level 2 collapse -->
                                                        <tr>
                                                            <td colspan="5" class="p-0">
                                                            <div class="collapse" id="subgroup2">
                                                                <table class="table mb-0">
                                                                <tbody>
                                                                    <!-- Level 2 -->
                                                                    <tr class="level-2">
                                                                    <td style="width: 50px;"></td>
                                                                    <td>Announcements, Feedback Forms,</td>
                                                                    <td style="width: 250px;">0</td>
                                                                    <td style="width: 200px;">23</td>
                                                                    <td style="width: 100px;">
                                                                         <span class="badge bg-white border text-dark tooltip-icon" data-bs-toggle="tooltip" title="Action">
                                                        <a href="#">  <img src="{{ asset('assets/img/icon/eye.svg') }}" alt="View"></a>
                                                        </span>
                                                                    </td>
                                                                    </tr>
                                                                </tbody>
                                                                </table>
                                                            </div>
                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                    </div>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <button class="expand-btn border-0 bg-transparent" data-bs-toggle="collapse" data-bs-target="#group3" aria-expanded="true">
                                                            <i class="fa fa-plus-circle"></i>
                                                        </button>
                                                    </td>
                                                    <td>Announcements, Feedback Forms,</td>
                                                    <td>2</td>
                                                    <td>23</td>
                                                    <td>
                                                        <span class="badge bg-white border text-dark tooltip-icon" data-bs-toggle="tooltip" title="Action">
                                                        <a href="#">  <img src="{{ asset('assets/img/icon/eye.svg') }}" alt="View"></a>
                                                        </span>
                                                    </td>
                                                </tr>
                                                 <!-- Level 1 collapse -->
                                                <tr>
                                                <td colspan="5" class="p-0">
                                                    <div class="collapse" id="group3">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                        <!-- Level 1 -->
                                                        <tr class="level-1">
                                                            <td style="width: 50px;"></td>
                                                            <td><button class="expand-btn border-0 bg-transparent" data-bs-toggle="collapse" data-bs-target="#subgroup3" aria-expanded="true">
                                                                <i class="fa fa-plus-circle"></i>
                                                            </button>
                                                            Announcements, Feedback Forms,</td>
                                                            <td style="width: 250px;">1</td>
                                                            <td style="width: 200px;">0</td>
                                                            <td style="width: 100px;">
                                                                 <span class="badge bg-white border text-dark tooltip-icon" data-bs-toggle="tooltip" title="Action">
                                                        <a href="#">  <img src="{{ asset('assets/img/icon/eye.svg') }}" alt="View"></a>
                                                        </span>
                                                            </td>
                                                        </tr>

                                                        <!-- Level 2 collapse -->
                                                        <tr>
                                                            <td colspan="5" class="p-0">
                                                            <div class="collapse" id="subgroup3">
                                                                <table class="table mb-0">
                                                                <tbody>
                                                                    <!-- Level 2 -->
                                                                    <tr class="level-2">
                                                                    <td style="width: 50px;"></td>
                                                                    <td>Announcements, Feedback Forms,</td>
                                                                    <td style="width: 250px;">0</td>
                                                                    <td style="width: 200px;">23</td>
                                                                    <td style="width: 100px;">
                                                                         <span class="badge bg-white border text-dark tooltip-icon" data-bs-toggle="tooltip" title="Action">
                                                        <a href="#">  <img src="{{ asset('assets/img/icon/eye.svg') }}" alt="View"></a>
                                                        </span>
                                                                    </td>
                                                                    </tr>
                                                                </tbody>
                                                                </table>
                                                            </div>
                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                    </div>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <button class="expand-btn border-0 bg-transparent" data-bs-toggle="collapse" data-bs-target="#group4" aria-expanded="true">
                                                            <i class="fa fa-plus-circle"></i>
                                                        </button>
                                                    </td>
                                                    <td>Announcements, Feedback Forms,</td>
                                                    <td>2</td>
                                                    <td>23</td>
                                                    <td>
                                                        <span class="badge bg-white border text-dark tooltip-icon" data-bs-toggle="tooltip" title="Action">
                                                        <a href="#">  <img src="{{ asset('assets/img/icon/eye.svg') }}" alt="View"></a>
                                                        </span>
                                                    </td>
                                                </tr>
                                                 <!-- Level 1 collapse -->
                                                <tr>
                                                <td colspan="5" class="p-0">
                                                    <div class="collapse" id="group4">
                                                    <table class="table mb-0">
                                                        <tbody>
                                                        <!-- Level 1 -->
                                                        <tr class="level-1">
                                                            <td style="width: 50px;"></td>
                                                            <td><button class="expand-btn border-0 bg-transparent" data-bs-toggle="collapse" data-bs-target="#subgroup4" aria-expanded="true">
                                                                <i class="fa fa-minus-circle"></i>
                                                            </button>
                                                            Announcements, Feedback Forms,</td>
                                                            <td style="width: 250px;">1</td>
                                                            <td style="width: 200px;">0</td>
                                                            <td style="width: 100px;">
                                                                 <span class="badge bg-white border text-dark tooltip-icon" data-bs-toggle="tooltip" title="Action">
                                                        <a href="#">  <img src="{{ asset('assets/img/icon/eye.svg') }}" alt="View"></a>
                                                        </span>
                                                            </td>
                                                        </tr>

                                                        <!-- Level 2 collapse -->
                                                        <tr>
                                                            <td colspan="5" class="p-0">
                                                            <div class="collapse" id="subgroup4">
                                                                <table class="table mb-0">
                                                                <tbody>
                                                                    <!-- Level 2 -->
                                                                    <tr class="level-2">
                                                                    <td style="width: 50px;"></td>
                                                                    <td>Announcements, Feedback Forms,</td>
                                                                    <td style="width: 250px;">0</td>
                                                                    <td style="width: 200px;">23</td>
                                                                    <td style="width: 100px;">
                                                                         <span class="badge bg-white border text-dark tooltip-icon" data-bs-toggle="tooltip" title="Action">
                                                        <a href="#">  <img src="{{ asset('assets/img/icon/eye.svg') }}" alt="View"></a>
                                                        </span>
                                                                    </td>
                                                                    </tr>
                                                                </tbody>
                                                                </table>
                                                            </div>
                                                            </td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                    </div>
                                                </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    
                            </div>
                            </div>
                    
                        </div>
                    </div>
                </div>
                           
                                             
                    </div>
                    <div class="card-footer gap15 bg-white d-flex justify-content-end">
                    <a href="{{route('board.index')}}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Back to Listing</a>
                                      
                    <div class="icon-box">
                                    <a href="#"><img src="{{ asset('assets/img/icon/edit.svg') }}" alt=""></a>
                                    <div class="divider"></div>
                                    <a href="#"><img src="{{ asset('assets/img/icon/oval.svg') }}" alt=""></a>
                                    <div class="divider"></div>
                                    <a href="#"><img src="{{ asset('assets/img/icon/trash.svg') }}" alt=""></a>
                                </div>
                        </div>
                </div>
            </div>
        </div>
        </section>
   
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.querySelector('#searchInput');
        const statusFilter = document.querySelector('#statusFilter');
        const tableBody = document.querySelector('#listingArticles tbody');
        const rows = Array.from(tableBody.querySelectorAll('tr'));
        const perPage = 5;
        let currentPage = 1;
        let filteredRows = [...rows];

        function renderTable() {
            const searchValue = searchInput.value.toLowerCase().trim();
            const statusValue = statusFilter.value.toLowerCase().trim();

            // Filter rows
            filteredRows = rows.filter(row => {
                const title = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase().trim() || '';
                const status = row.querySelector('td:nth-child(1) span')?.textContent.toLowerCase().trim() || '';
                return (
                    title.includes(searchValue) &&
                    (statusValue === '' || status === statusValue)
                );
            });

            const totalPages = Math.ceil(filteredRows.length / perPage);
            if (currentPage > totalPages) currentPage = 1; // Reset if current page > total

            const start = (currentPage - 1) * perPage;
            const end = start + perPage;

            // Render visible rows
            tableBody.innerHTML = '';
            filteredRows.slice(start, end).forEach(row => tableBody.appendChild(row));

            // Render pagination
            const pageNumbers = document.querySelector('.page-numbers');
            pageNumbers.innerHTML = '';

            if (totalPages === 0) {
                pageNumbers.innerHTML = '<span class="text-muted small">-</span>';
                return;
            }

            for (let i = 1; i <= totalPages; i++) {
                const pageLink = document.createElement('a');
                pageLink.href = '#';
                pageLink.textContent = i;
                pageLink.className = 'pagination-number' + (i === currentPage ? ' active' : '');
                pageLink.addEventListener('click', (e) => {
                    e.preventDefault();
                    currentPage = i;
                    renderTable();
                });
                pageNumbers.appendChild(pageLink);
            }
        }

        // Prev/Next buttons
        document.querySelector('.prev').addEventListener('click', (e) => {
            e.preventDefault();
            const totalPages = Math.ceil(filteredRows.length / perPage);
            if (currentPage > 1) {
                currentPage--;
                renderTable();
            }
        });

        document.querySelector('.next').addEventListener('click', (e) => {
            e.preventDefault();
            const totalPages = Math.ceil(filteredRows.length / perPage);
            if (currentPage < totalPages) {
                currentPage++;
                renderTable();
            }
        });

        // Reset to first page when search or filter changes
        searchInput.addEventListener('input', () => {
            currentPage = 1;
            renderTable();
        });
        statusFilter.addEventListener('change', () => {
            currentPage = 1;
            renderTable();
        });

        renderTable();
    });

</script>

 
@endsection
