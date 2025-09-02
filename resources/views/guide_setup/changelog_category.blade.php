@extends('layouts.navbar-layout')

@section('content')
    <main class="category-setting">
        <section class="section-content-center">
            <div class="container mx-auto py-8">
                <div class="header bg-white w-3/5 mx-auto p-0">
                    <h4 class="text-2xl md:text-2xl font-bold text-gray-900">
                        Manage Changelog Categories
                    </h4>
                <p class="text-gray-500 text-md mt-z my-2">
                    Create and organize categories to group your product updates. Categories make it easier for users to browse updates by topic or type.
                </p>
                </div>

                <!-- Form Section -->
                <div class="form-section card bg-white w-3/5 mx-auto">
                    <form action="{{ route('categories.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Category Name -->
                            <div>
                                <label for="category-name" class="block text-md font-medium text-gray-700">
                                    Category Name
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add category name">
                    <i class="fa fa-question-circle"></i>
                </span>
                                </label>
                                <input
                                    type="text"
                                    id="category-name"
                                    name="category_name"
                                    class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Enter category name"
                                    required
                                >
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
                                        value="#f44336"
                                        onchange="document.getElementById('color_hex').value = this.value"
                                    >

                                    <!-- Text field -->
                                    <input
                                        type="text"
                                        id="color_hex"
                                        name="color_hex"
                                        class="w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 pl-12 pr-3 py-2 text-base"
                                        value="#f44336"
                                        onchange="document.getElementById('brand-color').value = this.value"
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-md font-medium text-gray-700">
                                Select Status
                                <span class="tooltip-icon" data-bs-toggle="tooltip" title="Choose category status">
                <i class="fa fa-question-circle"></i>
            </span>
                            </label>
                            <select
                                id="status"
                                name="status"
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required
                            >
                                <option value="">Select</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                                <option value="0">Draft</option>
                            </select>
                        </div>

                        <!-- Submit -->
                        <div>
                            <button
                                type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700"
                            >
                                Add Category
                            </button>
                        </div>
                    </form>

                </div>

                <!-- Table Section -->
                <div class="bg-white shadow rounded-lg p-6 mt-8 w-3/5 mx-auto">
                    <h6 class="text-lg font-semibold mb-4">Categories ({{ $categories->count() }})</h6>

                    <div class="relative mb-4">
                        <input type="search" placeholder="Search"
                               class="w-full rounded-lg border-gray-300 pl-10 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <svg class="w-5 h-5 absolute left-3 top-3 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1110.5 3a7.5 7.5 0 016.15 13.65z" />
                        </svg>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 border rounded-lg">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Category Name</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Color Code</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Status</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Action</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                            @foreach($categories as $category)
                                <tr>
                                    <td class="px-4 py-2">{{ $category->category_name }}</td>
                                    <td class="px-4 py-2 flex items-center space-x-2">
                                        <span class="inline-block w-3 h-3 rounded-full" style="background: {{ $category->color_hex }};"></span>
                                        <span>{{ $category->color_hex }}</span>
                                    </td>
                                    <td class="px-4 py-2">
                                        @php
                                            $statusClasses = [
                                                2 => 'bg-gray-200 text-gray-700',    // Inactive
                                                1 => 'bg-green-100 text-green-700',  // Active
                                                0 => 'bg-yellow-100 text-yellow-700' // Draft
                                            ];
                                            $statusLabels = [
                                                2 => 'Inactive',
                                                1 => 'Active',
                                                0 => 'Draft'
                                            ];
                                        @endphp
                                        <span class="px-2 py-1 text-xs font-medium rounded {{ $statusClasses[$category->status] ?? 'bg-gray-200 text-gray-700' }}">
                            {{ $statusLabels[$category->status] ?? 'Unknown' }}
                        </span>
                                    </td>
                                    <td class="px-4 py-2">
                                        <button class="text-indigo-600 hover:underline">Edit</button> |
                                        <button class="text-red-600 hover:underline">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </section>
    </main>
@endsection
