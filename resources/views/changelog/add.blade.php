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
            <h4 class="fw-bold text-2xl">Add Changelog</h4>
            <p class="text-muted label mt-1 mb-3">
                Create a new changelog entry to keep your users informed about product updates, improvements, and fixes.
            </p>

            <!-- Form Section -->
            <form action="#" class="mb-3 form mx-auto">
                {{-- Feature Banner --}}
                <div class="card bg-white mb-3">
                    <div class="upload-input">
                        <input type="file" class="visually-hidden" id="feature-banner">
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
                                        <i class="fa fa-question-circle text-gray-400 hover:text-blue-500"></i>
                                    </span>
                                </label>
                                <input type="text" id="title" name="title" 
                                    class="input-field w-100 rounded" 
                                    placeholder="Enter changelog title">
                            </div>
                        </div>

                        {{-- Category --}}
                        <div class="col-12 mb-3">
                          <div class="">
                                <label for="categorySelect" class="input-label mb-1 fw-medium">
                                    Category
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" 
                                        title="Select one or more categories where this entry will apply (Changelog, Knowledge Board, Feedback, Research).">
                                        <i class="fa fa-question-circle"></i>
                                    </span>
                                </label>
                                <select class="form-select w-100 rounded" id="categorySelect" name="category[]" multiple>
                                    <option value="option1">cat 1</option>
                                    <option value="option2">cat 2</option>
                                    <option value="option3">cat 3</option>
                                </select>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="col-12">
                          <div class="">
                                <label for="desc" class="input-label mb-1 fw-medium">
                                    Description
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add description">
                                        <i class="fa fa-question-circle"></i>
                                    </span>
                                </label>
                                <textarea id="desc" name="description" rows="3" 
                                        class="input-field w-100 rounded" 
                                        placeholder="Enter changelog description"></textarea>
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
                        <div>
                            <input type="checkbox" class="visually-hidden" id="show-widget" disabled>
                            <label for="show-widget" class="d-flex align-items-center gap-2 rounded">
                                <span class="checkbox d-flex align-items-center justify-content-center rounded-1 text-white">
                                    <i class="fa-regular fa-check"></i>
                                </span>
                                Show from website &amp; widgets
                            </label>
                        </div>

                        <div>
                            <input type="checkbox" class="visually-hidden" id="send-email" disabled>
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
                            <span class="tooltip-icon text-gray-400 hover:text-blue-400 transition-colors duration-200" 
                                data-bs-toggle="tooltip" title="Select target subscriber">
                                <i class="fa fa-question-circle"></i>
                            </span>
                        </label>
                        <input type="text" id="targetSubscriber" class="input-field w-100 rounded" placeholder="Subscriber" readonly>
                    </div>
                </div>


           
                <div class="d-inline-block">
                    <a href="#" type="submit" class="theme-btn fw-bold rounded">Save &amp; Publish</a>
                    <a href="#" type="submit" class="theme-btn secondary fw-bold rounded">Save as Draft</a>
                    <a href="#" type="submit" class="theme-btn secondary fw-bold rounded">Schedule Publish</a>
                </div>
            </form>
        </div>
    </section>
@endsection
