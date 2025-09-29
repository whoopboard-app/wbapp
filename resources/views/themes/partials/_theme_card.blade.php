<div class="theme-card d-flex flex-column flex-md-row align-items-start gap-3 p-4 mt-4 rounded border-1 h-100">
    <!-- Left Image -->
    <div>
        <img src="assets/img/icon/theme-card-user.svg"
             alt="{{ $isEditable ? 'Theme' : 'Custom Theme' }}"
             class="theme-img"
             style="width:280px; height:150px;">
        <!-- Brand Color -->
        <div class="mb-3">
            <div class="form-input color-group border-0 ps-0">
                <label for="brand-color" class="input-label mb-1 fw-medium">Brand Color</label>
                <div class="input-group align-items-center">
                    <div class="position-relative">
                        <!-- Circle preview (clickable in editable mode) -->
                        <label for="brandColorPicker_{{ $theme->id ?? 'new' }}"
                               class="position-absolute top-50 start-0 translate-middle-y ms-2 rounded-circle overflow-hidden"
                               style="width:30px; height:30px; cursor:pointer; background-color: {{ $theme->brand_color ?? '#f44336' }};">
                            @if($isEditable)
                                <input
                                    type="color"
                                    id="brandColorPicker_{{ $theme->id ?? 'new' }}"
                                    class="w-100 h-100 border-0 p-0 opacity-0 cursor-pointer"
                                    value="{{ $theme->brand_color ?? '#f44336' }}"
                                    placeholder="Select color or enter hex code"
                                    onchange="document.getElementById('brandColorHex_{{ $theme->id ?? 'new' }}').value=this.value;this.parentNode.style.backgroundColor=this.value"
                                >
                            @endif
                        </label>

                        <!-- Hex field -->
                        @if($isEditable)
                            <input id="brandColorHex_{{ $theme->id ?? 'new' }}"
                                   type="text"
                                   name="brand_color"
                                   class="form-control ps-5 rounded border-[#19140035]"
                                   value="{{ $theme->brand_color ?? '' }}"
                                   placeholder="Select color or enter hex code"
                                   onchange="document.getElementById('brandColorPicker_{{ $theme->id ?? 'new' }}').value=this.value;document.querySelector('label[for=brandColorPicker_{{ $theme->id ?? 'new' }}]').style.backgroundColor=this.value">
                        @else
                            <div class="form-control ps-5 rounded border-[#19140035] bg-light">
                                {{ $theme->brand_color ?? '#f44336' }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Action buttons -->
        @if($theme->theme_flag == '1')
            <button class="btn btn-success fw-semibold rounded btn-md disabled" style="width: 245px;">
                Customized Theme (Active)
            </button>
        @else
            @if(!empty($isCustomized) && $isCustomized)
                <button class="btn btn-success fw-semibold rounded btn-md disabled" style="width: 245px;">
                    Default Theme (Active)
                </button>
            @else
                <button class="btn btn-primary fw-semibold rounded btn-md mt-2" style="width: 245px;"
                        type="submit">
                    Select Default Theme
                </button>

            @endif
        @endif
        <br>
        <button class="btn {{ $isCustomized ? 'btn-primary' : 'btn-secondary' }} fw-semibold rounded btn-md mt-2"
                style="width: 245px;"
                type="button"
                data-bs-toggle="modal"
                data-bs-target="#customizeThemeModal_{{ $theme->id }}"
                @if(!$isCustomized) disabled @endif>
            Customize Theme
        </button>
    </div>

    <!-- Right Content -->
    <div class="flex-grow-1" style="width: 300px">
        <!-- Description -->
        <div class="mb-3">
            <label class="form-label fw-semibold fs-5 mb-0">
                {{ $theme->theme_title ?? $theme->name ?? 'No title' }}
            </label>
            <div class="text-muted alert alert-light small fs-6 border-0 p-0">
                {{ $theme->short_description ?? $theme->description ?? 'No description' }}
            </div>
        </div>
        <!-- Website Visibility -->
        <div class="mb-3">
            <label class="form-label fw-semibold fs-5">Website Visibility</label>
            <div class="form-check form-switch">
                @if($isEditable)
                    <input type="checkbox" id="isVisibleSwitch" name="is_visible" value="1"
                           class="form-check-input"
                        {{ $theme->is_visible ? 'checked' : '' }}>
                @else
                    <input type="checkbox" id="isVisibleSwitch" class="form-check-input" disabled
                        {{ $theme->is_visible ? 'checked' : '' }}>
                @endif

                <label class="form-check-label" id="visibilityLabel">
                    {{ $theme->is_visible
                        ? 'On (Published — Your board is live and accessible at [subdomain])'
                        : 'Off (Not Published — Your board is not live and accessible at [subdomain])' }}
                </label>
            </div>
        </div>
        <!-- Password Protection -->
        <div class="mb-3">
            <label class="form-label fw-semibold fs-5">Password Protected</label>
            <div class="form-check form-switch">
                @if($isEditable)
                    <input type="checkbox" id="passwordToggle"
                           name="is_password_protected" value="1"
                           class="form-check-input"
                        {{ $theme->is_password_protected ? 'checked' : '' }}>
                @else
                    <input type="checkbox" id="passwordToggle" class="form-check-input" disabled
                        {{ $theme->is_password_protected ? 'checked' : '' }}>
                @endif

                <label class="form-check-label" id="passwordLabel">
                    {{ $theme->is_password_protected
                        ? 'On (Enabled — Anyone can access your board based on its visibility setting.)'
                        : 'Off (Disabled — Anyone can access your board based on its visibility setting.)' }}
                </label>
            </div>

            @if($isEditable)
                <div id="passwordField" style="{{ $theme->is_password_protected ? '' : 'display:none;' }}">
                    <div class="input-group mt-2">
                        <input type="password" name="password" id="passwordInput"
                               class="form-control"
                               placeholder="Enter password"
                               value="{{ $theme->password ?? '' }}">
                    </div>
                </div>
            @endif
        </div>


        <!-- Welcome Message -->
        <div class="mb-3">
            <div class="text-muted alert alert-light small fs-6 border">
                {{ $theme->welcome_message ?? 'Enable password protection to keep your board private. Subscribers will be verified by email, and only those with access will receive a secure link to view your subdomain.' }}
            </div>
        </div>
    </div>
</div>
@include('themes.partials.customize-modal', ['userTheme' => $theme])
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const visibleCheckbox = document.getElementById('isVisibleSwitch');
        const visibilityLabel = document.getElementById('visibilityLabel');

        visibleCheckbox.addEventListener('change', function () {
            visibilityLabel.textContent = this.checked
                ? 'On (Published — Your board is live and accessible at [subdomain])'
                : 'Off (Not Published — Your board is not live and accessible at [subdomain])';
        });
        const passwordCheckbox = document.getElementById('passwordToggle');
        const passwordLabel = document.getElementById('passwordLabel');
        const passwordField = document.getElementById('passwordField');

        passwordCheckbox.addEventListener('change', function () {
            if (this.checked) {
                passwordLabel.textContent = 'On (Board is password protected)';
                if (passwordField) passwordField.style.display = '';
            } else {
                passwordLabel.textContent = 'Off (Anyone can access your board)';
                if (passwordField) passwordField.style.display = 'none';
            }
        });
    });
</script>
