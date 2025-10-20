@extends('layouts.app')

@section('content')
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <x-alert type="error" :message="$errors->first()" />
    @endforeach
@endif
<style>
    body {
        background-color: #f7f8fa; /* light grey background */
    }

    /* Container: limit width & left align */
    .section-content-center {
        max-width: 60%; /* half screen width */
        margin-left: 0; /* align to left */
        margin-right: auto;
    }

    /* Optional: add a little left padding for breathing space */
    .section-content-center .container {
        padding-left: 0px;
        padding-right: 0px;
    }

    /* Make form buttons stand out */
    .theme-btn {
        background-color: #2d63c8;
        color: white;
        padding: 10px 20px;
    }

    .theme-btn.secondary {
        background-color: #e9edf5;
        color: #333;
    }

</style>
    {{-- Changelog Section --}}
    <section class="section-content-center rounded border">
        <div class="container">
            <div class="d-flex align-items-center border-title justify-content-between border-bottom rounded p-2 bg-white">
                <h4 class="fw-semibold text-2xl px-3">Add @customLabel('Announcement')</h4>
                <div class="btn-wrapper mb-0 d-flex align-items-center justify-content-center flex-wrap px-3">
                    <a href="#" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Cancel</a>

                </div>
            </div>
            <!-- Form Section -->

            <form action="{{ route('announcement.store') }}" method="POST" enctype="multipart/form-data" class="mb-3 form mx-auto">
                @csrf
                {{-- Feature Banner --}}
                <div class="card bg-white border-0">
                    <div class="d-flex justify-content-between pb-2">
                        <h6 class="fw-semibold">Banner for your post</h6>
                        <h6 class="color-support fw-normal label">[Optional]</h6>
                    </div>

                    <div class="upload-input text-center position-relative">
                        <input
                            type="file"
                            class="visually-hidden"
                            id="feature-banner"
                            name="feature_banner"
                            onchange="showFileName(event)"
                            accept=".jpeg,.jpg,.png"
                        >
                        <label for="feature-banner" class="feature-banner">
                            <span class="upload-btn d-inline-block rounded fw-semibold mb-2">
                                <img src="{{ asset('assets/img/icon/upload.svg') }}" alt="Upload Icon" style="width: 40px;">
                            </span>

                            <h6 class="fw-semibold mb-1 text-dark">Drop files or browse</h6>
                            <span class="upload-input-text d-block mb-3 text-muted">
                                Format: .jpeg, .png &nbsp; | &nbsp; Max size: 25 MB
                            </span>
                                            <span class="theme-btn sm fw-semibold rounded px-4 py-2 bg-dark text-white">
                                Browse Files
                            </span>
                            <!-- Preview Image -->
                            <img id="file-preview" class="d-block mt-3 mx-auto rounded shadow-sm" style="max-width: 300px; display: none;" />
                            <!-- File Name -->
                            <div id="file-name" class="mt-2 text-center fw-medium text-muted"></div>
                        </label>
                    </div>
                </div>
                <div class="card bg-white border-0">
                    <div class="d-flex align-items-center border-title justify-content-between border-bottom pb-2">
                    <h6 class="fw-semibold mb-1 fs-5 text-gray-400">Basic Information</h6>
                        <span class="tooltip-icon " data-bs-toggle="tooltip" title="Help">
                                        <i class="fa fa-question-circle hover-blue"></i>
                                    </span>
                    </div>
                    <p class="label text-gray-800 mt-2 py-2 text-sm tracking-wide">
                        Provide the core details of your update, including the title, category, and description.
                        This information helps users understand what the @customLabel('Announcement') is about.
                    </p>

                    <div class="row">
                        {{-- Title --}}
                        <div class="col-12 mb-3">
                            <div class="">
                                <label for="title" class="input-label mb-1 fw-medium">
                                    Title
                                </label>
                                <input id="title" name="title"
                                    class="input-field w-100 rounded text-sm"
                                    placeholder="Placeholder" value="{{ old('title') }}" required>
                            </div>
                        </div>

                        {{-- Category --}}
                        <div class="col-12 mb-3">
                            <div>
                                <label for="categorySelect" class="input-label mb-1 fw-medium">
                                    @customLabel('Announcement') Category
                                </label>
                                <select class="form-select select2 w-100 rounded border text-sm pl-0 pt-0 pb-0" id="categorySelect" name="categorySelect[]" multiple>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ (collect(old('categorySelect'))->contains($category->id)) ? 'selected' : '' }}>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="col-12">
                          <div class="">
                                <label for="desc" class="input-label mb-1 fw-medium">
                                    Short Description
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add description">
                                        <i class="fa fa-question-circle hover-blue"></i>
                                    </span>
                                </label>
                                <textarea id="desc" name="description" rows="1"
                                        class="input-field w-100 rounded text-sm"
                                        placeholder="Note : Maximum of 200 Character"
                                maxlength="200">{{ old('description') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-white border-0 mb-0">
                    <div class="d-flex align-items-center border-title justify-content-between border-bottom pb-2">
                        <h6 class="fw-semibold mb-1 fs-5 text-gray-400">Visibility &amp; Notification</h6>
                        <span class="tooltip-icon " data-bs-toggle="tooltip" title="Help">
                                        <i class="fa fa-question-circle hover-blue"></i>
                                    </span>
                    </div>
                    <p class="label text-gray-800 mt-2 py-2 text-sm tracking-wide">
                        Decide where your update should appear and who should be notified. You can show it on your website/widget and send alerts to selected subscribers.
                    </p>
                    <!-- Checkboxes -->
                    <div class="d-flex flex-column gap-3 mb-3 pb-1 border-bottom-0">
                        <div class="text-sm border p-2 rounded">
                            <div class="form-check">
                                <!-- Hidden field for unchecked value -->
                                <input type="hidden" name="show_widget" value="0">

                                <!-- Actual checkbox -->
                                <input type="checkbox" id="show-widget" name="show_widget" value="1" class="form-check-input" {{ old('show_widget') == 1 ? 'checked' : '' }}>
                                <label for="show-widget" class="form-check-label">Show from website & widgets
                                </label>
                            </div>
                        </div>

                        <!-- <div class="text-sm border p-2 rounded">
                            <div class="form-check">
                                <input type="hidden" name="send_email" value="0">

                                <input type="checkbox" id="send-email" name="send_email" value="1" class="form-check-input">
                                    <label for="send-email" class="form-check-label">
                                        Send email to 450 subscriber
                                    </label>
                            </div>
                        </div> -->
                    </div>


                    <!-- Target Subscriber -->
                    <!-- <div>
                        <label for="targetSubscriber" class="input-label mb-1 fw-medium">
                            Select Target Subscriber
                            <span class="tooltip-icon  transition-colors duration-200"
                                data-bs-toggle="tooltip" title="Select target subscriber">
                                <i class="fa fa-question-circle hover-blue"></i>
                            </span>
                        </label>
                        <input id="targetSubscriber" name="targetSubscriber" class="input-field w-100 rounded text-sm" placeholder="Subscriber" readonly>
                    </div> -->
                </div>

                <!-- <div class="card bg-white mb-3">
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
                            <option value="active" {{ old('feedbackRequest') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('feedbackRequest') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="draft" {{ old('feedbackRequest') == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                        @error('feedbackRequest')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div> -->

                <div class="card bg-white border-0 pt-0">
                    <div class="d-flex align-items-center border-title justify-content-between border-bottom pb-2">
                        <h6 class="fw-semibold mb-1 fs-5 text-gray-400">Tags &amp; Publishing</h6>
                        <span class="tooltip-icon " data-bs-toggle="tooltip" title="Help">
                                        <i class="fa fa-question-circle hover-blue"></i>
                                    </span>
                    </div>
                    <p class="label text-gray-800 mt-2 py-2 text-sm tracking-wide pb-3">
                        Organize your update with tags, set its status, and choose a publish date.
                        This ensures updates are well-structured and go live at the right time.
                    </p>

                    <!-- Tags -->
                    <div class="col-12 mb-3">
                        <label for="tagsSelect" class="input-label mb-2 fw-medium flex items-center gap-2">
                            Tags
                        </label>
                        <select id="tagsSelect" name="tagsSelect[]" class="form-select select2 w-100 rounded border text-sm pl-0 pt-0 pb-0" multiple>
                            @foreach($tags as $id => $name)
                                <option value="{{ $id }}"
                                    {{ (collect(old('tagsSelect', []))->contains($id)) ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Publish Date -->
                    <div class="col-12 mb-3">
                        <div>
                            <label class="input-label mb-1 fw-medium">
                                Publish Date
                            </label>

                            <div class="position-relative form-group">
                                <input
                                    type="text"
                                    id="publishDate"
                                    name="publishDate"
                                    class="input-field rounded ps-5 w-100"
                                    placeholder="Select date and time"
                                    autocomplete="off"
                                    spellcheck="false"
                                    readonly
                                    value="{{ old('publishDate') }}"
                                >
                                <img src="{{ asset('assets/img/icon/calendar.svg') }}"
                                     class="position-absolute calendar-icon"
                                     style="top: 50%; left: 12px; transform: translateY(-50%); width: 20px;"
                                     alt="Calendar Icon">
                            </div>
                        </div>
                    </div>

                    <!-- Post Status -->
                    <div class="">
                        <label for="status" class="input-label mb-2 fw-medium flex items-center gap-2">
                            Post Status
                        </label>
                        <select id="status" name="status" class="form-select w-100 rounded border text-sm" required>
                            <option value="">Select</option>
                            <option value="active">Active</option>
                            <option value="inactive" >Inactive</option>
                            <option value="draft" >Draft</option>
                            <option value="schedule">Schedule</option>
                        </select>
                    </div>
                    <div class="d-inline-flex gap-2 mt-3">
                        <button type="submit" id="btnPublish" name="action" value="publish" class="theme-btn fw-semibold rounded">
                            Save &amp; Publish
                        </button>
                        <button type="submit" id="btnDraft" name="action" value="draft" class="theme-btn secondary fw-semibold rounded">
                            Save as Draft
                        </button>
                        <button type="submit" id="btnSchedule" name="action" value="schedule" class="theme-btn secondary fw-semibold rounded">
                            Schedule Publish
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        function showFileName(event) {
            const input = event.target;
            const fileName = input.files.length > 0 ? input.files[0].name : "";
            document.getElementById("file-name").textContent = fileName;

            // Preview image
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById("file-preview");
                    preview.src = e.target.result;
                    preview.style.display = "block";
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
