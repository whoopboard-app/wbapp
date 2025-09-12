@extends('layouts.add_changelog')

@section('content')
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <x-alert type="error" :message="$errors->first()" />
    @endforeach
@endif
<style>
    .hover-blue:hover {
        color: #0d6efd; /* Bootstrap primary blue */
        cursor: pointer;
    }
    .theme-btn{
        line-height: unset !important;
        font-size: 15px !important;
    }
    
    .ts-wrapper {
        padding: 0 !important;
        border: 1px solid #d1d9e0;
    }
    .ts-control {
        border: none !important; 
        
    }
    .form-select{
        border: 1px solid #d1d9e0;
    }
    .p-text {
        font-size: 17px !important;
    }
    @media (min-width:992px)
    {
    .section-content-center
      {
         max-width: 983px;
         margin: 0 auto;
      }
    }
</style>
    {{-- Changelog Section --}}
    <section class="section-content-center py-4">
        <div class="container">
            <h4 class="fw-bold text-3xl">Add @customLabel('Announcement')</h4>
            <p class="text-muted label mt-1 mb-3 p-text">
                Create a new @customLabel('Announcement') entry to keep your users informed about product updates, improvements, and fixes.
            </p>

            <!-- Form Section -->
            <form action="{{ route('changelog.store') }}" method="POST" enctype="multipart/form-data" class="mb-3 form mx-auto">
                @csrf
                {{-- Feature Banner --}}
                <div class="card bg-white mb-3">
                    <div class="upload-input">
                        <input type="file" class="visually-hidden" id="feature-banner" name="feature_banner" onchange="showFileName(event)">
                        <label for="feature-banner" class="d-block text-center rounded-3">
                            <span class="upload-btn widget-item-btn d-inline-block rounded fw-semibold mb-2">
                                Upload Features Banner
                            </span>
                            <span class="upload-input-text d-block">Recommended size 600 / 400</span>
                        </label>
                        <span id="file-name" class="d-block mt-2 text-muted"></span>
                    </div>
                </div>

                <div class="card bg-white mb-3 p-3 rounded">
                    <h6 class="fw-bold mb-2 fs-4">Basic Information</h6>
                    <p class="label text-gray-800 mb-4 text-sm tracking-wide">
                        Provide the core details of your update, including the title, category, and description. 
                        This information helps users understand what the @customLabel('Announcement') is about.
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
                                <input id="title" name="title" 
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
                                        title="Select one or more categories where this entry will apply (@customLabel('Announcement'), Knowledge Board, Feedback, Research).">
                                        <i class="fa fa-question-circle hover-blue"></i>
                                    </span>
                                </label>
                                
                                <select class="form-select w-100 rounded text-sm" id="categorySelect" name="category[]" multiple>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
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
                                        placeholder="Enter @customLabel('Announcement') description"></textarea>
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
                            <div class="form-check">
                                <!-- Hidden field for unchecked value -->
                                <input type="hidden" name="show_widget" value="0">

                                <!-- Actual checkbox -->
                                <input type="checkbox" id="show-widget" name="show_widget" value="1" class="form-check-input">
                                <label for="show-widget" class="form-check-label">Show from website & widgets
                                </label>
                            </div>
                        </div>

                        <div class="text-sm border p-2 rounded">
                            <input type="hidden" name="send_email" value="0">

                            <!-- Actual checkbox -->
                            <input type="checkbox" id="send-email" name="send_email" value="1" class="form-check-input">
                                <label for="send-email" class="form-check-label">
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
                        <input id="targetSubscriber" name="targetSubscriber" class="input-field w-100 rounded text-sm" placeholder="Subscriber" readonly>
                    </div>
                </div>

                <div class="card bg-white mb-3">
                    <h6 class="fw-bold mb-2">Link to Feedback</h6>
                    <p class="label text-gray-800 mb-3 text-sm tracking-wide">
                        Connect this @customLabel('Announcement') to related feedback requests. This helps close the loop with users who suggested or voted on the idea.
                    </p>

                    <div>
                        <label for="feedbackRequest" class="input-label mb-1 fw-medium">
                            Link to Feedback Request
                            <span class="tooltip-icon  transition-colors duration-200" 
                                data-bs-toggle="tooltip" title="Feedback request">
                                <i class="fa fa-question-circle hover-blue"></i>
                            </span>
                        </label>
                        <select class="form-select w-100 rounded text-sm input-field" id="feedbackRequest" name="feedbackRequest">
                            <option value="">Select</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="draft">Draft</option>
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
                        <select id="tagsSelect" name="tagsSelect[]" class="form-select w-100 rounded text-sm" multiple>
                            @foreach($tags as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
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
                    <button type="submit" name="action" value="publish" class="theme-btn fw-semibold rounded">
                        Save &amp; Publish
                    </button>
                    <button type="submit" name="action" value="draft" class="theme-btn secondary fw-semibold rounded">
                        Save as Draft
                    </button>
                    <button type="submit" name="action" value="schedule" class="theme-btn secondary fw-semibold rounded">
                        Schedule Publish
                    </button>
                </div>
            </form>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new TomSelect("#categorySelect", {
                plugins: ['remove_button'],
                create: false,
                placeholder: "Select Categories"
            });
        });
        function showFileName(event) {
            const input = event.target;
            const fileName = input.files.length > 0 ? input.files[0].name : "";
            document.getElementById("file-name").textContent = fileName;
        }
        
    </script>

@endsection
