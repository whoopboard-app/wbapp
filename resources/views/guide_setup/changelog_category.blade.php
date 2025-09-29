@extends('layouts.navbar-cross')

@section('content')
        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        @if (session('error'))
            <x-alert type="error" :message="session('error')" />
        @endif

        @if (session('info'))
            <x-alert type="info" :message="session('info')" />
        @endif

        @if (session('warning'))
            <x-alert type="warning" :message="session('warning')" />
        @endif
    <main class="category-setting">
        <section class="section-content-center">
            <div class="container mx-auto py-8">
                <div class="header bg-white w-3/5 mx-auto p-0 border-b-0">
                    <div class="flex items-center justify-between">
                        <!-- Header Text on Left -->
                        <h4 class="text-2xl md:text-2xl font-bold text-gray-900">
                            Manage Changelog Categories
                        </h4>
                    </div>
                <p class="text-gray-600 text mt-z my-2">
                    Create and organize categories to group your product updates. Categories make it easier for users to browse updates by topic or type.
                </p>
                </div>

                <!-- Form Section -->
                <div class="form-section card bg-white w-3/5 mx-auto">
                    <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST" class="space-y-4">
                        @csrf
                        @if(isset($category))
                            @method('PUT')
                        @endif
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Category Name -->
                            <div>
                                <label for="category-name" class="block text-md font-medium text-gray-700">
                                    Category Name
                                    <span class="fa fa-question-circle hover-blue" data-bs-toggle="tooltip" title="Add category name">
                </span>
                                </label>
                                <input
                                    type="text"
                                    id="category-name"
                                    name="category_name"
                                    value="{{ $category->category_name ?? old('category_name') }}"
                                    class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Enter category name"
                                    required
                                >
                                <p id="category-error" class="text-red-500 text-sm mt-1 hidden">Category name already exists.</p>
                            </div>

                            <!-- Brand Color -->
                            <div>
                                <label for="brand-color" class="block text-md font-medium text-gray-700">
                                    Brand Color
                                </label>
                                <div class="relative flex items-center">
                                    <!-- Circle color picker -->
                                    <input
                                        type="color"
                                        id="brand-color"
                                        class="absolute left-3 w-6 h-6 rounded-full border-0 cursor-pointer p-0 appearance-none"
                                        value="{{ $category->color_hex ?? old('color_hex', '#00FF00') }}"
                                        onchange="document.getElementById('color_hex').value = this.value"
                                        title="Select a color code"
                                    >

                                    <!-- Text field -->
                                    <input
                                        type="text"
                                        id="color_hex"
                                        name="color_hex"
                                        value="{{ $category->color_hex ?? old('color_hex', '#00FF00') }}"
                                        class="w-full rounded-md border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 pl-12 pr-3 py-2 text-base"
                                        onchange="document.getElementById('brand-color').value = this.value"
                                        title="Select a color code"
                                    >
                                </div>

                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-md font-medium text-gray-700">
                                Select Status
                                <span class="tooltip-icon" data-bs-toggle="tooltip" title="Choose category status">
                <i class="fa fa-question-circle hover-blue"></i>
            </span>
                            </label>
                            <select
                                id="status"
                                name="status"
                                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-gray-400 focus:ring-0"
                                required
                            >
                                <option value="" disabled selected>Select Status</option>
                                <option value="1" {{ (isset($category) && $category->status == 1) ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ (isset($category) && $category->status == 0) ? 'selected' : '' }}>Inactive</option>
                                <option value="2" {{ (isset($category) && $category->status == 2) ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>

                        <!-- Submit -->
                        <div>
                            <button type="submit"
                                    class="px-4 py-2 text-white rounded-lg hover:opacity-90 font-semibold"
                                    style="background-color: #0969da;">
                                {{ isset($category) ? 'Update Category' : 'Add Category' }}
                            </button>
                            <!-- Cancel -->
                            <button type="reset"
                                    class="px-4 py-2 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 font-semibold">
                                Cancel
                            </button>
                        </div>
                </div>
            </form>
            </div>
            <!-- Table Section -->
            <div class="bg-white border rounded-lg p-6 mt-4 w-3/5 mx-auto">
                <h6 class="text-lg font-semibold mb-4">List of Categories</h6>

                <form method="GET" action="{{ route('guide.setup.changelog.category') }}" class="relative mb-4">
                    <input type="search" name="search" placeholder="Search"
                           value="{{ request('search') }}"
                           class="w-full rounded-lg border-gray-300 pl-10 focus:border-indigo-500 focus:ring-indigo-500">
                    <svg class="w-5 h-5 absolute left-3 top-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                    </svg>
                </form>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border rounded-lg">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-md font-bold text-black-600">Category Name</th>
                            <th class="px-4 py-2 text-left text-md font-bold text-black-600">Color Code</th>
                            <th class="px-4 py-2 text-left text-md font-bold text-black-600">Status</th>
                            <th class="px-4 py-2 text-left text-md font-bold text-black-600">Action</th>
                        </tr>
                        </thead>
                        <tbody id="tag-table-body" class="divide-y divide-gray-100">
                        @include('guide_setup.partials.logcategory_table', ['categories' => $categories])
                        </tbody>
                    </table>
                    {{-- Pagination --}}
                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>


            </div>
        </section>
    </main>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const categoryInput = document.getElementById('category-name');
                const errorMsg = document.getElementById('category-error');

                categoryInput.addEventListener('input', () => {
                    const value = categoryInput.value.trim();
                    if (value.length === 0) {
                        errorMsg.classList.add('hidden');
                        return;
                    }

                    fetch(`{{ route('categories.checkName') }}?category_name=${encodeURIComponent(value)}`)
                        .then(res => res.json())
                        .then(data => {
                            if (data.exists) {
                                errorMsg.classList.remove('hidden');
                            } else {
                                errorMsg.classList.add('hidden');
                            }
                        });
                });
            });
        </script>
@endsection
