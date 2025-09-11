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
                        <label for="page-title" class="input-label mb-1 fw-medium">Theme Title</label>
                        <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add Theme Title">
                        <i class="fa fa-question-circle"></i>
                    </span>
                        <input type="text" id="page-title" name="theme_title"
                               class="input-field w-100 rounded border"
                               placeholder="Placeholder"
                               required
                               value="{{ old('theme_title', $userTheme->theme_title ?? '') }}">
                    </div>
                    <div class="form-input border-0 p-0 mb-4">
                        <label for="welcome" class="input-label mb-1 fw-medium">Welcome Message</label>
                        <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add Welcome Message">
                        <i class="fa fa-question-circle"></i>
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
                        <i class="fa fa-question-circle"></i>
                        </span>
                        <input type="text" id="description" name="short_description"
                               class="input-field w-100 rounded border"
                               placeholder="Placeholder"
                               required
                               value="{{ old('short_description', $userTheme->short_description ?? '') }}">
                    </div>
                    <input type="hidden" name="theme_flag" value="1">
                    <div class="form-input border-0 p-0 mb-4">
                        <label for="alignment" class="input-label mb-1 fw-medium">Alignment</label>
                        <span class="tooltip-icon" data-bs-toggle="tooltip" title="Add Alignment">
                        <i class="fa fa-question-circle"></i>
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
