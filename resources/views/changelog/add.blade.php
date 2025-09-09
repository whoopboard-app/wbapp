@extends('layouts.add_changelog')

@section('content')
    {{-- Flash Messages --}}
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

    {{-- Changelog Section --}}
    <section class="section-content-center py-4">
        <div class="container">
            <h4 class="fw-bold text-2xl">Add @label('Changelog')</h4>
            <p class="text-muted label mt-1 mb-3">
                Create a new changelog entry to keep your users informed about product updates, improvements, and fixes.
            </p>

            <!-- Form Section -->
            <form action="{{ route('changelog.store') }}" method="POST" enctype="multipart/form-data" class="mb-3 form mx-auto">
                @csrf
                {{-- Feature Banner --}}
                <div class="card bg-white mb-3">
                    <div class="upload-input">
                        <input type="file" class="visually-hidden" id="feature-banner" name="feature_banner">
                        <label for="feature-banner" class="d-block text-center rounded-3">
                            <span class="upload-btn widget-item-btn d-inline-block rounded fw-semibold mb-2">
                                Upload Features Banner
                            </span>
                            <span class="upload-input-text d-block">Recommended size 600 / 400</span>
                        </label>
                    </div>
                </div>

                <div class="card bg-white mb-3 p-3 rounded">
                    <h6 class="fw-bold mb-2">Basic Information</h6>
                    <p class="label text-gray-800 mb-4 text-sm tracking-wide">
                        Provide the core details of your update, including the title, category, and description. 
                        This information helps users understand what the changelog is about.
                    </p>

                    <div class="row">
                        {{-- Title --}}
                        <div class="col-12 mb-3">
                            <div class="">
                                <label for="title" class="input-label mb-1 fw-medium">
                                    Title
                                    <span class="tooltip-icon " data-bs-toggle="tooltip" title="Add title">
                                        <i class="fa fa-question-circle hover-blue"></i>
                                    </span>
                                </label>
                                <input type="text" id="title" name="title" 
                                    class="input-field w-100 rounded text-sm" 
                                    placeholder="Placeholder" >
                                @error('title')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Category --}}
                        <div class="col-12 mb-3">
                          <div class="">
                                <label for="categorySelect" class="input-label mb-1 fw-medium">
                                    Category
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" 
                                        title="Select one or more categories where this entry will apply (Changelog, Knowledge Board, Feedback, Research).">
                                        <i class="fa fa-question-circle hover-blue"></i>
                                    </span>
                                </label>
                                <select class="form-select w-100 rounded text-sm" id="categorySelect" name="category[]" multiple>
                                    <option value="1">cat 1</option>
                                    <option value="2">cat 2</option>
                                    <option value="3">cat 3</option>
                                </select>
                                @error('category')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="col-12">
                          <div class="">
                                <label for="desc" class="input-label mb-1 fw-medium">
                                    Description
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add description">
                                        <i class="fa fa-question-circle hover-blue"></i>
                                    </span>
                                </label>
                                <textarea id="desc" name="description" rows="3" 
                                        class="input-field w-100 rounded text-sm" 
                                        placeholder="Enter changelog description"></textarea>
                                @error('description')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-white mb-3">
                    <h6 class="fw-bold mb-2">Visibility &amp; Notification</h6>
                    <p class="label text-gray-800 mb-4 text-sm tracking-wide">
                        Decide where your update should appear and who should be notified. You can show it on your website/widget and send alerts to selected subscribers.
                    </p>

                    <!-- Checkboxes -->
                    <div class="d-flex flex-column gap-3 mb-3 pb-1 border-bottom-0">
                        <div class="text-sm border p-2 rounded">
                            <input type="checkbox" class="visually-hidden" id="show-widget" name="show_widget">
                            <label for="show-widget" class="d-flex align-items-center gap-2 rounded">
                                <span class="checkbox d-flex align-items-center justify-content-center rounded-1 text-white">
                                    <i class="fa-regular fa-check"></i>
                                </span>
                                Show from website &amp; widgets
                            </label>
                        </div>

                        <div class="text-sm border p-2 rounded">
                            <input type="checkbox" class="visually-hidden" id="send-email" name="send_email" disabled>
                            <label for="send-email" class="d-flex align-items-center gap-2 rounded">
                                <span class="checkbox d-flex align-items-center justify-content-center rounded-1 text-white">
                                    <i class="fa-regular fa-check"></i>
                                </span>
                                Send email to 450 subscriber
                            </label>
                        </div>
                    </div>

                    <!-- Target Subscriber -->
                    <div>
                        <label for="targetSubscriber" class="input-label mb-1 fw-medium">
                            Select Target Subscriber
                            <span class="tooltip-icon  transition-colors duration-200" 
                                data-bs-toggle="tooltip" title="Select target subscriber">
                                <i class="fa fa-question-circle hover-blue"></i>
                            </span>
                        </label>
                        <input type="text" id="targetSubscriber" name="targetSubscriber" class="input-field w-100 rounded text-sm" placeholder="Subscriber" readonly>
                    </div>
                </div>

                <div class="card bg-white mb-3">
                    <h6 class="fw-bold mb-2">Link to Feedback</h6>
                    <p class="label text-gray-800 mb-3 text-sm tracking-wide">
                        Connect this changelog to related feedback requests. This helps close the loop with users who suggested or voted on the idea.
                    </p>

                    <div>
                        <label for="feedbackRequest" class="input-label mb-1 fw-medium">
                            Link to Feedback Request
                            <span class="tooltip-icon  transition-colors duration-200" 
                                data-bs-toggle="tooltip" title="Feedback request">
                                <i class="fa fa-question-circle hover-blue"></i>
                            </span>
                        </label>
                        <select class="form-select w-100 rounded text-sm" id="feedbackRequest" name="feedbackRequest">
                            <option value="">Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        @error('feedbackRequest')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="card bg-white mb-3">
                    <!-- Title -->
                    <h6 class="fw-bold mb-2 text-lg">Tags &amp; Publishing</h6>

                    <!-- Description -->
                    <p class="label text-gray-800 mb-3 text-sm tracking-wide leading-relaxed">
                        Organize your update with tags, set its status, and choose a publish date. 
                        This ensures updates are well-structured and go live at the right time.
                    </p>

                    <!-- Tags -->
                    <div class="mb-3">
                        <label for="tagsSelect" class="input-label mb-2 fw-medium flex items-center gap-2">
                            Tags
                            <span class="tooltip-icon  transition-colors duration-200" 
                                data-bs-toggle="tooltip" title="Tags">
                                <i class="fa fa-question-circle hover-blue"></i>
                            </span>
                        </label>
                        <select id="tags" name="tagsSelect[]" class="form-select w-100 rounded text-sm" multiple>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                        @error('tagsSelect')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Post Status -->
                    <div class="mb-3">
                        <label for="status" class="input-label mb-2 fw-medium flex items-center gap-2">
                            Post Status
                            <span class="tooltip-icon  transition-colors duration-200" 
                                data-bs-toggle="tooltip" title="Post Status">
                                <i class="fa fa-question-circle hover-blue"></i>
                            </span>
                        </label>
                        <select id="status" name="status" class="form-select w-100 rounded text-sm">
                            <option value="">Select</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="draft">Draft</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Publish Date -->
                    <div class="">
                        <label for="publishDate" class="input-label mb-2 fw-medium flex items-center gap-2">
                            Publish Date
                            <span class="tooltip-icon  transition-colors duration-200" 
                                data-bs-toggle="tooltip" title="Publish date">
                                <i class="fa fa-question-circle hover-blue"></i>
                            </span>
                        </label>
                        <input type="date" id="publishDate" name="publishDate" 
                            class="input-field w-100 rounded border-gray-300 focus:border-blue-400 focus:ring focus:ring-blue-100 transition text-sm"
                            value="{{ date('Y-m-d') }}" readonly>
                    </div>
                </div>



           
                <div class="d-inline-flex gap-2 mt-3">
                    <button type="submit" name="action" value="publish" class="theme-btn fw-bold rounded">
                        Save &amp; Publish
                    </button>
                    <button type="submit" name="action" value="draft" class="theme-btn secondary fw-bold rounded">
                        Save as Draft
                    </button>
                    <button type="submit" name="action" value="schedule" class="theme-btn secondary fw-bold rounded">
                        Schedule Publish
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
