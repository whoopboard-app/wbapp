<div class="modal fade" id="customizeThemeModal_{{ $userTheme->id }}" tabindex="-1" aria-labelledby="customizeThemeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-width modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content rounded-3">
            <div class="modal-header">
                <h5 class="text-2xl md:text-2xl font-bold text-gray-900" id="customizeThemeLabel">Customize Your Theme</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('themes.customize') }}">
                @csrf
                <div class="modal-body mt-2 mb-4">
                    <p class="form-para">
                        Set up your theme with the right details. Update your page title, description, welcome message, and rename modules to match your business needs.
                    </p>
                    <div class="form-input border-0 p-0 mb-4 mt-2">
                        <label for="page-title" class="input-label mb-1 fw-medium">Page Title</label>
                        <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add Theme Title">
                        <i class="fa fa-question-circle hover-blue"></i>
                    </span>
                        <input type="text" id="page-title" name="theme_title"
                               class="input-field w-100 rounded border"
                               placeholder="Placeholder"
                               required
                               value="{{ old('theme_title', $userTheme->theme_title ?? '') }}">
                    </div>
                    <div class="form-input border-0 p-0 mb-4">
                        <label for="meta_title" class="input-label mb-1 fw-medium">Meta Title</label>
                        <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add meta_title">
                        <i class="fa fa-question-circle hover-blue"></i>
                        </span>
                        <input type="text" id="meta_title" name="meta_title"
                               class="input-field w-100 rounded border"
                               placeholder="Placeholder"
                               value="{{ old('meta_title', $userTheme->meta_title ?? '') }}">
                    </div>
                    <div class="form-input border-0 p-0 mb-4">
                        <label for="meta_description" class="input-label mb-1 fw-medium">Meta Description</label>
                        <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add meta_description">
                        <i class="fa fa-question-circle hover-blue"></i>
                        </span>
                        <input type="text" id="meta_description" name="meta_description"
                               class="input-field w-100 rounded border"
                               placeholder="Placeholder"
                               value="{{ old('meta_description', $userTheme->meta_description ?? '') }}">
                    </div>
                    <div class="form-input border-0 p-0 mb-4">
                        <label for="meta_keywords" class="input-label mb-1 fw-medium">Meta Keywords</label>
                        <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add meta_keywords">
                        <i class="fa fa-question-circle hover-blue"></i>
                        </span>
                        <input type="text" id="meta_keywords" name="meta_keywords"
                               class="input-field w-100 rounded border"
                               placeholder="Placeholder"
                               value="{{ old('meta_keywords', $userTheme->meta_keywords ?? '') }}">
                    </div>
                    <div class="form-input border-0 p-0 mb-4">
                        <label for="google_analytics" class="input-label mb-1 fw-medium">Google Analytics</label>
                        <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add google_analytics">
                        <i class="fa fa-question-circle hover-blue"></i>
                        </span>
                        <input type="text" id="google_analytics" name="google_analytics"
                               class="input-field w-100 rounded border"
                               placeholder="Placeholder"
                               value="{{ old('google_analytics', $userTheme->google_analytics ?? '') }}">
                    </div>
                    <div class="form-input border-0 p-0 mb-4">
                        <label for="alignment" class="input-label mb-1 fw-medium">Alignment</label>
                        <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add Alignment">
                        <i class="fa fa-question-circle hover-blue"></i>
                        </span>
                        @php
                            $alignment = old('alignment', $usertheme->alignment ?? 'left');
                            if (!in_array($alignment, ['left', 'center', 'right'])) {
                                $alignment = 'left';
                            }
                        @endphp
                        <select id="alignment" name="alignment" class="input-field w-100 rounded border">
                            <option value="left" {{ $alignment === 'left' ? 'selected' : '' }}>Left</option>
                            <option value="center" {{ $alignment === 'center' ? 'selected' : '' }}>Center</option>
                            <option value="right" {{ $alignment === 'right' ? 'selected' : '' }}>Right</option>
                        </select>
                    </div>
                    <div class="form-input border-0 p-0 mb-4">
                        <label for="welcome" class="input-label mb-1 fw-medium">Welcome Message</label>
                        <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add Welcome Message">
                        <i class="fa fa-question-circle hover-blue"></i>
                        </span>
                        <input type="text" id="welcome" name="welcome_message"
                               class="input-field w-100 rounded border"
                               placeholder="Placeholder"
                               maxlength="191"
                               required
                               value="{{ old('welcome_message', $userTheme->welcome_message ?? '') }}">
                    </div>

                    <div class="form-input border-0 p-0 mb-4">
                        <label for="description" class="input-label mb-1 fw-medium">Short Description</label>
                        <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add Short Description">
                        <i class="fa fa-question-circle hover-blue"></i>
                        </span>
                        <input type="text" id="description" name="short_description"
                               class="input-field w-100 rounded border"
                               placeholder="Placeholder"
                               required
                               value="{{ old('short_description', $userTheme->short_description ?? '') }}">
                    </div>
                    <div class="form-input border-0 p-0 mb-4">
                        <label for="theme_flag" class="input-label mb-1 fw-medium">Status</label>
                        <span class="tooltip-icon" data-bs-toggle="tooltip" title="Set status as Active or Inactive">
                            <i class="fa fa-question-circle hover-blue"></i>
                        </span>
                        @php
                            $status = old('theme_flag', $userTheme->theme_flag ?? 0);
                        @endphp
                        <select id="theme_flag" name="theme_flag" class="input-field w-100 rounded border">
                            <option value="0" {{ $status == 0 ? 'selected' : '' }}>Inactive</option>
                            <option value="1" {{ $status == 1 ? 'selected' : '' }}>Active</option>
                        </select>
                    </div>
                    <div class="card bg-white mb-3">
                        <div class="upload-input">
                            <input type="file" class="visually-hidden" id="feature-banner" name="feature_banner" onchange="showFileName(event)">
                            <label for="feature-banner" class="d-block text-center rounded-3">
                            <span class="upload-btn widget-item-btn d-inline-block rounded fw-semibold mb-2">
                                Upload Logo
                            </span>
                                <span class="upload-input-text d-block">Recommended size 600 / 400</span>
                            </label>
                            <span id="file-name" class="d-block mt-2 text-muted"></span>
                        </div>
                    </div>
                    <div class="card card-badge">
                        <p class="mb-0 text-primary label">
                            You can rename modules to match your business language.<br> For example, change “Changelog” to “Announcements” or “Knowledge Board” to “Help Center.”
                        </p>
                    </div>
                    <br>
                    {{-- Loop for modules --}}
                    @foreach($functionalities as $functionality)
                        <div class="form-section row align-items-center mb-3">
                            <div class="col-md-5">
                                <label class="input-label mb-1 fw-medium">Module Label</label>
                                <input type="text" class="input-field w-100 rounded border bg-dark-subtle"
                                       value="{{ $functionality->name }}" readonly>
                            </div>
                            <div class="col-md-2 text-center arrow" style="font-size: 25px;">→</div>
                            <div class="col-md-5">
                                <label class="input-label mb-1 fw-medium d-flex justify-content-between">
                                    <span>Update label name</span>
                                    <span class="optional-label text-muted">Optional</span>
                                </label>
                                <input type="text" name="module_labels[{{ $functionality->name }}]"
                                       class="input-field w-100 rounded border"
                                       placeholder="Placeholder"
                                       value="{{ old('module_labels.'.$functionality->name, $labels[$functionality->name] ?? '') }}">
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-semibold">Save Theme</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script>
    function showFileName(event) {
        const input = event.target;
        const fileName = input.files.length > 0 ? input.files[0].name : "";
        document.getElementById("file-name").textContent = fileName;
    }
</script>
