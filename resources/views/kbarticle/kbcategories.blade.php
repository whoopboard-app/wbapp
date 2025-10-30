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
        .collapse {
            visibility: visible;
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
                        <!-- <div class="d-flex justify-content-start">
                                <div class="d-inline-block">
                                    <a href="#"><span class="badge fw-normal bg-white published rounded-pill">Published</span></a>
                                    <a href="#"><span class="badge fw-normal bg-white scheduled rounded-pill">Scheduled</span></a>
                                    <a href="#"><span class="badge fw-normal bg-white draft rounded-pill">Draft</span></a>
                                    <a href="#"><span class="badge fw-normal bg-white inactive rounded-pill">Draft</span></a>
                                </div>
                        </div> -->
              

                        <div class="section-title mb-4">
                                
                                <h2 class="fw-semibold mb-2 pb-1 fs-2">
                                    {{$board->name}}
                                </h2>
                                <span class="font-12 mb-0 fw-normal color-support">
                                    Description
                                </span>
                                <p class="font-19 fw-normal text-black">
                                    {{$board->description}}
                                </p>
                                <span class="font-12 mb-0 fw-normal color-support">
                                    Type
                                </span>
                                <p class="font-19 fw-normal text-black">
                                    {{ $board->type == 1 ? 'Public' : 'Private' }}
                                </p>
                                <span class="font-12 mb-0 fw-normal color-support">
                                    Docs Type
                                </span>
                                <p class="font-19 fw-normal text-black">
                                    {{$board->docs_type}}
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
                                                                @if($article->category)
                                                                    <span class="badge fw-normal bg-white published-category border text-dark rounded-pill">
                                                                        {{ $article->category->name }}
                                                                    </span>
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
                                    <h4 class="fw-medium mb-0 ">{{$total_kbcategories}} Categories</h4>
                                    <div class="btn-wrapper d-flex align-items-center justify-content-center gap15 flex-wrap mb-0">
                                        
                                       
                                        <div class="form-group">
                                        <select class="form-select rounded" id="statusFilter_ctg">
                                                    <option value="">Sort by</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Inactive</option>
                                                    <option value="draft">Draft</option>
                                        </select>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered align-middle" id="listingCategories">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 50px;">#</th>
                                                    <th>Category Name</th>
                                                    <th style="width: 250px;">Subcategories</th>
                                                    <th style="width: 200px;">Number of Articles</th>
                                                    <th style="width: 100px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($kbcategories as $index => $category)
                                                    {{-- Parent Category Row --}}
                                                    <tr data-status="{{ strtolower($category->status ?? '') }}">
                                                        <td>
                                                            <button class="expand-btn border-0 bg-transparent" data-bs-toggle="collapse" data-bs-target="#group{{ $index }}">
                                                                <i class="fa fa-plus-circle"></i>
                                                            </button>
                                                        </td>
                                                        <td>{{ $category->name }}</td>
                                                        <td>{{ $category->subcategories->count() ?? 0 }}</td>
                                                        <td>{{ $category->articles->count() ?? 0 }}</td>
                                                        <td>
                                                            <span class="badge bg-white border text-dark tooltip-icon" title="View Articles">
                                                                <a href="#"><img src="{{ asset('assets/img/icon/eye.svg') }}" alt="View"></a>
                                                            </span>
                                                        </td>
                                                    </tr>

                                                    {{-- Subcategories Collapse --}}
                                                    @if($category->subcategories && $category->subcategories->count() > 0)
                                                        <tr data-status="{{ strtolower($category->status ?? '') }}">
                                                            <td colspan="5" class="p-0">
                                                                <div class="collapse" id="group{{ $index }}">
                                                                    <table class="table mb-0">
                                                                        <tbody>
                                                                            @foreach ($category->subcategories as $subIndex => $sub)
                                                                                <tr class="level-1">
                                                                                    <td style="width: 50px;"></td>
                                                                                    <td>{{ $sub->name }}</td>
                                                                                    <td style="width: 250px;">—</td>
                                                                                    <td style="width: 200px;">{{ $sub->articles->count() ?? 0 }}</td>
                                                                                    <td style="width: 100px;">
                                                                                        <span class="badge bg-white border text-dark tooltip-icon" title="View Articles">
                                                                                            <a href="#"><img src="{{ asset('assets/img/icon/eye.svg') }}" alt="View"></a>
                                                                                        </span>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
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
            if (currentPage > totalPages) currentPage = 1;

            const start = (currentPage - 1) * perPage;
            const end = start + perPage;

            // Render visible rows
            tableBody.innerHTML = '';
            
            // Check if there are no filtered rows and display a message
            if (filteredRows.length === 0) {
                const noDataRow = document.createElement('tr');
                const noDataCell = document.createElement('td');
                noDataCell.textContent = 'No data available';
                noDataCell.colSpan = 100; // Span across all columns
                noDataCell.style.textAlign = 'center';
                noDataRow.appendChild(noDataCell);
                tableBody.appendChild(noDataRow);
            } else {
                filteredRows.slice(start, end).forEach(row => tableBody.appendChild(row));
            }

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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusFilter = document.querySelector('#statusFilter_ctg');
            const tableBody = document.querySelector('#listingCategories tbody');
            const rows = Array.from(tableBody.querySelectorAll('tr'));

            // Create "No data available" message
            const noDataRow = document.createElement('tr');
            noDataRow.innerHTML = `
                <td colspan="100%" class="text-center py-3 text-gray-500">
                    No data available
                </td>
            `;
            noDataRow.style.display = 'none';
            tableBody.appendChild(noDataRow);

            statusFilter.addEventListener('change', function () {
                const selected = this.value.toLowerCase();
                let visibleCount = 0;

                rows.forEach(row => {
                    const rowStatus = row.getAttribute('data-status') || '';
                    if (!selected || rowStatus === selected) {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Show or hide "No data available" message
                if (visibleCount === 0) {
                    noDataRow.style.display = '';
                } else {
                    noDataRow.style.display = 'none';
                }
            });
        });
    </script>


@endsection
