<div class="modal fade" id="analyticsSettings_{{ $theme->id }}" tabindex="-1" aria-labelledby="analyticsSettingsLabel" aria-hidden="true">    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            {{-- Header --}}
            <div class="modal-header">
                <h5 class="modal-title" id="analyticSettingsLabel">Analytics Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- Hidden theme ID --}}
            <input type="hidden" name="theme_id" value="{{ $theme->id }}">

            {{-- Body --}}
            <div class="modal-body overflow-auto" style="max-height: 70vh;">

                {{-- Meta Title --}}
                <div class="form-input border-0 p-0 mb-4 mt-2">
                    <label for="meta-title" class="input-label mb-1 fw-medium">Meta Title</label>
                    <input type="text" id="meta-title" name="meta_title"
                           class="input-field w-100 rounded border"
                           placeholder="Enter meta title"
                           value="{{ old('meta_title', $userTheme->meta_title ?? '') }}">
                </div>

                {{-- Meta Keyword --}}
                <div class="form-input border-0 p-0 mb-4">
                    <label for="meta-keywords" class="input-label mb-1 fw-medium">Meta Keyword</label>
                    <input type="text" id="meta-keywords" name="meta_keywords"
                           class="input-field w-100 rounded border"
                           placeholder="Enter meta keywords"
                           value="{{ old('meta_keywords', $userTheme->meta_keywords ?? '') }}">
                </div>

                {{-- Meta Description --}}
                <div class="form-input border-0 p-0 mb-4">
                    <label for="meta-description" class="input-label mb-1 fw-medium">Meta Description</label>
                    <input type="text" id="meta-description" name="meta_description"
                           class="input-field w-100 rounded border"
                           placeholder="Enter meta description"
                           value="{{ old('meta_description', $userTheme->meta_description ?? '') }}">
                </div>

                {{-- Google Code --}}
                <div class="form-input border-0 p-0 mb-4">
                    <label for="google-code" class="input-label mb-1 fw-medium">Google Code</label>
                    <input type="text" id="google-code" name="google_analytics"
                           class="input-field w-100 rounded border"
                           placeholder="Enter Google Analytics code"
                           value="{{ old('google_analytics', $userTheme->google_analytics ?? '') }}">
                </div>

                {{-- Optional info card --}}
                <div class="card card-badge">
                    <p class="mb-0 text-primary label">
                        You can add meta details and tracking code to improve SEO and monitor site performance using Google Analytics.
                    </p>
                </div>

            </div>

            {{-- Footer --}}
            <div class="modal-footer justify-content-start border-top-0">
                <button type="button" class="theme-btn fw-semibold rounded border-0" data-bs-dismiss="modal">Save & Continue</button>
                <button type="button" class="theme-btn secondary bg-white fw-semibold rounded" data-bs-dismiss="modal">Cancel</button>
                <a href="{{ route('themes.index') }}" class="theme-btn secondary fw-semibold rounded">Back to Themes</a>
            </div>

        </div>
    </div>
</div>
