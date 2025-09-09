<div class="modal fade" id="customizeTheme" tabindex="-1" aria-labelledby="customizeThemeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-3">
            <div class="modal-header">
                <h5 class="text-2xl md:text-2xl font-bold text-gray-900" id="customizeThemeLabel">Customize Your Theme</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('themes.customize') }}">
                @csrf
                <div class="modal-body mt-2">
                    <p class="form-para mb-4 mt-4">
                        Set up your theme with the right details. Update your page title, description, welcome message, and rename modules to match your business needs.
                    </p>
                    <div class="form-input border-0">
                        <label for="page-title" class="input-label mb-1 fw-medium">Page Title</label>
                        <input type="text" id="page-title" name="page_title"
                               class="input-field w-100 rounded"
                               placeholder="Placeholder"
                               value="{{ old('page_title', $usertheme->page_title ?? '') }}">
                    </div>

                    <div class="form-input border-0">
                        <label for="welcome" class="input-label mb-1 fw-medium">Welcome Message</label>
                        <input type="text" id="welcome" name="welcome_message"
                               class="input-field w-100 rounded"
                               placeholder="Placeholder"
                               value="{{ old('welcome_message', $usertheme->welcome_message ?? '') }}">
                    </div>

                    <div class="form-input border-0">
                        <label for="description" class="input-label mb-1 fw-medium">Short Description</label>
                        <input type="text" id="description" name="short_description"
                               class="input-field w-100 rounded"
                               placeholder="Placeholder"
                               value="{{ old('short_description', $usertheme->short_description ?? '') }}">
                    </div>


                    <div class="card card-badge">
                        <p class="mb-0 text-primary label">
                            You can rename modules to match your business language. For example, change “Changelog” to “Announcements” or “Knowledge Board” to “Help Center.”
                        </p>
                    </div>

                    {{-- Loop for modules --}}
                    @foreach($functionalities as $functionality)
                        <div class="form-section row align-items-center mb-3">
                            <div class="col-md-5">
                                <label class="input-label mb-1 fw-medium">Module Label</label>
                                <input type="text" class="input-field w-100 rounded"
                                       value="{{ $functionality->name }}" readonly>
                            </div>
                            <div class="col-md-2 text-center arrow">→</div>
                            <div class="col-md-5">
                                <label class="input-label mb-1 fw-medium d-flex justify-content-between">
                                    <span>Update label name</span>
                                    <span class="optional-label">* Optional</span>
                                </label>
                                <input type="text" name="module_labels[{{ $functionality->name }}]"
                                       class="input-field w-100 rounded"
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
