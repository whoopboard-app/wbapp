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
                        <a href="#" class="text-primary">List of Categories</a>
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
                <div id="boardsContainer">
                    @include('kbarticle.partials.board_list', ['boards' => collect([$board])])
                </div>
                <div class="btn-wrapper d-flex align-items-center gap-2 flex-wrap mb-4">
                    <a href="javascript:void(0);"
                       class="theme-btn sm fw-semibold rounded d-inline-block"
                       data-bs-toggle="modal" data-bs-target="#createBoardCategoryModal">
                        <i class="fa fa-plus"></i> Add @customLabel('Knowledge Board') Categories
                    </a>
                    <a href="{{ route('kbarticle.create') }}"
                       class="theme-btn sm secondary fw-semibold rounded d-inline-block">
                        <i class="fa fa-plus"></i> Add Article
                    </a>

                    <a href="javascript:void(0);"
                       class="theme-btn sm secondary fw-semibold rounded d-inline-block"
                       data-bs-toggle="modal" data-bs-target="#createBoardModal">
                        <i class="fa fa-plus"></i> Quick Report
                    </a>
                </div>
                <p class="text-muted pb-4">Arrange help center categories, sections and articles.</p>
                @if($board->categories)
                    @foreach($board->categories->where('parent_id', null) as $category)
                        @include('kbarticle.partials.category_tree', ['category' => $category, 'level' => 0])
                    @endforeach
            @else
                    <p class="text-muted">No categories available for this board.</p>
                @endif

            </div>
    </div>
    @include('kbarticle.partials.create_boardcategory_model', ['board' => $board])
@endsection
