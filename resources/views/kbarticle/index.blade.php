@extends('layouts.app')
@section('content')
    <main class="mb-240">
        <section class=" main-content-wrapper p-0">
            <div class="d-flex justify-content-between">
                <h4 class="fw-medium font-16 ">@customLabel('Knowledge Board')</h4>
                <div class="btn-wrapper d-flex align-items-center justify-content-center gap-2 flex-wrap mb-0">
                    <a href="{{route('kbarticle.create')}}" class="theme-btn sm fw-semibold rounded d-inline-block">
                        Add Article
                    </a>
                    <a href="{{ route('board.create') }}" class="theme-btn text-primary bg-white sm secondary fw-semibold rounded d-inline-block">
                        Add @customLabel('Knowledge Board')
                    </a>
                    <a href="{{--{{route('kbcategory.create')}}--}}" class="theme-btn text-primary bg-white sm secondary fw-semibold rounded d-inline-block">
                        Add Category
                    </a>

                </div>
            </div>
            <div class="d-inline-block w-100 mt-10px">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-kb-tab" data-bs-toggle="pill" data-bs-target="#pills-kb" type="button" role="tab" aria-controls="pills-kb" aria-selected="false">
                            All @customLabel('Knowledge Board')
                        </button>
                    </li>
{{--                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-articles-tab" data-bs-toggle="pill" data-bs-target="#pills-articles" type="button" role="tab" aria-controls="pills-articles" aria-selected="true">
                            All Articles
                        </button>
                    </li>--}}
                </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-content" id="pills-tabContent">
                    <!-- ✅ All Knowledge Board Tab -->
                    <div class="tab-pane fade show active" id="pills-kb" role="tabpanel" aria-labelledby="pills-kb-tab">
                        <div class="card p-0 bg-white rounded border">
                            <div class="d-flex border-title align-items-center justify-content-between px-3 pt-3">
                                <h4 class="fw-medium mb-0">@customLabel('Knowledge Board') ({{$totalKB}})</h4>
                                <div class="btn-wrapper d-flex align-items-center justify-content-center gap15 flex-wrap mb-0">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="showImg">
                                        <label class="form-check-label" for="showImg">Show Image</label>
                                    </div>

                                    <div class="position-relative form-group">
                                        <input type="search" id="boardSearch" class="input-field w-100 rounded ps-5" placeholder="Search Boards">
                                        <img src="{{ asset('assets/img/icon/search.svg') }}" class="position-absolute search-icon" alt="">
                                    </div>

                                    <div class="form-group">
                                        <select class="form-select rounded border" id="boardTypeFilter">
                                            <option value="all">All Boards</option>
                                            <option value="public">Public Board</option>
                                            <option value="private">Private Board</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="listingWrapper">
                                @include('kbarticle.partials.board_list', ['boards' => $boards])
                            </div>
                        </div>
                    </div>

{{--
                    <!-- 📰 All Articles Tab -->
                    <div class="tab-pane fade" id="pills-articles" role="tabpanel" aria-labelledby="pills-articles-tab">
                        <div class="card p-0 bg-white rounded border">
                            <div class="d-flex border-title align-items-center justify-content-between px-3 pt-3">
                                <h4 class="fw-medium mb-0">Articles({{$total}})</h4>
                                <div class="btn-wrapper d-flex align-items-center justify-content-center gap15 flex-wrap mb-0">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="showImg">
                                        <label class="form-check-label" for="showImg">Show Image</label>
                                    </div>

                                    <div class="position-relative form-group">
                                        <input type="search" id="articleSearch" class="input-field w-100 rounded ps-5" placeholder="Search Boards">
                                        <img src="{{ asset('assets/img/icon/search.svg') }}" class="position-absolute search-icon" alt="">
                                    </div>

                                    <div class="form-group">
                                        <select class="form-select rounded" id="articleTypeFilter">
                                            <option value="all">All Boards</option>
                                            <option value="public">Public Board</option>
                                            <option value="private">Private Board</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div id="listingWrapper">
                                @include('kbarticle.partials.article_list', ['articles' => $articles])
                            </div>
                        </div>
                    </div>
--}}
                </div>

            </div>

        </section>
    </main>
@endsection
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.querySelector('#boardSearch');
            const typeFilter = document.querySelector('#boardTypeFilter');
            const listingWrapper = document.querySelector('#listingWrapper');

            let currentQuery = '';
            let currentType = 'all';

            // 🔁 Function to load boards (handles all + pagination + filters)
            function loadBoards(page = 1) {
                const query = searchInput?.value?.trim() || '';
                const type = currentType || '';

                const params = new URLSearchParams();
                if (query) params.append('q', query);
                params.append('type', type);
                params.append('page', page);
                fetch(`{{ route('board.search') }}?${params.toString()}`, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.html) {
                            listingWrapper.innerHTML = data.html;
                            initPagination(); // rebind pagination after load
                        }
                    })
                    .catch(error => console.error('Error loading boards:', error));
            }

            // 🔎 Live search
            if (searchInput) {
                let searchTimeout = null;
                searchInput.addEventListener('input', function () {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        currentQuery = this.value.trim();
                        loadBoards(1);
                    }, 400);
                });
            }

            if (typeFilter) {
                typeFilter.addEventListener('change', function () {
                    currentType = this.value; // will be 'all', 'public', or 'private'
                    loadBoards(1);
                });
            }

            // 🔁 Handle pagination (AJAX)
            function initPagination() {
                document.querySelectorAll('.pagination a[data-page]').forEach(link => {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();
                        const page = this.dataset.page;
                        loadBoards(page);
                    });
                });
            }

            // Initialize pagination once on page load
            initPagination();
        });

    </script>

