@extends('layouts.app')

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
        align-content: center !important;
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
    label, .text-muted, .label {
        font-size: 15px !important;
    }
    main.flex-1.p-8.pb-48{
        padding-top : 0px !important;
        padding-left : 0px !important;
        padding-right : 0px !important;
    }
    .theme-btn {
        letter-spacing: 0.5px !important;
    }




   
</style>
<section class="section-content-center view-changelog main-content-wrapper">
            <div class="row">
                <div class="col-lg-12 view-changelog-details">
                    <div class="card p-0 bg-white mb-3">
                    <form action="{{ route('kbarticle.store') }}" method="POST" enctype="multipart/form-data" class="form">
                        @csrf
                        <div class="d-flex align-items-center border-title justify-content-between">
                            <h4 class="fw-medium mb-0">New Article</h4>
                             <div class="btn-wrapper mb-0 d-flex align-items-center justify-content-center gap15 flex-wrap">
                                <button class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block" type="button" 
                                        onclick="window.location.reload();">Cancel</button>
                                 
                             </div>
                        </div>
                        <div class="mx-auto p-3">
                            <p class="label color-support mb-4">
                                Create an article for your Knowledge Board to share help guides, product documentation, or manuals. Add clear content so users can easily find the answers they need.
                            </p>
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-2 fw-medium">Article Banner</h6>
                                <h6 class="color-support fw-normal label">[Optional]</h6>
                            </div>

                            <div class="upload-input text-center">
                                        <input type="file" class="visually-hidden" id="article_banner" name="article_banner" accept="image/*" onchange="showPreview(event)">
                                        <label for="article_banner" class="d-block text-center rounded-3">
                                        <span class="upload-btn d-inline-block rounded fw-semibold mb-2"><img src="{{ asset('assets/img/icon/upload.svg') }}" alt=""></span>
                                             <h6 class="fw-semibold">Drop files or browse</h6>
                                            <span class="upload-input-text d-block mb-3">Format: .jpeg, .png &amp; Max file size: 25 MB</span>
                                            <span class="theme-btn sm fw-semibold rounded ">Browse Files</span>
                                            <span id="file-name" class="d-block mt-2 fw-medium text-secondary"></span>
                                            <img id="preview-img"
                                                src=""
                                                alt="Preview"
                                                class="mt-2 mx-auto rounded shadow-sm d-none"
                                                width="100"
                                                height="100">
                                        </label>
                            </div>
                            <div class="basic-information mt-3">
                                <div class="d-flex justify-content-between px-0 border-title">
                                    <h6 class="text-gray fw-medium">Basic Information</h6>
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="Help" data-bs-original-title="Help">
                                        <a href="#"><img src="{{ asset('assets/img/icon/help.svg') }}" alt=""></a>
                                        
                                    </span>
                                </div>
                                <p class="label my-3">
                                    Provide the core details of your update, including the title, category, and description. This information helps users understand what the changelog is about.
                                 </p>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <div class="">
                                            <label for="kboard" class="input-label mb-1 fw-medium">
                                               Select Knowledge Board
                                            </label>
                                            <select class="form-select w-100 rounded text-sm" id="kboard" name="kboard" required>
                                                <option value="">Select Board</option>
                                                @foreach($boards as $board)
                                                    <option value="{{ $board->id }}">{{ $board->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                   <div class="col-12 mb-3">
                                        <div class="">
                                            <label for="title" class="input-label mb-1 fw-medium">
                                                Article Title
                                            </label>
                                            <input id="title" name="title"
                                                class="input-field w-100 rounded text-sm"
                                                placeholder="Placeholder" required>
                                        </div>
                                    </div>
                                   <div class="col-12 mb-3">
                                        <div class="">
                                            <label for="category_id" class="input-label mb-1 fw-medium">
                                                Select Category
                                            </label>
                                            <select class="form-select w-100 rounded text-sm" id="category_id" name="category_id" required >
                                                <option value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }} (Board: {{ $category->board->name ?? 'N/A' }})
                                                    </option>
                                                @endforeach
                                            </select>
                                                
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <div class="">
                                            <label for="other_article_category" class="input-label mb-1 fw-medium">
                                                Select Sub-Category
                                                
                                            </label>
                                            <select class="input-field w-100 rounded border" id="other_article_category" name="other_article_category">
                                                <option value="">None</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 mb-2">
                                        <div class="">
                                            <label for="description" class="input-label mb-1 fw-medium">
                                                Article Description
                                            </label>
                                            <textarea rows="3" id="description" name="description" maxlength="190" class="input-field w-100 rounded" placeholder="Placeholder"></textarea>
                                          
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="basic-information mt-3">
                                <div class="d-flex justify-content-between px-0 border-title">
                                    <h6 class="text-gray fw-medium">Visibility & Notification</h6>
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="Help" data-bs-original-title="Help">
                                        <a href="#"><img src="{{ asset('assets/img/icon/help.svg') }}" alt=""></a>
                                        
                                    </span>
                                </div>
                                <p class="label my-3">
                                    Provide the core details of your update, including the title, category, and description. This information helps users understand what the changelog is about.
                                 </p>
                                <div class="form-condition-container border-bottom-0 mb-0 pb-0">
                                    <div class="d-flex flex-column gap-3 mb-3 pb-1">
                                        <div class="form-input form-condition">
                                            <input type="hidden" name="show_widget" value="0">
                                            <span class="label">Show from website &amp; widgets</span>
                                            <input type="checkbox" class="visually-hidden" id="show-widget" name="show_widget" value="1" checked>
                                            <label for="show-widget" class="d-flex align-items-center gap-2 rounded">
                                                <span class="checkbox d-flex align-items-center justify-content-center rounded-1 text-white"><i class="fa-regular fa-check"></i></span> Yes </label>
                                        </div>
                                        
                                    
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="basic-information mt-3">
                                <div class="d-flex justify-content-between px-0 border-title">
                                    <h6 class="text-gray fw-medium">Link to Changelog</h6>
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="Help" data-bs-original-title="Help">
                                        <a href="#"><img src="{{ asset('assets/img/icon/help.svg') }}" alt=""></a>
                                        
                                    </span>
                                </div>
                                <p class="label my-3">
                                   Connect this changelog to related feedback requests. This helps close the loop with users who suggested or voted on the idea.
                                 </p>
                                 <div class="row">
                                    <div class="col-12 mb-2">
                                        <label for="link_changelog" class="input-label mb-1 fw-medium">
                                            Link to Change log
                                            
                                        </label>
                                        <select class="form-select w-100 rounded text-sm input-field" id="linkchangelog" name="link_changelog[]" multiple>
                                            <option value="">Select</option>
                                            <option value="1">Premium health</option>
                                            <option value="2">General</option>
                                          
                                        </select>
                                    </div>
                                 </div>
                            </div>
                            <div class="basic-information mt-3">
                                <div class="d-flex justify-content-between px-0 border-title">
                                    <h6 class="text-gray fw-medium">Tags & Publishing</h6>
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="Help" data-bs-original-title="Help">
                                        <a href="#"><img src="{{ asset('assets/img/icon/help.svg') }}" alt=""></a>
                                        
                                    </span>
                                </div>
                                <p class="label my-3">
                                   Organize your update with tags, set its status, and choose a publish date. This ensures updates are well-structured and go live at the right time.
                                </p>
                                <div class="form-condition-container border-bottom-0 mb-0 pb-0">
                                    <div class="d-flex flex-column gap-3 mb-3 pb-1">
                                        <div class="form-input form-condition">
                                            <input type="hidden" name="popular_article" value="0">
                                            <span class="label">Tag to Popular category articles</span>
                                            <input type="checkbox" class="visually-hidden" id="popular_article" name="popular_article" value="1" checked>
                                            <label for="popular_article" class="d-flex align-items-center gap-2 rounded">
                                                <span class="checkbox d-flex align-items-center justify-content-center rounded-1 text-white"><i class="fa-regular fa-check"></i></span> Display are popular article </label>
                                        </div>
                                        
                                    
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label for="author" class="input-label mb-1 fw-medium">
                                            Author for this article
                                            
                                        </label>
                                        <select class="form-select w-100 rounded text-sm" id="author" name="author[]" multiple required>
                                            <option value="">Select</option>
                                            @foreach($authors as $author)
                                                <option value="{{ $author->id }}">
                                                    {{ $author->name }} ({{ $author->email }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label for="tagsSelect" class="input-label mb-2 fw-medium flex items-center gap-2">
                                            Tags
                                        </label>
                                        <select id="tagsSelect" name="tagsSelect[]" class="form-select w-100 rounded text-sm" multiple required>
                                            <option value="">Select</option>
                                            @foreach($tags as $id => $name)
                                                <option value="{{ $id }}">{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="basic-information mt-3">
                                <div class="d-flex justify-content-between px-0 border-title">
                                    <h6 class="text-gray fw-medium">Recommendation Articles</h6>
                                    <span class="tooltip-icon" data-bs-toggle="tooltip" aria-label="Help" data-bs-original-title="Help">
                                        <a href="#"><img src="{{ asset('assets/img/icon/help.svg') }}" alt=""></a>
                                    </span>
                                </div>

                                <p class="label fw-medium my-3">
                                   Mapping some recommended articles
                                </p>
                                <div class="card bg-white" style="border: 1px solid #969695;">
                                    <div class="row">
                                        <div class="col-lg-12 col-12">
                                        <div class="">
                                            <label for="recName" class="input-label mb-1 fw-medium">Name</label>
                                            <input id="recName" type="text" name="recName" placeholder="Name" class="input-field rounded w-100">
                                            
                                        </div>
                                        </div>
                                        <div class="col-lg-12 col-12 mt-3">
                                            <div class="">
                                                <label for="recDateTime" class="input-label mb-1 fw-medium">Select Date</label>
                                                <div class=" position-relative form-group">
                                                    <input id="recDateTime" type="text" name="recDateTime" class="input-field rounded ps-5 w-100" placeholder="Select Date">
                                                <img src="{{ asset('assets/img/icon/calendar.svg') }}" class="position-absolute search-icon" alt="">
                                            </div>
                                        </div>
                                        </div>
                                        <div class="mt-3">
                                            <a href="#" class="theme-btn text-primary bg-white sm secondary fw-semibold rounded d-inline-block">
                                                Add Organization
                                            </a>
                        
                                        </div>
                                        <div class="mt-3 faqs d-flex flex-wrap gap-3">
                                           
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 mb-2 mt-3">
                                <div class="">
                                    <label for="status" class="input-label mb-1 fw-medium">
                                        Status of article
                                    </label>
                                    <select class="input-field w-100 rounded border" id="status" name="status" required>
                                        <option value="">Select</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="draft">Draft</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer gap15 px-3 bg-white d-flex justify-content-start">
                            <button type="submit" class="theme-btn sm fw-semibold rounded d-inline-block">Create</button>
                            <button type="button" class="theme-btn bg-white sm secondary fw-semibold rounded" onclick="window.location.reload();">Cancel</button>
                            
                        </div>
                    </form>
                </div>
            </div>
           
        </div>
</section>

<script>
    function showPreview(event) {
        const input = event.target;
        const file = input.files[0];
        const fileName = file ? file.name : "";
        document.getElementById('file-name').textContent = fileName;

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImg = document.getElementById('preview-img');
                previewImg.src = e.target.result;
                previewImg.classList.remove('d-none'); // nayi file select hui to image dikhao
            };
            reader.readAsDataURL(file);
        }
    }
    document.querySelector('form').addEventListener('submit', function(e){
        e.preventDefault();
    });
    
</script>

@endsection
