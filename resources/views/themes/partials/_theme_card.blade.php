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
                                   value="{{ $theme->brand_color ?? '#f44336' }}"
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
        @if($isEditable)
            <button class="btn btn-success fw-semibold rounded btn-md">Save & Publish</button>
        @else
            <button class="btn btn-success fw-semibold rounded btn-md" disabled>
                Customized Theme (Active)
            </button>
        @endif
    </div>

    <!-- Right Content -->
    <div class="flex-grow-1">
        <!-- Description -->
        <div class="mb-3">
            <label class="form-label fw-semibold fs-5 mb-0">
                {{ $theme->theme_title ?? $theme->name ?? 'No title' }}
            </label>
            @if($isEditable)
                <textarea name="description"
                          class="form-control alert alert-light border mt-2 py-2 small fs-6 lh-lg"
                          rows="2"
                          maxlength="191">{{ $theme->short_description ?? $theme->description ?? 'No description' }}</textarea>
            @else
                <div class="alert alert-light border mt-2 py-2 small fs-6 lh-lg" style="min-height: 80px;">
                    {{ $theme->short_description ?? $theme->description ?? 'No description' }}
                </div>
            @endif
        </div>

        <!-- Visibility -->
        <div class="mb-3">
            <label class="form-label fw-semibold fs-5">Website Visibility</label>
            <div class="form-check form-switch">
                @if($isEditable)
                    <input type="checkbox" name="is_visible" value="1"
                           class="form-check-input"
                        {{ $theme->is_visible ? 'checked' : '' }}>
                @else
                    <input type="checkbox" class="form-check-input" disabled {{ $theme->is_visible ? 'checked' : '' }}>
                @endif
                <label class="form-check-label">
                    {{ $theme->is_visible ? 'On — Your board is live and accessible at [subdomain]' : 'Off — Your board is hidden' }}
                </label>
            </div>
        </div>

        <!-- Password Protection -->
        <div class="mb-3">
            <label class="form-label fw-semibold fs-5">Password Protected</label>
            <div class="form-check form-switch">
                @if($isEditable)
                    <input type="checkbox" id="passwordToggle_{{ $theme->id ?? 'new' }}"
                           name="is_password_protected" value="1"
                           class="form-check-input"
                        {{ $theme->is_password_protected ? 'checked' : '' }}>
                @else
                    <input type="checkbox" class="form-check-input" disabled {{ $theme->is_password_protected ? 'checked' : '' }}>
                @endif
                <label class="form-check-label" for="passwordToggle_{{ $theme->id ?? 'new' }}">
                    {{ $theme->is_password_protected ? 'On (Board is password protected)' : 'Off (Anyone can access your board)' }}
                </label>
            </div>

            @if($isEditable)
                <div id="passwordField_{{ $theme->id ?? 'new' }}" style="{{ $theme->is_password_protected ? '' : 'display:none;' }}">
                    <input type="password" name="password" class="form-control mt-2" placeholder="Enter password">
                </div>
            @endif
        </div>

        <!-- Welcome Message -->
        <div class="mb-3">
            <label class="form-label fw-semibold fs-6">Welcome Message</label>
            @if($isEditable)
                <textarea name="welcome_message"
                          class="form-control alert alert-light border mt-2 py-2 small fs-6 lh-lg"
                          rows="2"
                          maxlength="191">{{ $theme->welcome_message ?? 'Enable password protection to keep your board private.' }}</textarea>
            @else
                <div class="alert alert-light border mt-2 py-2 small fs-6 lh-lg">
                    {{ $theme->welcome_message ?? 'No welcome message added yet.' }}
                </div>
            @endif
        </div>
    </div>
</div>
