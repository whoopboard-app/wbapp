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
        <div class="board-wrapper max-w-6xl mx-auto px-2">
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
            <div class="card mb-3 bg-white border">
                <div class="card-body p-0">
                    <div class="d-flex justify-content-between">
                        <div class="">
                                    <span class="px-2 py-1 text-xs font-medium rounded {{ $statusClasses[$board->type] ?? 'bg-gray-200 text-gray-700' }}">
                                        {{ $statusLabels[$board->type] ?? 'Unknown' }}
                                    </span>
                            <h5 class="pt-2 fw-semibold h5">{{$board->name}}</h5>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
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
                            @foreach($board->categories->whereIn('id', $allCategoryIds) as $category)
                                <span class="badge bg-white rounded-pill text-dark border">
                            {{ $category->name }}
                        </span>
                            @endforeach
                        @else
                            <p class="text-muted text-center">No Category added for this Board.</p>
                        @endif

                        <span class="badge bg-white rounded-pill text-url border d-flex align-items-center gap-1">
                            <span class="textToCopied text-gray-500">{{$board->public_url}}</span>
                            <img src="{{ asset('assets/img/icon/clipboard.svg') }}"
                                 class="copyBtn"
                                 style="cursor:pointer; width:16px; height:16px;"
                                 onclick="copyToClipboard(this)"
                                 data-url="{{$board->public_url}}"
                                 data-bs-toggle="tooltip"
                                 data-bs-placement="top"
                                 title="Copy to clipboard"
                                 alt="Copy">
                        </span>

                    </div>

                </div>
            </div>
            @include('kbarticle.partials.edit_board_model', ['board' => $board])
            <div class="mt-4 pagination-wrapper">
                {{--    {!! $boards->links() !!}--}}
            </div>
            <div class="btn-wrapper d-flex align-items-center gap-2 flex-wrap mb-4">
                <a href="{{ route('kbarticle.create') }}"
                   class="theme-btn sm fw-semibold rounded d-inline-block"
                    <i class="fa fa-plus"></i> Add Article
                </a>

                <a href="javascript:void(0);"
                   class="theme-btn sm secondary fw-semibold rounded d-inline-block"
                   data-bs-toggle="modal" data-bs-target="#createBoardModal">
                    <i class="fa fa-plus"></i> Quick Report
                </a>
            </div>
            <p class="text-muted pb-4">Arrange help center categories, sections and articles.</p>

            @if($articles->count())
                <div id="article-list">
                    @foreach($articles as $article)
                        <div class="mb-3 bg-white kb-card cursor-grab shadow-sm rounded border" data-id="{{ $article->id }}">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center p-4">
                                    <div>
                                        <h5 class="card-title mb-1">
                                            <a href="#" class="text-dark text-decoration-none fw-semibold">
                                                {{ $article->title }}
                                            </a>
                                        </h5>
                                        <span class="card-text label text-muted small">
                            Category: {{ $article->category->name ?? 'No Category' }}
                        </span>
                                    </div>
                                    <div>
                                        <img src="{{ asset('assets/img/icon/transfer.svg') }}" class="drag-handle" alt="Move">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Pagination -->
                <div class="mt-3">
                    {{ $articles->links() }}
                </div>
            @else
                <p class="text-muted">No articles available in this category.</p>
            @endif




        </div>
    </div>
@endsection
