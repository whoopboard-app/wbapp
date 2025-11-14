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
            <div id="toast-container" style="position: fixed; top: 80px; right: 20px; z-index: 9999;"></div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card  p-0 bg-white mb-3">
                        <div class="d-flex align-items-center border-title justify-content-between">
                            <h4 class="fw-medium mb-0">33 Impression</h4>
                             <div class="btn-wrapper d-flex align-items-center justify-content-center gap15 flex-wrap mb-0">
                                 <a href="{{ route('kbcategory.create', ['board_id' => $board->id]) }}"
                                    class="theme-btn sm fw-semibold rounded d-inline-block">
                                     Add Category
                                 </a>
                                 <a href="{{route('kbarticle.create', ['board_id' => $board->id])}}" class="theme-btn text-primary bg-white sm secondary fw-semibold rounded d-inline-block">
                                     Add Article
                                 </a>
                                <a href="{{route('board.index')}}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Back to Listing</a>
                                 <div class="icon-box">
                                     <a href="{{ route('board.edit', $board->id) }}">
                                         <img src="{{ asset('assets/img/icon/edit.svg') }}" alt="Edit">
                                     </a>
                                    <div class="divider"></div>
                                    <a href="#"><img src="{{ asset('assets/img/icon/oval.svg') }}" alt=""></a>
                                    <div class="divider"></div>
                                     <form action="{{ route('board.destroy', $board->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this board?');" style="display:inline;">
                                         @csrf
                                         @method('DELETE')
                                         <button type="submit" style="border:none; background:none; padding:0;">
                                             <img src="{{ asset('assets/img/icon/trash.svg') }}" alt="Delete">
                                         </button>
                                     </form>
                                </div>
                             </div>
                        </div>
                         <div class=" p-3 border-top">
                             @php
                                 $statusClasses = [
                                     0 => 'status-inactive',    // Inactive
                                     1 => 'status-active',  // Active
                                     2 => 'status-draft' // Draft
                                 ];
                                 $statusLabels = [
                                     0 => 'Inactive',
                                     1 => 'Active',
                                     2 => 'Draft'
                                 ];
                             @endphp
                             <span class="badge fw-normal bg-white
                        {{ $board->status == '1' ? 'status-active' : ($board->status == '2' ? 'status-draft' : 'status-inactive') }}
                        rounded-pill border-1">
                        {{ $board->status == '1' ? 'Active' : ($board->status == '2' ? 'Draft' : 'Inactive') }}
                    </span>
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
                                    <h5 class="fw-medium font-16">
                                        <span id="modeLabel">List of Categories &amp; Sub-Categories</span>
                                    </h5>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="editModeToggle">
                                        <label class="form-check-label" for="editModeToggle">View Mode</label>
                                    </div>
                                </div>
                                 <div class="d-inline-block mt-10px">
                                     <a href="#" id="expandAllBtn" class="theme-btn bg-white text-primary sm secondary fw-semibold rounded d-inline-block">
                                         Expand All
                                     </a>
                                     <a href="#" id="collapseAllBtn" class="theme-btn bg-white text-primary sm secondary fw-semibold rounded d-inline-block">
                                         Collapse All
                                     </a>
                                     <a href="#" id="editParent" class="theme-btn disabled-link bg-white text-primary sm secondary fw-semibold rounded d-inline-block">
                                         Edit Parent Categories
                                     </a>
                                     <a href="#" id="editSub" class="theme-btn disabled-link bg-white text-primary sm secondary fw-semibold rounded d-inline-block">
                                         Edit Sub Categories
                                     </a>
                                     {{-- Edit Parent Categories Modal --}}
                                     @include('kbarticle.partials.edit_parentcategory', [
                                         'modalId' => 'editParentModal',
                                         'kbcategories' => $kbcategories,
                                         'isSubCategory' => false
                                     ])

                                     {{-- Edit Sub Categories Modal --}}
                                     @include('kbarticle.partials.edit_parentcategory', [
                                         'modalId' => 'editSubModal',
                                         'kbcategories' => $kbcategories,
                                         'isSubCategory' => true
                                     ])
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
                                                <th>Category Name</th>
                                                <th style="width: 250px;">Subcategories</th>
                                                <th style="width: 200px;">Number of Articles</th>
                                                <th style="width: 100px;">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($kbcategories->where('parent_id', null) as $category)
                                                @include('kbarticle.partials.category_tree', ['category' => $category, 'level' => 0])
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
                        <div class="btn-wrapper d-flex align-items-center justify-content-center gap15 flex-wrap mb-0">
                            <a href="{{route('board.index')}}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Back to Listing</a>
                            <div class="icon-box">
                                <a href="{{ route('board.edit', $board->id) }}">
                                    <img src="{{ asset('assets/img/icon/edit.svg') }}" alt="Edit">
                                </a>
                                <div class="divider"></div>
                                <a href="#"><img src="{{ asset('assets/img/icon/oval.svg') }}" alt=""></a>
                                <div class="divider"></div>
                                <form action="{{ route('board.destroy', $board->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this board?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border:none; background:none; padding:0;">
                                        <img src="{{ asset('assets/img/icon/trash.svg') }}" alt="Delete">
                                    </button>
                                </form>
                            </div>
                        </div>
                        </div>
                </div>
            </div>
        </div>
        </section>
    <script>
        function showAlert(type, message) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `alert alert-${type} shadow-sm mb-2`;
            toast.style.minWidth = '250px';
            toast.textContent = message;
            container.appendChild(toast);

            setTimeout(() => toast.remove(), 2000);
        }
        document.getElementById('editModeToggle').addEventListener('change', function() {
            const isChecked = this.checked;
            const parentBtn = document.getElementById('editParent');
            const subBtn = document.getElementById('editSub');
            const label = document.querySelector('label[for="editModeToggle"]');
            const modeLabel = document.getElementById('modeLabel');

            if (isChecked) {
                parentBtn.classList.remove('disabled-link');
                subBtn.classList.remove('disabled-link');
                label.textContent = 'Edit Mode';
                modeLabel.textContent = 'Edit Categories & Sub-Categories';
            } else {
                parentBtn.classList.add('disabled-link');
                subBtn.classList.add('disabled-link');
                label.textContent = 'View Mode';
                modeLabel.textContent = 'List of Categories & Sub-Categories';
            }
        });
        document.getElementById('editParent').addEventListener('click', function (e) {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('editParentModal'));
            modal.show();
        });

        document.getElementById('editSub').addEventListener('click', function (e) {
            e.preventDefault();
            const modal = new bootstrap.Modal(document.getElementById('editSubModal'));
            modal.show();
        });
        document.addEventListener('DOMContentLoaded', function () {
            const expandBtn = document.querySelector('#expandAllBtn');
            const collapseBtn = document.querySelector('#collapseAllBtn');

            function toggleAllRows(show = true) {
                const childRows = document.querySelectorAll('#listingCategories tbody .child-row');
                childRows.forEach(row => row.classList.toggle('d-none', !show));

                const icons = document.querySelectorAll('#listingCategories tbody .expand-btn i');
                icons.forEach(icon => {
                    icon.classList.toggle('fa-plus-circle', !show);
                    icon.classList.toggle('fa-minus-circle', show);
                });
            }

            if(expandBtn) {
                expandBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    toggleAllRows(true);
                });
            }

            if(collapseBtn) {
                collapseBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    toggleAllRows(false);
                });
            }
            document.addEventListener('click', function(e) {
                const button = e.target.closest('.expand-btn');
                if (!button) return;

                const groupClass = button.dataset.group;
                const icon = button.querySelector('i');
                const rows = document.querySelectorAll('.' + groupClass);

                rows.forEach(row => {
                    const isHidden = row.classList.contains('d-none');
                    row.classList.toggle('d-none', !isHidden);
                    if (!isHidden) {
                        const nestedButtons = row.querySelectorAll('.expand-btn');
                        nestedButtons.forEach(nBtn => {
                            const nGroup = nBtn.dataset.group;
                            const nestedRows = document.querySelectorAll('.' + nGroup);
                            nestedRows.forEach(nr => nr.classList.add('d-none'));
                            const nIcon = nBtn.querySelector('i');
                            if(nIcon) {
                                nIcon.classList.remove('fa-minus-circle');
                                nIcon.classList.add('fa-plus-circle');
                            }
                        });
                    }
                });

                if(icon) {
                    icon.classList.toggle('fa-plus-circle');
                    icon.classList.toggle('fa-minus-circle');
                }
            });
         const searchInput = document.querySelector('#searchInput');
            const statusFilter = document.querySelector('#statusFilter');
            const tableBody = document.querySelector('#listingArticles tbody');
            const rows = Array.from(tableBody.querySelectorAll('tr'));
            const perPage = 5;
            let currentPage = 1;
            let filteredRows = [...rows];

            function renderTable() {
                const searchValue = searchInput?.value.toLowerCase().trim() || '';
                const statusValue = statusFilter?.value.toLowerCase().trim() || '';

                filteredRows = rows.filter(row => {
                    const title = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase().trim() || '';
                    const status = row.querySelector('td:nth-child(1) span')?.textContent.toLowerCase().trim() || '';
                    return title.includes(searchValue) && (!statusValue || status === statusValue);
                });

                const totalPages = Math.ceil(filteredRows.length / perPage);
                if(currentPage > totalPages) currentPage = 1;

                const start = (currentPage - 1) * perPage;
                const end = start + perPage;

                tableBody.innerHTML = '';
                if(filteredRows.length === 0) {
                    const noDataRow = document.createElement('tr');
                    const noDataCell = document.createElement('td');
                    noDataCell.textContent = 'No data available';
                    noDataCell.colSpan = 100;
                    noDataCell.style.textAlign = 'center';
                    noDataRow.appendChild(noDataCell);
                    tableBody.appendChild(noDataRow);
                } else {
                    filteredRows.slice(start, end).forEach(row => tableBody.appendChild(row));
                }
                const pageNumbers = document.querySelector('.page-numbers');
                if(pageNumbers){
                    pageNumbers.innerHTML = '';
                    if(totalPages === 0){
                        pageNumbers.innerHTML = '<span class="text-muted small">-</span>';
                    } else {
                        for(let i=1; i<=totalPages; i++){
                            const pageLink = document.createElement('a');
                            pageLink.href = '#';
                            pageLink.textContent = i;
                            pageLink.className = 'pagination-number' + (i===currentPage?' active':'');
                            pageLink.addEventListener('click', e=>{
                                e.preventDefault();
                                currentPage=i;
                                renderTable();
                            });
                            pageNumbers.appendChild(pageLink);
                        }
                    }
                }
            }

            document.querySelector('.prev')?.addEventListener('click', e=>{
                e.preventDefault();
                if(currentPage>1){ currentPage--; renderTable(); }
            });
            document.querySelector('.next')?.addEventListener('click', e=>{
                e.preventDefault();
                const totalPages = Math.ceil(filteredRows.length / perPage);
                if(currentPage<totalPages){ currentPage++; renderTable(); }
            });

            searchInput?.addEventListener('input', ()=>{ currentPage=1; renderTable(); });
            statusFilter?.addEventListener('change', ()=>{ currentPage=1; renderTable(); });
            renderTable();

            // --------------------------
            // 4. Category status filter
            // --------------------------
            const statusFilterCtg = document.querySelector('#statusFilter_ctg');
            const catRows = Array.from(document.querySelectorAll('#listingCategories tbody tr'));
            if(statusFilterCtg){
                const noDataRow = document.createElement('tr');
                noDataRow.innerHTML = `<td colspan="100%" class="text-center py-3 text-gray-500">No data available</td>`;
                noDataRow.style.display='none';
                document.querySelector('#listingCategories tbody').appendChild(noDataRow);

                statusFilterCtg.addEventListener('change', function(){
                    const selected = this.value.toLowerCase();
                    let visibleCount = 0;
                    catRows.forEach(row => {
                        const rowStatus = row.getAttribute('data-status') || '';
                        if(!selected || rowStatus === selected){
                            row.style.display='';
                            visibleCount++;
                        } else {
                            row.style.display='none';
                        }
                    });
                    noDataRow.style.display = visibleCount===0 ? '' : 'none';
                });
            }
        });
    </script>



@endsection
