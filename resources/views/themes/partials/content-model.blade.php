<div class="modal fade" id="contentSettings_{{ $theme->id }}" tabindex="-1" aria-labelledby="contentSettingsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contentSettingsLabel">Content Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <input type="hidden" name="theme_id" value="{{ $theme->id }}">
                <div class="modal-body overflow-auto" style="max-height: 70vh;">
                        <div class="form-input border-0 p-0 mb-4 mt-2">
                            <label for="page-title" class="input-label mb-1 fw-medium">Page Title</label>
                            <input type="text" id="page-title" name="theme_title"
                                   class="input-field w-100 rounded border"
                                   placeholder="Placeholder"
                                   value="{{ old('theme_title', $userTheme->theme_title ?? '') }}">
                        </div>
                        <div class="form-input border-0 p-0 mb-4">
                            <label for="welcome" class="input-label mb-1 fw-medium">Welcome Message</label>
                            <input type="text" id="welcome" name="welcome_message"
                                   class="input-field w-100 rounded border"
                                   placeholder="Placeholder"
                                   maxlength="191"
                                   value="{{ old('welcome_message', $userTheme->welcome_message ?? '') }}">
                        </div>

                        <div class="form-input border-0 p-0 mb-4">
                            <label for="description" class="input-label mb-1 fw-medium">Short Description</label>

                            <input type="text" id="description" name="short_description"
                                   class="input-field w-100 rounded border"
                                   placeholder="Placeholder"
                                   value="{{ old('short_description', $userTheme->short_description ?? '') }}">
                        </div>
                        <div class="form-input border-0 p-0 mb-4">
                            <label for="theme_flag" class="input-label mb-1 fw-medium">Status</label>
                            @php
                                $status = old('theme_flag', $userTheme->theme_flag ?? 0);
                            @endphp
                            <select id="theme_flag" name="theme_flag" class="input-field w-100 rounded border">
                                <option value="0" {{ $status == 0 ? 'selected' : '' }}>Inactive</option>
                                <option value="1" {{ $status == 1 ? 'selected' : '' }}>Active</option>
                            </select>
                        </div>
                        <div class="form-input border-0 p-0 mb-4">
                        <label for="alignment" class="input-label mb-1 fw-medium">Alignment</label>
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

                <!-- Footer -->
                <div class="modal-footer justify-content-start border-top-0">
                    <button type="button" class="theme-btn fw-semibold rounded border-0" data-bs-dismiss="modal">Save & Continue</button>
                    <button type="button" class="theme-btn secondary bg-white fw-semibold rounded" data-bs-dismiss="modal">Cancel</button>
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
            const passwordLabel = passwordToggle.closest('.form-check').querySelector('.form-check-label');

            if (passwordToggle.checked) {
                passwordLabel.textContent = "Enabled — Anyone can access your board based on its visibility setting.";
            } else {
                passwordLabel.textContent = "Disabled — No one can access your board based on its visibility setting.";
            }

            if (visibility.checked && passwordToggle.checked) {
                alertBox.classList.remove("d-none");
            } else {
                alertBox.classList.add("d-none");
            }
        }

        visibilityToggles.forEach(el => {
            const id = el.id.split("_").pop();
            el.addEventListener("change", () => togglePasswordField(id));
        });

        passwordToggles.forEach(el => {
            const id = el.id.split("_").pop();
            el.addEventListener("change", () => togglePasswordField(id));
        });

        // 🧠 Reset password toggle *before* modal is shown (so user never sees it flip)
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('show.bs.modal', function () {
                const passwordToggle = this.querySelector("[id^='password_toggle_']");
                const visibilityToggle = this.querySelector("[id^='visibility_']");
                const alertBox = this.querySelector("[id^='passwordAlert_']");
                const passwordLabel = this.querySelector('.form-check-label[for^="password_toggle_"]');

                if (passwordToggle) {
                    passwordToggle.checked = false;
                    if (passwordLabel) {
                        passwordLabel.textContent = "Disabled — No one can access your board based on its visibility setting.";
                    }
                }
                if (alertBox) alertBox.classList.add("d-none");
            });
        });

        // Run once to sync state
        visibilityToggles.forEach(el => {
            const id = el.id.split("_").pop();
            togglePasswordField(id);
        });
    });

    function showFileName(id, event) {
        const fileName = event.target.files.length ? event.target.files[0].name : '';
        document.getElementById(`file-name-${id}`).textContent = fileName;
    }
</script>
