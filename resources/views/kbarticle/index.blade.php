@extends('layouts.app')
<style>
    .board-clickable:hover {
        background: #0a53be;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: 0.2s;
    }
</style>
@section('content')
    <div class="mt-4 mx-auto w-100">
        <!-- Breadcrumb -->
        <div class="max-w-6xl mx-auto px-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2">
                    <li class="breadcrumb-item text-black">Dashboard</li>
                    <li class="breadcrumb-item">
                        <a href="#" class="text-primary">@customLabel('Knowledge Board')</a>
                    </li>
                </ol>
            </nav>
            <h2 class="fw-semibold fs-4">@customLabel('Knowledge Board')</h2>
            <p class="text-gray-900 mt-1 mb-3 p-text">
                Create dedicated boards for your help guides, product manuals, and documentation.
                Each board focuses on a single document type, making it easy for users to find the right resources quickly.
            </p>
        </div>

        {{-- Empty State --}}
        @if($boards->isEmpty() && $filter == 'all')
            <div class="board-wrapper mx-auto max-w-2xl w-full text-center">
                <img src="{{ asset('assets/img/empty.png') }}" alt="empty" class="empty-img">

                <div class="get-started-changelog mt-4">
                    <h6 class="fw-semibold mb-2">🚀 Get started with the @customLabel('Knowledge Board')</h6>
                    <p class="text-gray-600 p-text">
                        Create your first board to organize help docs, manuals, or product guides.
                        Once your board is ready, you can start adding content right away.
                    </p>

                    <div class="btn-wrapper d-flex align-items-center justify-content-center gap-2 flex-wrap mt-4">
                        <a href="javascript:void(0);"
                           class="theme-btn sm fw-semibold rounded d-inline-block"
                           data-bs-toggle="modal" data-bs-target="#createBoardModal">
                            <i class="fa fa-plus"></i> Add @customLabel('Knowledge Board')
                        </a>
                        <a href="javascript:void(0);"
                           class="theme-btn sm fw-semibold rounded d-inline-block"
                           data-bs-toggle="modal" data-bs-target="#createBoardCategoryModal">
                            <i class="fa fa-plus"></i> Add @customLabel('Knowledge Board') Categories
                        </a>
                        <a href="{{ route('kbarticle.create') }}"
                           class="theme-btn sm fw-semibold rounded d-inline-block">
                            <i class="fa fa-plus"></i> Add Article
                        </a>
                    </div>
                </div>
            </div>
        @else
            {{-- Non-empty State --}}
            <div class="board-wrapper max-w-6xl mx-auto px-2">
                <div class="btn-wrapper d-flex align-items-center gap-2 flex-wrap mb-4">
                    <a href="javascript:void(0);"
                       class="theme-btn sm fw-semibold rounded d-inline-block"
                       data-bs-toggle="modal" data-bs-target="#createBoardModal">
                        <i class="fa fa-plus"></i> Add @customLabel('Knowledge Board')
                    </a>
                    <a href="javascript:void(0);"
                       class="theme-btn sm secondary fw-semibold rounded d-inline-block"
                       data-bs-toggle="modal" data-bs-target="#createBoardCategoryModal">
                        <i class="fa fa-plus"></i> Add @customLabel('Knowledge Board') Categories
                    </a>
                    <a href="{{ route('kbarticle.create') }}"
                       class="theme-btn sm secondary fw-semibold rounded d-inline-block">
                        <i class="fa fa-plus"></i> Add Article
                    </a>
                </div>

                {{-- Search + Actions --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="position-relative form-group d-flex align-items-center">
                        <input type="search" id="search" name="search"
                               class="input-field w-100 rounded ps-5" placeholder="Search">
                        <img src="/assets/img/icon/search.svg" class="position-absolute search-icon ml-3" alt="">
                    </div>
                </div>
                <h5 class="label fw-medium mb-2">Total Knowledge Board <span>({{ count($boards) }})</span></h5>
                <div id="boardsContainer">
                    @include('kbarticle.partials.board_list', ['boards' => $boards])
                </div>

                @endif
    </div>
    @include('kbarticle.partials.create_board_model')
    @include('kbarticle.partials.create_boardcategory_model')
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.board-clickable').forEach(card => {
            card.style.cursor = 'pointer';
            card.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown, button, a')) {
                    window.location.href = this.dataset.href;
                }
            });
        });
    });
</script>
