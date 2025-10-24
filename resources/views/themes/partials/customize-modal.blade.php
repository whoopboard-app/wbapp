<div class="modal fade" id="themeSettings_{{ $theme->id }}" tabindex="-1" aria-labelledby="themeSettingsLabel_{{ $theme->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header">
                <div class="mb-0">
                    <h3 class="fw-semibold mb-0">Theme Settings</h3>
                </div>
                <button type="button" class="modal-close bg-transparent border-0 ms-auto d-flex align-items-center justify-content-center"
                        data-bs-dismiss="modal" aria-label="Close">
                    <img src="{{ asset('assets/img/icon/modal-exit.svg') }}" alt="Close">
                </button>
            </div>

            {{-- ⚠️ No <form> tag here --}}
            <div class="modal-body overflow-auto" style="max-height: 70vh;">
                <input type="hidden" name="theme_id" value="{{ $theme->id }}">

                <!-- Brand Color -->
                <div class="col-12 col-lg-12 mb-3">
                    <div class="form-input px-0">
                        <label for="brand-color" class="input-label mb-1 fw-medium">Brand Color</label>
                        <div class="d-flex align-items-center gap-2 border rounded px-2">
                            <input type="color" id="brand-color"
                                   class="form-control-color p-0 border-0 rounded-circle"
                                   style="width: 30px; height: 30px; cursor: pointer;"
                                   value="{{ $theme->brand_color ?? old('color_hex', '#00FF00') }}"
                                   onchange="document.getElementById('color_hex').value = this.value">
                            <input type="text" id="color_hex" name="color_hex"
                                   value="{{ $theme->brand_color ?? old('color_hex', '#00FF00') }}"
                                   class="border-0 bg-transparent w-100"
                                   style="outline: none; box-shadow: none;"
                                   onchange="document.getElementById('brand-color').value = this.value">
                        </div>
                    </div>
                </div>

                <!-- Website Visibility -->
                <div class="mb-3 card bg-white p-3">
                    <label class="form-label fw-bold">Website Visibility</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input"
                               type="checkbox"
                               id="visibility_{{ $theme->id }}"
                               name="is_visible"
                            {{ old('is_visible', $theme->is_visible ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="visibility_{{ $theme->id }}">
                            On (Published — Your board is live and accessible at [subdomain])
                        </label>
                    </div>
                </div>

                <!-- Password Protection -->
                <div class="mb-3 card bg-white p-3">
                    <label class="form-label fw-bold">Password Protected</label>
                    <div class="form-check form-switch">
                        <input class="form-check-input"
                               type="checkbox"
                               id="password_toggle_{{ $theme->id }}"
                               name="is_password_protected"
                            {{ old('is_password_protected', $theme->is_password_protected ?? false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="password_toggle_{{ $theme->id }}">
                            Off (Disabled — Anyone can access your board based on its visibility setting.)
                        </label>
                    </div>

                    <div id="passwordAlert_{{ $theme->id }}"
                         class="{{ old('is_password_protected', $theme->is_password_protected ?? false) ? '' : 'd-none' }}">
                        <input type="password"
                               name="board_password"
                               class="input-field w-100 mt-2 rounded border"
                               placeholder="Enter board password"
                               value="{{ old('board_password', $theme->board_password ?? '') }}">
                    </div>
                </div>

                <!-- Upload Logo -->
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6>Upload Logo</h6>
                        <h6 class="color-support fw-normal label">[Optional]</h6>
                    </div>

                    <div class="upload-input">
                        <input type="hidden" name="existing_feature_banner" value="{{ $theme->feature_banner ?? '' }}">
                        <input type="file" class="visually-hidden" id="feature-banner-{{ $theme->id }}" name="feature_banner"
                               onchange="showFileName('{{ $theme->id }}', event)">
                        <label for="feature-banner-{{ $theme->id }}" class="d-block text-center rounded-3">
                            <span class="upload-btn d-inline-block rounded fw-semibold mb-2">
                                <img src="{{ asset('assets/img/icon/upload.svg') }}" alt="Upload">
                            </span>
                            <h6 class="fw-semibold">Drop files or browse</h6>
                            <span class="upload-input-text d-block mb-3">Format: .jpeg, .png &amp; Max file size: 25 MB</span>
                            <span class="theme-btn sm fw-semibold rounded">Browse Files</span>
                            <div id="file-name-{{ $theme->id }}" class="file-name mt-2 text-center fw-medium text-muted">
                                {{ $theme->feature_banner ? basename($theme->feature_banner) : '' }}
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Footer (no submit here) -->
            <div class="modal-footer justify-content-start border-top-0">
                <button type="button" class="theme-btn fw-semibold rounded border-0" data-bs-dismiss="modal">Continue</button>
                <button type="canel" class="theme-btn secondary fw-semibold rounded" data-bs-dismiss="modal">Cancel</button>
                <a href="{{ route('themes.index') }}" class="theme-btn secondary fw-semibold rounded">Back to Themes</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const visibilityToggles = document.querySelectorAll("[id^='visibility_']");
        const passwordToggles = document.querySelectorAll("[id^='password_toggle_']");

        function togglePasswordField(id) {
            const visibility = document.getElementById(`visibility_${id}`);
            const passwordToggle = document.getElementById(`password_toggle_${id}`);
            const alertBox = document.getElementById(`passwordAlert_${id}`);

            // ✅ Get their own labels
            const visibilityLabel = document.querySelector(`label[for='visibility_${id}']`);
            const passwordLabel = document.querySelector(`label[for='password_toggle_${id}']`);

            // 🟢 Update visibility label
            if (visibility) {
                if (visibility.checked) {
                    visibilityLabel.textContent = "On (Published — Your board is live and accessible at [subdomain]).";
                } else {
                    visibilityLabel.textContent = "Off — Your board is not visible to anyone.";
                }
            }

            // 🟢 Update password protection label
            if (passwordToggle) {
                if (passwordToggle.checked) {
                    passwordLabel.textContent = "Enabled — Visitors must enter a password to access your board.";
                } else {
                    passwordLabel.textContent = "Disabled — Anyone can access your board based on its visibility setting.";
                }
            }

            // 🟢 Toggle password input field
            if (visibility.checked && passwordToggle.checked) {
                alertBox.classList.remove("d-none");
            } else {
                alertBox.classList.add("d-none");
            }
        }

        // 🔄 Attach events
        visibilityToggles.forEach(el => {
            const id = el.id.split("_").pop();
            el.addEventListener("change", () => togglePasswordField(id));
        });

        passwordToggles.forEach(el => {
            const id = el.id.split("_").pop();
            el.addEventListener("change", () => togglePasswordField(id));
        });

        // 🧠 Run once to set correct initial text + states
        visibilityToggles.forEach(el => {
            const id = el.id.split("_").pop();
            togglePasswordField(id);
        });
    });

    // 🧾 File name helper
    function showFileName(id, event) {
        const fileName = event.target.files.length ? event.target.files[0].name : '';
        document.getElementById(`file-name-${id}`).textContent = fileName;
    }
</script>




