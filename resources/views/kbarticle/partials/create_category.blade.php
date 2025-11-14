@extends('layouts.app')

@section('content')
<style>
    .para {
        font-size: 15px !important;
    }
    .let_spc{
        letter-spacing: 0.4px !important;
    }.input-field{
        border: 1px solid #d1d9e0 !important;
    }
    .input-field[readonly]
    {
        background-color: #59636E1A;
        border: 1px solid #D1D9E0;
        pointer-events: none;
    }
    .tooltip-icon:hover i {
        color: #007bff; /* Bootstrap blue on hover */
        cursor: pointer;
    }
    label, .text-muted, .label {
        font-size: 15px !important;
    }
    main.flex-1.p-8.pb-48{
        padding-top : 0px !important;
        padding-left : 0px !important;
        padding-right : 0px !important;
    }
   .card.card-badge {
        border: 1px solid #7FBAFF;
        background-color: #F2F8FF;
    }
</style>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <x-alert type="error" :message="$errors->first()" />
    @endforeach
@endif
<div class="d-flex justify-content-between px-5 py-4 pb-0">
    <h4 class="fw-medium font-16">Add Board Category</h4>
    <div class="btn-wrapper d-flex align-items-center justify-content-center gap-2 flex-wrap mb-2">
        <a href="{{ route('board.index') }}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-flex align-items-center gap-2">
            <img src="{{ asset('assets/img/chevron-left.svg') }}" alt="Back" class="align-text-bottom">
            Back to Listing Page
        </a>
    </div>
