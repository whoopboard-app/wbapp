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
                           class="theme-btn sm secondary fw-semibold rounded d-inline-block">
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
                       class="theme-btn sm fw-semibold rounded d-inline-block"
                       data-bs-toggle="modal" data-bs-target="#createBoardCategoryModal">
                        <i class="fa fa-plus"></i> Add @customLabel('Knowledge Board') Categories
                    </a>
                    <a href="javascript:void(0);"
                       class="theme-btn sm secondary fw-semibold rounded d-inline-block"
                       data-bs-toggle="modal" data-bs-target="#createArticleModal">
                        <i class="fa fa-plus"></i> Add Article
                    </a>
                </div>

                {{-- Tabs --}}
                <div class="border-bottom-0 mb-4 d-flex align-items-start">
                    <nav class="d-flex align-items-center justify-content-center">
                        <div class="nav nav-tabs justify-content-center rounded">
                            @php $filters = ['all' => 'All', 'bugs' => 'Bugs', 'new-features' => 'New Features', 'prem-features' => 'Premium Features', 'enhancement' => 'Enhancement']; @endphp
                            @foreach($filters as $key => $label)
                                <a href="{{ route('announcement.filter', ['filter' => $key]) }}"
                                   class="p-text1 dt-filter-btn nav-link rounded position-relative {{ request('filter', 'all') === $key ? 'active' : '' }}">
                                    {{ $label }}
                                </a>
                            @endforeach
                        </div>
                    </nav>
                </div>

                {{-- Search + Actions --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="position-relative form-group d-flex align-items-center">
                        <input type="search" id="search" name="search"
                               class="input-field w-100 rounded ps-5" placeholder="Search">
                        <img src="/assets/img/icon/search.svg" class="position-absolute search-icon ml-3" alt="">
                    </div>
                    {{--                    <div class="d-flex gap-2">
                                            <a href="#" class="theme-btn secondary rounded fw-medium btn-icon-text">
                                                <div class="icon-text-wrap d-flex gap-2">
                                                    <img src="/assets/img/icon/filter.svg" alt="">
                                                    <span>Filter</span>
                                                </div>
                                            </a>
                                            <a href="#" class="theme-btn secondary rounded fw-medium btn-icon-text">
                                                <div class="icon-text-wrap d-flex gap-2">
                                                    <img src="/assets/img/icon/view-as.svg" alt="">
                                                    <span>View as</span>
                                                </div>
                                            </a>
                                        </div>--}}
                </div>
                <h5 class="label fw-medium mb-2">Total Knowledge Board <span>({{ count($boards) }})</span></h5>
                @php
                    $statusClasses = [
                        0 => 'bg-gray-200 text-gray-700',    // Inactive
                        1 => 'bg-green-100 text-green-700',  // Active
                        2 => 'bg-yellow-100 text-yellow-700' // Draft
                    ];
                    $statusLabels = [
                        0 => 'Inactive',
                        1 => 'Active',
                        2 => 'Draft'
                    ];
                @endphp
                @forelse($boards as $board)
                    <div class="card mb-3 bg-white border board-clickable" data-href="{{ route('boards.getBoardCategories', $board->id) }}">
                        <div class="card-body p-0">
                            <div class="d-flex justify-content-between">
                                <div>
                <span class="px-2 py-1 text-xs font-medium rounded {{ $statusClasses[$board->type] ?? 'bg-gray-200 text-gray-700' }}">
                    {{ $statusLabels[$board->type] ?? 'Unknown' }}
                </span>
                                    <h5 class="pt-2 fw-semibold h5">{{$board->name}}</h5>
                                </div>

                                <div class="d-flex align-items-center">
                                    <!-- Three dots dropdown -->
                                    <div class="dropdown">
                                        <a href="#" class="text-dark" role="button" id="boardMenu{{ $board->id }}"
                                           data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="boardMenu{{ $board->id }}">
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#editBoardModal{{ $board->id }}">
                                                    <i class="fa fa-edit me-2"></i> Edit Board
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('kbarticle.destroyBoard', $board->id) }}" method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this board?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fa fa-trash me-2"></i> Delete Board
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <p class="card-text label pb-2">{{$board->description}}</p>
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                @if($board->categories && $board->categories->count())
                                    @foreach($board->categories as $category)
                                        <span class="badge bg-white rounded-pill text-dark border">
                        {{ $category->name }}
                    </span>
                                    @endforeach
                                @else
                                    <p class="text-muted text-center">No Category added for this Board.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @include('kbarticle.partials.edit_board_model', ['board' => $board])
                @empty
                    <p class="text-gray-500 text-center">No announcements found.</p>
                @endforelse

                <div class="mt-4 pagination-wrapper">
                    {{--    {!! $boards->links() !!}--}}
                </div>
            </div>
        @endif
    </div>

    {{-- Include Modals --}}
    @include('kbarticle.partials.create_board_model')
    @include('kbarticle.partials.create_boardcategory_model')
@endsection
<script>
        document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.board-clickable').forEach(card => {
            card.style.cursor = 'pointer'; // show pointer on hover
            card.addEventListener('click', function(e) {
                // Prevent click if dropdown, buttons, or links inside are clicked
                if (!e.target.closest('.dropdown, button, a')) {
                    window.location.href = this.dataset.href;
                }
            });
        });
    });
function copyToClipboard(el) {
        const url = el.getAttribute('data-url'); // get the public_url
        navigator.clipboard.writeText(url).then(() => {
            // Change tooltip/title text
            el.setAttribute('title', 'Copied!');
            el.setAttribute('data-bs-original-title', 'Copied!'); // bootstrap tooltip fix

            // Re-init tooltip to show update
            let tooltip = bootstrap.Tooltip.getInstance(el);
            if (tooltip) {
                tooltip.show();
            } else {
                new bootstrap.Tooltip(el).show();
            }

            // Reset back to default after 2s
            setTimeout(() => {
                el.setAttribute('title', 'Copy to clipboard');
                el.setAttribute('data-bs-original-title', 'Copy to clipboard');
            }, 2000);
        }).catch(err => {
            console.error('Failed to copy: ', err);
        });
    }
</script>
