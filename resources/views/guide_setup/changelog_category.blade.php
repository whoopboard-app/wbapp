@extends('layouts.app')

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-alert type="error" :message="$error" />
        @endforeach
    @endif

    @if (session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

    @if (session('error'))
        <x-alert type="error" :message="session('error')" />
    @endif

    <section class="section-content-center w-100 listing-changelog main-content-wrapper p-0">
        <div class="d-flex justify-content-between mb-2">
            <h4 class="fw-medium font-16">Manage Changelog Categories</h4>
            <div class="btn-wrapper d-flex align-items-center justify-content-center gap-2 flex-wrap mb-2">
                <a href="{{ route('app.settings') }}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-flex align-items-center gap-2">
                    <img src="{{ asset('assets/img/chevron-left.svg') }}" alt="Back" class="align-text-bottom">
                    Back to App Settings
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 view-changelog-details">
                <!-- Add / Edit Category -->
                <div class="card p-0 bg-white mb-3">
                    <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST" class="form">
                        @csrf
                        @if(isset($category))
                            @method('PUT')
                        @endif

                        <div class="d-flex align-items-center border-title justify-content-between">
                            <h4 class="fw-medium mb-0">{{ isset($category) ? 'Edit Category' : 'Add New Category' }}</h4>
                        </div>

                        <div class="content-body px-3">
                            <p class="label color-support fw-medium mt-2">
                                Create and organize categories to group your product updates. Categories make it easier for users to browse updates by topic or type.
                            </p>

                            <div class="row">
                                <!-- Category Name -->
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-input">
                                        <label for="category-name" class="input-label mb-1 fw-medium">
                                            Category Name
                                        </label>
                                        <input type="text" id="category-name" name="category_name"
                                               value="{{ $category->category_name ?? old('category_name') }}"
                                               class="input-field w-100 rounded"
                                               placeholder="Enter category name"
                                               required>
                                        <p id="category-error" class="text-danger text-sm mt-1 d-none">Category name already exists.</p>
                                    </div>
                                </div>

                                <!-- Brand Color -->
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-input">
                                        <label for="brand-color" class="input-label mb-1 fw-medium">Brand Color</label>
                                        <div class="d-flex align-items-center gap-2 border rounded px-2">
                                            <input type="color" id="brand-color"
                                                   class="form-control-color p-0 border-0 rounded-circle"
                                                   style="width: 30px; height: 30px; cursor: pointer;"
                                                   value="{{ $category->color_hex ?? old('color_hex', '#00FF00') }}"
                                                   onchange="document.getElementById('color_hex').value = this.value">
                                            <input type="text" id="color_hex" name="color_hex"
                                                   value="{{ $category->color_hex ?? old('color_hex', '#00FF00') }}"
                                                   class="border-0 bg-transparent w-100"
                                                   style="outline: none; box-shadow: none;"
                                                   onchange="document.getElementById('brand-color').value = this.value">
                                        </div>
                                    </div>
                                </div>


                                <!-- Status -->
                                <div class="col-12 col-lg-6 mb-3">
                                    <div class="form-input">
                                        <label for="status" class="input-label mb-1 fw-medium">
                                            Select Status
                                        </label>
                                        <select id="status" name="status" class="input-field w-100 rounded" required>
                                            <option value="" disabled {{ !isset($category) ? 'selected' : '' }}>Select Status</option>
                                            <option value="1" {{ (isset($category) && $category->status == 1) ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ (isset($category) && $category->status == 0) ? 'selected' : '' }}>Inactive</option>
                                            <option value="2" {{ (isset($category) && $category->status == 2) ? 'selected' : '' }}>Draft</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer gap15 px-3 d-flex justify-content-start" style="background-color: #FCFCFC;">
                            <button type="submit" class="theme-btn sm fw-semibold rounded d-inline-block" style="background-color: #0969da;">
                                {{ isset($category) ? 'Update Category' : 'Add Category' }}
                            </button>
                            <a href="{{ route('guide.setup.changelog.category') }}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Cancel</a>
                        </div>
                    </form>
                </div>

                <!-- Category Table -->
                <div class="card pt-0 px-0 bg-white mt-3">
                    <div class="d-flex border-title align-items-center justify-content-between px-3">
                        <h4 class="fw-medium mb-0">List of Categories ({{ $categories->total() }})</h4>
                        <div class="btn-wrapper d-flex align-items-center justify-content-center gap15 flex-wrap mb-0">
                            <div class="position-relative form-group">
                                <img src="{{ asset('assets/img/icon/search.svg') }}" class="position-absolute search-icon" alt="Search">
                                <input type="search" name="search" id="categorySearch" placeholder="Search"
                                       value="{{ request('search') }}" class="input-field w-100 rounded ps-5">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="categoryTable" class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>Status</th>
                                <th>Category Name</th>
                                <th>Color Code</th>
                                <th class="w-25">Action</th>
                            </tr>
                            </thead>
                            <tbody id="tag-table-body">
                            @include('guide_setup.partials.logcategory_table', ['categories' => $categories])
                            </tbody>
                        </table>
                    </div>

                    <div class="px-3 py-2">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- JavaScript --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const categoryInput = document.getElementById('category-name');
            const errorMsg = document.getElementById('category-error');

            categoryInput.addEventListener('input', () => {
                const value = categoryInput.value.trim();
                if (value.length === 0) {
                    errorMsg.classList.add('d-none');
                    return;
                }

                fetch(`{{ route('categories.checkName') }}?category_name=${encodeURIComponent(value)}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.exists) {
                            errorMsg.classList.remove('d-none');
                        } else {
                            errorMsg.classList.add('d-none');
                        }
                    });
            });
        });
    </script>
@endsection