</div>
<section class="section-content-center view-changelog main-content-wrapper pt-0">
            <div class="row">
                <div class="col-lg-12 view-changelog-details">
                    <div class="card p-0 bg-white mb-3">
                    <form action="{{ route('kbcategory.store') }}" method="POST" enctype="multipart/form-data" class="form">
                        @csrf
                        <div class="d-flex align-items-center border-title justify-content-between">
                            <h4 class="fw-medium mb-0">New Category</h4>
                             <div class="btn-wrapper mb-0 d-flex align-items-center justify-content-center gap15 flex-wrap">
                                <button class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block" type="button"
                                        onclick="window.location.reload();">Cancel</button>

                             </div>
                        </div>
                        <div class="mx-auto p-3">
                            <div class="card card-badge modal-note-card mb-2">
                                <p class="mb-0 fw-medium text-primary label">
                                    You can rename modules to match your business language. For example, change “Changelog” to “Announcements” or “Knowledge Board” to “Help Center.”
                                </p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-2 fw-medium">Category Banner</h6>
                                <h6 class="color-support fw-normal label">[Optional]</h6>
                            </div>

                            <div class="upload-input text-center">
                                        <input type="file" class="visually-hidden" id="category_img" name="category_img" accept="image/*" onchange="showPreview(event)">
                                        <label for="category_img" class="d-block text-center rounded-3">
                                        <span class="upload-btn d-inline-block rounded fw-semibold mb-2"><img src="{{ asset('assets/img/icon/upload.svg') }}" alt=""></span>
                                             <h6 class="fw-semibold">Drop files or browse</h6>
                                            <span class="upload-input-text d-block mb-3">Format: .jpeg, .png &amp; Max file size: 25 MB</span>
                                            <span class="theme-btn sm fw-semibold rounded ">Browse Files</span>
                                            <span id="file-name" class="d-block mt-2 fw-medium text-secondary"></span>
                                            <img id="preview-img"
                                                src=""
                                                alt="Preview"
                                                class="mt-2 mx-auto rounded shadow-sm d-none"
                                                width="100"
                                                height="100">
                                        </label>
                            </div>
                            <div class="basic-information mt-3">

                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <div class="">
                                            <label for="kboard" class="input-label mb-1 fw-medium">
                                                Select @customLabel('Knowledge Board')
                                            </label>
                                            <select class="form-select w-100 rounded text-sm border"
                                                    id="kboard"
                                                    name="kboard"
                                                    {{ isset($selectedBoard->id) ? 'disabled' : '' }}
                                                    required>
                                                <option value="">Select Board</option>
                                                @foreach($boards as $board)
                                                    <option value="{{ $board->id }}"
                                                        {{ (isset($selectedBoard->id) && $selectedBoard->id == $board->id) ? 'selected' : '' }}>
                                                        {{ $board->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @if(isset($selectedBoard->id))
                                                <input type="hidden" name="kboard" value="{{ $selectedBoard->id }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="">
                                            <label for="categoryName" class="input-label mb-1 fw-medium">
                                                Category Name

                                            </label>
                                            <input type="text" id="categoryName" name="categoryName"
                                                class="input-field w-100 rounded" placeholder="Placeholder" required>

                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <div class="">
                                            <label for="shortDesc" class="input-label mb-1 fw-medium">
                                                Category Description
                                            </label>
                                            <textarea rows="3" id="shortDesc" name="short_desc" maxlength="190" class="input-field w-100 rounded" placeholder="Placeholder"></textarea>
                                        </div>
                                    </div>
                                    @if($selectedBoard && $selectedBoard->categories->isNotEmpty())
                                        <div class="col-12 mb-3">
                                            <div class="">
                                                <label for="parentCategory" class="input-label mb-1 fw-medium">
                                                    Select Parent Category
                                                </label>
                                                <select class="input-field w-100 rounded border" id="parentCategory" name="parent_id">
                                                    <option value="">None</option>
                                                        @foreach($selectedBoard->categories as $category)
                                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    <div class="col-12 mb-3">
                                        <div class="">
                                            <label for="sub_category" class="input-label mb-1 fw-medium">
                                                Select Sub-Category

                                            </label>
                                            <select class="input-field w-100 rounded border" id="sub_category" name="sub_category_id">
                                                <option value="">None</option>
                                            </select>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-12 mb-3">
                                        <div>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="categoryVisibility" name="visibility">
                                                <label class="form-check-label" for="categoryVisibility" id="categoryVisibilityLabel">
                                                    Private (Hidden from structure)
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 mb-2">
                                        <div class="">
                                            <label for="status" class="input-label mb-1 fw-medium">
                                                Status of category
                                            </label>
                                            <select class="input-field w-100 rounded border" id="status" name="status" required>
                                                <option value="">Select</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                                <option value="draft">Draft</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>


                            </div>
                        </div>
                        <div class="card-footer gap15 px-3 bg-white d-flex justify-content-start">
                            <button type="submit" class="theme-btn sm fw-semibold rounded d-inline-block">Create</button>
                            <button type="button" class="theme-btn bg-white sm secondary fw-semibold rounded" onclick="window.location.reload();">Cancel</button>

                        </div>
                    </form>
                </div>
            </div>

        </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const parentCategorySelect = document.getElementById('parentCategory');
        const subCategorySelect = document.getElementById('sub_category');

        // Store all subcategories in a JS object for quick lookup
        // Format: { parentId: [ {id, name}, ... ] }
        const subCategories = {
            @foreach($selectedBoard->categories as $parent)
                @if($parent->children->isNotEmpty())
                {{ $parent->id }}: [
                    @foreach($parent->children as $child)
                { id: {{ $child->id }}, name: "{{ $child->name }}" },
                @endforeach
            ],
            @endif
            @endforeach
        };

        function filterSubCategories() {
            const parentId = parentCategorySelect.value;

            // Clear existing options
            subCategorySelect.innerHTML = '';

            // Always add "None" option
            const noneOption = document.createElement('option');
            noneOption.value = '';
            noneOption.textContent = 'None';
            subCategorySelect.appendChild(noneOption);

            if (!parentId || !subCategories[parentId]) return;

            // Add subcategories of the selected parent
            subCategories[parentId].forEach(sub => {
                const option = document.createElement('option');
                option.value = sub.id;
                option.textContent = sub.name;
                subCategorySelect.appendChild(option);
            });
        }

        // Run filter when parent category changes
        parentCategorySelect.addEventListener('change', filterSubCategories);

        // Optionally: run filter on page load if a parent category is preselected
        @if(old('parent_id') || isset($selectedBoard->categories))
        filterSubCategories();
        @endif
    });
</script>


@endsection
