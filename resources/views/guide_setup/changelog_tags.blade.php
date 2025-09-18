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
    <main class="tag-setting">
        <section class="section-content-center">
            <div class="container mx-auto py-8">
                <div class="header bg-white w-3/5 mx-auto p-0 border-b-0">
                    <div class="flex items-center justify-between">
                        <!-- Header Text on Left -->
                        <h4 class="text-2xl md:text-2xl font-bold text-gray-900">
                            Add New Tag
                        </h4>
                    </div>

                    <p class="text-gray-500 text text-md mt-z my-2">
                        Create tags to organize content across modules — including Changelog, Knowledge Board, Feedback, and Research. Tags help users quickly find related items.
                    </p>
                </div>

                <!-- Form Section -->
                <div class="form-section card bg-white w-3/5 mx-auto">
                    <form action="{{ isset($tag) ? route('tags.update', $tag) : route('tags.store') }}" method="POST" class="space-y-4">
                        @csrf
                        @if(isset($tag))
                            @method('PUT')
                        @endif

                        <!-- Tag Name -->
                        <div>
                            <label for="tag-name" class="block text-md font-medium text-gray-700">
                                Tag Name
                                <span class="fa fa-question-circle hover-blue" data-bs-toggle="tooltip" title="Add Tag name">
                            </label>
                            <input
                                type="text"
                                id="tag-name"
                                name="tag_name"
                                value="{{ $tag->tag_name ?? old('tag_name') }}"
                                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Enter tag name"
                                required
                            >
                            <p id="tag-error" class="text-red-500 text-sm mt-1 hidden">Tag name already exists.</p>
                        </div>

                        <!-- Module Group -->
                        <div>
                            <label for="functionality_id" class="block text-md font-medium text-gray-700">
                                Module Group
                                <span class="fa fa-question-circle hover-blue" data-bs-toggle="tooltip" title="Add Module Group">
                            </label>
                            <select
                                id="functionality_id"
                                name="functionality_id[]"
                                placeholder="Select Module Group"
                                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required
                                multiple
                            >
                                @foreach($functionalities as $func)
                                    <option value="{{ $func->id }}"
                                            @if(isset($tag) && $tag->functionalities && in_array($func->id, $tag->functionalities->pluck('id')->toArray())) selected @endif>
                                        {{ $func->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>


                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-md font-medium text-gray-700">
                                Short Description
                                <span class="fa fa-question-circle hover-blue" data-bs-toggle="tooltip" title="Add Tag description">
                </span>
                            </label>
                            <textarea
                                id="short_description"
                                name="short_description"
                                value="{{ $tag->short_description ?? old('short_description') }}"
                                rows="3"
                                class="mt-1 block w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Enter Tag Short Description"
                                required
                            >{{ $tag->short_description ?? old('short_description') }}</textarea>
                        </div>

                        <!-- Submit -->
                        <div>
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold"
                                    style="background-color: #0969da;">
                                {{ isset($tag) ? 'Update tag' : 'Add Tag' }}
                            </button>
                            <!-- Cancel -->
                            <button type="reset"
                                    class="px-4 py-2 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-100 font-semibold">
                                Cancel
                            </button>
                        </div>

                    </form>
                </div>


                <!-- Table Section -->
                <div class="bg-white border rounded-lg p-6 mt-4 w-3/5 mx-auto">
                    <h6 class="text-lg font-semibold mb-4">List of Tags</h6>

                    <form method="GET" action="{{ route('guide.setup.changelog.tags') }}" class="relative mb-4">
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
                                <th class="px-4 py-2 text-left text-md font-bold text-black-600">Tag Name</th>
                                <th class="px-4 py-2 text-left text-md font-bold text-black-600">Module Group</th>
                                <th class="px-4 py-2 text-left text-md font-bold text-black-600">Action</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                            @if($tags->isEmpty())
                                <tr>
                                    <td colspan="4" class="px-4 py-4 text-center text-gray-500">
                                        No record found
                                    </td>
                                </tr>
                            @else
                            @foreach($tags as $tag)
                                <tr>
                                    <!-- Tag Name -->
                                    <td class="px-4 py-2 w-1/5 whitespace-normal">{{ $tag->tag_name }}</td>
                                    <!-- Module Group -->
                                    <td class="px-4 py-2">
                                        @if($tag->functionalities->count())
                                            @foreach($tag->functionalities as $func)
                                                <span class="inline-block bg-gray-100 text-gray-600 text-sm px-2 py-1 rounded mr-1 font-bold">
                                @customLabel($func->name)
                            </span>
                                            @endforeach
                                        @else
                                            <span class="text-gray-400 text-sm">No module assigned</span>
                                        @endif
                                    </td>

                                    <!-- Action -->
                                    <td class="px-4 py-2 text-left relative w-32">
                                        <div x-data="{ open: false }" class="inline-block relative">
                                            <!-- Three dots button -->
                                            <button @click="open = !open"
                                                    class="p-2 rounded-full hover:bg-gray-100 focus:outline-none font-bold">
                                                &#x2026;
                                            </button>

                                            <!-- Dropdown (slides in from LEFT side) -->
                                            <div x-show="open"
                                                 @click.away="open = false"
                                                 x-transition:enter="transition ease-out duration-200"
                                                 x-transition:enter-start="opacity-0 -translate-x-2"
                                                 x-transition:enter-end="opacity-100 translate-x-0"
                                                 x-transition:leave="transition ease-in duration-150"
                                                 x-transition:leave-start="opacity-100 translate-x-0"
                                                 x-transition:leave-end="opacity-0 -translate-x-2"
                                                 class="absolute left-0 top-1/2 -translate-y-1/2 mr-2 w-24 bg-white border border-gray-200 rounded-lg z-10">

                                                <a href="{{ route('tags.edit', $tag->id) }}"
                                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                    Edit
                                                </a>
                                                <form action="{{ route('tags.destroy', $tag->id) }}" method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this Tag ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>

                        <!-- Pagination links -->
                        <div class="mt-4">
                            {{ $tags->links('pagination::tailwind') }}
                        </div>
                    </div>
                </div>


            </div>
        </section>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const tagInput = document.getElementById('tag-name');
            const errorMsg = document.getElementById('tag-error');

            tagInput.addEventListener('input', () => {
                const value = tagInput.value.trim();
                if (value.length === 0) {
                    errorMsg.classList.add('hidden');
                    return;
                }

                fetch(`{{ route('tags.checkName') }}?tag_name=${encodeURIComponent(value)}`)
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
