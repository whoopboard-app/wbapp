@extends('layouts.add_changelog')

@section('content')
@if ($errors->any())
    @foreach ($errors->all() as $error)
        <x-alert type="error" :message="$errors->first()" />
    @endforeach
@endif
<style>
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
    .ts-dropdown, .ts-control, .ts-control input {
        font-size: 14px !important;
    }

    .theme-btn {
        letter-spacing: 0.5px !important; 
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
<section class="section-content-center py-4">
        <div class="container">
            <h4 class="fw-bold text-2xl">Add New Article</h4>
            <p class="text-muted label mt-1 mb-3 p-text">
                Create an article for your Knowledge Board to share help guides, product documentation, or manuals. Add clear content so users can easily find the answers they need.
            </p>

            <form action="{{ route('kbarticle.store') }}" method="POST" enctype="multipart/form-data"       class="mb-3 form mx-auto">
                @csrf
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
                    <h6 class="fw-bold mb-2">Basic Information</h6>
                    <p class="label text-gray-800 mb-4 text-sm tracking-wide">
                        Provide the core details of your update, including the title, category, and description. This information helps users understand what the changelog is about.
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
                                        placeholder="Enter description"></textarea>
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
                </div>

                <div class="card bg-white mb-3">
                    <h6 class="fw-bold mb-2">Link to Changelog</h6>
                    <p class="label text-gray-800 mb-3 text-sm tracking-wide">
                        Connect this @customLabel('Announcement') to related feedback requests. This helps close the loop with users who suggested or voted on the idea.
                    </p>

                    <div>
                        <label for="link_changelog" class="input-label mb-1 fw-medium">
                            Link to Change log 
                            <span class="tooltip-icon  transition-colors duration-200"
                                data-bs-toggle="tooltip" title="Link to change log ">
                                <i class="fa fa-question-circle hover-blue"></i>
                            </span>
                        </label>
                        <select class="form-select w-100 rounded text-sm input-field" id="linkchangelog" name="link_changelog">
                            <option value="">Select</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="draft">Draft</option>
                        </select>
                        @error('link_changelog')
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

                    <div class="mb-3">
                        <label for="author" class="input-label mb-1 fw-medium">
                            Author  
                            <span class="tooltip-icon  transition-colors duration-200"
                                data-bs-toggle="tooltip" title="Add Author">
                                <i class="fa fa-question-circle hover-blue"></i>
                            </span>
                        </label>
                        <select class="form-select w-100 rounded text-sm" id="author" name="author[]" multiple>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="draft">Draft</option>
                        </select>
                        @error('author')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="text-sm border p-2 rounded mb-3">
                        <div class="form-check">
                            <!-- Hidden field for unchecked value -->
                            <input type="hidden" name="popular_article" value="0">

                            <!-- Actual checkbox -->
                            <input type="checkbox" id="popular_article" name="popular_article" value="1" class="form-check-input">
                            <label for="popular_article" class="form-check-label">Display as popular article
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="list_order" class="input-label mb-1 fw-medium">
                            Order of Listings
                            <span class="tooltip-icon  transition-colors duration-200"
                                data-bs-toggle="tooltip" title="Order of Listings">
                                <i class="fa fa-question-circle hover-blue"></i>
                            </span>
                        </label>
                        <select class="form-select w-100 rounded text-sm input-field" id="list_order" name="list_order">
                            <option value="">Select</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="draft">Draft</option>
                        </select>
                        @error('list_order')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

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

                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <div>
                                 <label for="other_article_category" class="input-label mb-2 fw-medium flex items-center gap-2">
                                    Other recommended articles category
                                    <span class="tooltip-icon  transition-colors duration-200"
                                        data-bs-toggle="tooltip" title="Other recommended articles category">
                                        <i class="fa fa-question-circle hover-blue"></i>
                                    </span>
                                </label>
                                <select id="other_article_category" name="other_article_category[]" class="form-select w-100 rounded text-sm" multiple>
                                    <option value="">Select</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="draft">Draft</option>
                                </select>
                                @error('other_article_category')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div>
                                 <label for="other_article_category2" class="input-label mb-2 fw-medium flex items-center gap-2">
                                    Other recommended articles category
                                    <span class="tooltip-icon  transition-colors duration-200"
                                        data-bs-toggle="tooltip" title="Other recommended articles category">
                                        <i class="fa fa-question-circle hover-blue"></i>
                                    </span>
                                </label>
                                <select id="other_article_category2" name="other_article_category2[]" class="form-select w-100 rounded text-sm" multiple>
                                    <option value="">Select</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="draft">Draft</option>
                                </select>
                                @error('other_article_category2')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="">
                        <label for="status" class="input-label mb-2 fw-medium flex items-center gap-2">
                            Article Status
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

                </div>
                <div class="d-inline-flex gap-2 ">
                    <button type="submit" id="btnPublish" name="action" value="publish" class="theme-btn fw-bold rounded">
                        Save &amp; Publish
                    </button>
                    <button type="submit" id="btnDraft" name="action" value="draft" class="theme-btn secondary fw-bold rounded">
                        Save as Draft
                    </button>
                </div>
            </form>
        </div>
</section>

<script>
    
    function showFileName(event) {
        const input = event.target;
        const fileName = input.files.length > 0 ? input.files[0].name : "";
        document.getElementById("file-name").textContent = fileName;
    }

</script>
@endsection