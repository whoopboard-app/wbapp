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

    @if (session('info'))
        <x-alert type="info" :message="session('info')" />
    @endif

    @if (session('warning'))
        <x-alert type="warning" :message="session('warning')" />
    @endif

    <section class="section-content-center w-100 listing-changelog main-content-wrapper p-0">
        <div class="d-flex justify-content-between mb-3">
            <h4 class="fw-medium font-16">Manage Tags</h4>
            <div class="btn-wrapper d-flex align-items-center justify-content-center gap-2 flex-wrap">
                <a href="{{ route('app.settings') }}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-flex align-items-center gap-2">
                    <img src="{{ asset('assets/img/chevron-left.svg') }}" alt="Back" class="align-text-bottom">
                    Back to Listing Page
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 view-changelog-details">
                <!-- Add / Edit Tag Form -->
                <div class="card p-0 bg-white mb-3">
                    <form action="{{ isset($tag) ? route('tags.update', $tag) : route('tags.store') }}" method="POST" class="form">
                        @csrf
                        @if(isset($tag))
                            @method('PUT')
                        @endif

                        <div class="d-flex align-items-center border-title justify-content-between">
                            <h4 class="fw-medium mb-0">{{ isset($tag) ? 'Edit Tag' : 'Add New Tag' }}</h4>
                        </div>

                        <div class="content-body px-3">
                            <p class="label color-support fw-medium mt-2">
                                Create tags to organize content across modules — including Changelog, Knowledge Board, Feedback, and Research. Tags help users quickly find related items.
                            </p>

                            <div class="row">
                                <!-- Tag Name -->
                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="tag-name" class="input-label mb-1 fw-medium">Tag Name</label>
                                        <input type="text"
                                               id="tag-name"
                                               name="tag_name"
                                               value="{{ $tag->tag_name ?? old('tag_name') }}"
                                               class="input-field w-100 rounded"
                                               placeholder="Enter tag name"
                                               required>
                                        <p id="tag-error" class="text-danger text-sm mt-1 d-none">Tag name already exists.</p>
                                    </div>
                                </div>

                                <!-- Module Group -->
                                <div class="col-12">
                                    <div class="form-input">
                                        <label for="functionality_id" class="input-label mb-1 fw-medium">Module Group</label>
                                        <select id="functionality_id"
                                                name="functionality_id[]"
                                                class="form-select w-100 rounded border py-0"
                                                multiple
                                                required>
                                            @foreach($functionalities as $func)
                                                <option value="{{ $func->id }}"
                                                        @if(isset($tag) && $tag->functionalities && in_array($func->id, $tag->functionalities->pluck('id')->toArray())) selected @endif>
                                                    {{ $func->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Short Description -->
                                <div class="col-12 mb-3">
                                    <div class="form-input">
                                        <label for="short_description" class="input-label mb-1 fw-medium">Short Description</label>
                                        <textarea id="short_description"
                                                  name="short_description"
                                                  rows="2"
                                                  maxlength="200"
                                                  class="input-field w-100 rounded"
                                                  placeholder="Enter tag short description">{{ $tag->Short_description ?? old('short_description') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer gap15 px-3 d-flex justify-content-start" style="background-color: #FCFCFC;">
                            <button type="submit" class="theme-btn sm fw-semibold rounded d-inline-block" style="background-color: #0969da;">
                                {{ isset($tag) ? 'Update Tag' : 'Add Tag' }}
                            </button>
                            <a href="{{ route('guide.setup.changelog.tags') }}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Cancel</a>
                        </div>
                    </form>
                </div>

                <!-- Tags Table -->
                <div class="card pt-0 px-0 bg-white mt-3">
                    <div class="d-flex border-title align-items-center justify-content-between px-3">
                        <h4 class="fw-medium mb-0">List of Tags ({{ $tags->total() }})</h4>
                        <div class="btn-wrapper d-flex align-items-center justify-content-center gap15 flex-wrap mb-0">
                            <div class="position-relative form-group">
                                <img src="{{ asset('assets/img/icon/search.svg') }}" class="position-absolute search-icon" alt="Search">
                                <input type="search" name="search" id="tagSearch" placeholder="Search"
                                       value="{{ request('search') }}" class="input-field w-100 rounded ps-5">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="tagTable" class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>Tag Name</th>
                                <th>Module Group</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="tag-table-body">
                            @include('guide_setup.partials.tags_table', ['tags' => $tags])
                            </tbody>
                        </table>
                    </div>

                    <div class="px-3 py-2">
                        {{ $tags->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- JavaScript --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const tagInput = document.getElementById('tag-name');
            const errorMsg = document.getElementById('tag-error');

            tagInput.addEventListener('input', () => {
                const value = tagInput.value.trim();
                if (value.length === 0) {
                    errorMsg.classList.add('d-none');
                    return;
                }

                fetch(`{{ route('tags.checkName') }}?tag_name=${encodeURIComponent(value)}`)
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
