@extends('layouts.app')

@section('content')
        <section class="section-content-center w-100 listing-changelog main-content-wrapper p-0">
            <div class="d-flex justify-content-between mb-2">
                <h4 class="fw-medium font-16">{{ isset($board) ? 'Update' : 'New' }} @customLabel('Knowledge Board')</h4>
                <div class="btn-wrapper d-flex align-items-center justify-content-center gap-2 flex-wrap mb-2">
                    <a href="{{ route('board.index') }}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-flex align-items-center gap-2">
                        <img src="{{ asset('assets/img/chevron-left.svg') }}" alt="Back" class="align-text-bottom">
                        Back to Listing Page
                    </a>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 view-changelog-details px-0">
                        <div class="card p-0 bg-white mb-3">
                            <form
                                action="{{ isset($board) ? route('board.update', $board->id) : route('board.store') }}"
                                method="POST"
                            >
                                @csrf
                                @if(isset($board))
                                    @method('PUT')
                                @endif
                                <div class="d-flex align-items-center border-title justify-content-between px-3 py-2">
                                    <h4 class="fw-medium mb-0">{{ isset($board) ? 'Update' : 'New' }} Knowledge Board</h4>
                                    <div class="btn-wrapper mb-0 d-flex align-items-center justify-content-center gap15 flex-wrap">
                                        <a href="{{ route('board.create') }}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Cancel</a>
                                    </div>
                                </div>

                                <div class="mx-auto p-3 pb-0">

                                    <!-- Banner Upload -->
                                    <div class="d-flex justify-content-between pb-2">
                                        <h6>Banner for your board</h6>
                                        <h6 class="color-support fw-normal label">[Optional]</h6>
                                    </div>

                                    <div class="upload-input mb-3">
                                        <input type="file" class="visually-hidden" id="feature-banner" name="banner">
                                        <label for="feature-banner" class="d-block text-center rounded-3">
        <span class="upload-btn d-inline-block rounded fw-semibold mb-2">
            <img src="{{ asset('assets/img/icon/upload.svg') }}" alt="">
        </span>
                                            <h6 class="fw-semibold">Drop files or browse</h6>
                                            <span class="upload-input-text d-block mb-3">
            Format: .jpeg, .png & Max file size: 25 MB
        </span>
                                            <span class="theme-btn sm fw-semibold rounded">Browse Files</span>
                                            <div class="file-name mt-2 text-center fw-medium text-muted"></div>

                                            {{-- If banner exists, show preview --}}
                                            @if(isset($board) && $board->banner)
                                                <div class="mt-2 text-center">
                                                    <img src="{{ asset('storage/' . $board->banner) }}" alt="Banner" class="img-fluid rounded shadow-sm" style="max-height: 120px;">
                                                </div>
                                            @endif
                                        </label>
                                    </div>

                                    <!-- Board Information -->
                                    <div class="basic-information mt-3">
                                        <div class="row">
                                            <!-- Board Name -->
                                            <div class="col-12 mb-3">
                                                <div class="form-input">
                                                    <label for="boardName" class="input-label mb-1 fw-medium">Name</label>
                                                    <input type="text" id="boardName" name="boardName"
                                                           class="input-field w-100 rounded"
                                                           placeholder="Enter board name"
                                                           value="{{ old('boardName', $board->name ?? '') }}"
                                                           required>
                                                </div>
                                            </div>

                                            <!-- Description -->
                                            <div class="col-12 mb-3">
                                                <div class="form-input">
                                                    <label for="boardDesc" class="input-label mb-1 fw-medium">Board Description</label>
                                                    <textarea id="boardDesc" name="boardDesc" rows="3"
                                                              class="input-field w-100 rounded"
                                                              placeholder="Enter description">{{ old('boardDesc', $board->description ?? '') }}</textarea>
                                                </div>
                                            </div>

                                            <!-- Board Type -->
                                            <div class="col-12 mb-3">
                                                <div class="form-input">
                                                    <label for="boardType" class="input-label mb-1 fw-medium">Board Type</label>
                                                    <select class="form-select w-100 border rounded" id="boardType" name="boardType" required>
                                                        <option value="">Select</option>
                                                        <option value="1" {{ old('boardType', $board->type ?? '') == 1 ? 'selected' : '' }}>Public</option>
                                                        <option value="0" {{ old('boardType', $board->type ?? '') == 0 ? 'selected' : '' }}>Private</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Document Type -->
                                            <div class="col-12 mb-3">
                                                <div class="form-input">
                                                    <label for="docsType" class="input-label mb-1 fw-medium">Document Type</label>
                                                    <select class="form-select w-100 border rounded" id="docsType" name="docsType">
                                                        <option value="">Select</option>
                                                        <option value="Help Document" {{ old('docsType', $board->docs_type ?? '') == 'Help Document' ? 'selected' : '' }}>Help Document</option>
                                                        <option value="Manual" {{ old('docsType', $board->docs_type ?? '') == 'Manual' ? 'selected' : '' }}>Manual</option>
                                                        <option value="Requirement Document" {{ old('docsType', $board->docs_type ?? '') == 'Requirement Document' ? 'selected' : '' }}>Requirement Document</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- URL -->
                                            <div class="col-12 mb-3">
                                                <div class="form-input">
                                                    <label for="bublicURL" class="input-label mb-1 fw-medium">Your Knowledge Path URL</label>
                                                    <div class="form-input-group d-flex">
                                                        <input type="button" class="input-field input-btn rounded rounded-end-0 flex-grow-1 text-start"
                                                               value="{{ $tenant->custom_url }}.insighthq.app" readonly>
                                                        <input type="text" id="bublicURL" name="bublicURL"
                                                               class="input-field w-100 flex-shrink-1 rounded rounded-start-0 border-start-0 bg-white"
                                                               placeholder=""
                                                               value="{{ old('bublicURL', $board->public_url ?? '') }}"
                                                               required>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Embed Code -->
                                            <div class="col-12 mb-3">
                                                <div class="form-input">
                                                    <label for="embedCode" class="input-label mb-1 fw-medium">Embed Code</label>
                                                    <textarea id="embedCode" name="embedCode" rows="3"
                                                              readonly
                                                              class="input-field w-100 rounded border-dashed"
                                                              placeholder="Placeholder">{{ old('embedCode', $board->embed_code ?? '') }}</textarea>
                                                    <a href="#" onclick="embedCodeFunction(event)" class="fw-medium label" id="copyBtn">Copy Embed Code</a>
                                                </div>
                                            </div>

                                            <!-- Visibility -->
                                            <div class="col-12 mb-3">
                                                <div class="form-input">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="visibility1" name="visibility"
                                                            {{ old('visibility', $board->is_hidden ?? 0) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="visibility1" id="visibilityLabel">
                                                            Private (Hidden from structure)
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Status -->
                                            <div class="col-12 mb-3">
                                                <div class="form-input">
                                                    <label for="status" class="input-label mb-1 fw-medium">Status</label>
                                                    <select class="form-select w-100 rounded border" id="status" name="status">
                                                        <option value="">Select</option>
                                                        <option value="1" {{ old('status', $board->status ?? '') == 1 ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ old('status', $board->status ?? '') == 0 ? 'selected' : '' }}>Inactive</option>
                                                        <option value="2" {{ old('status', $board->status ?? '') == 2 ? 'selected' : '' }}>Draft</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Info Label -->
                                            <span class="mb-3 label fw-medium" style="color: #CBD5E1;">
                                            <span id="schedulePostInfo" class="mt-3 label fw-medium" style="color: #CBD5E1;">
                                                @customLabel('Knowledge Board') -
                                                Board Status ({{ isset($board) ? ucfirst(['Inactive', 'Active', 'Draft'][$board->status] ?? 'Pending') : 'Pending' }})
                                            </span>
                                        </span>
                                        </div>
                                    </div>

                                    <!-- Form Footer -->
                                    <div class="card-footer gap15 bg-white d-flex justify-content-start"
                                         style="margin: 0 -16px; border-top: 1px solid #e5e7eb;padding-left: 16px;">
                                    <button type="submit" class="theme-btn sm primary fw-semibold rounded d-inline-block">
                                        {{ isset($board) ? 'Update Board' : 'Create Board' }}
                                    </button>
                                    <a href="{{ route('board.index') }}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Cancel</a>
                                    <button type="submit" name="draft" value="1" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Save a Draft</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status');
            const scheduleSpan = document.getElementById('schedulePostInfo');
            const statusMap = {
                '0': 'Inactive',
                '1': 'Active',
                '2': 'Draft'
            };
            statusSelect.addEventListener('change', function() {
                const selectedStatus = this.value;
                if (!selectedStatus) {
                    scheduleSpan.textContent = "Schedule Post - Will get post on time";
                    return;
                }
                const statusLabel = statusMap[selectedStatus] || 'Unknown';
                scheduleSpan.textContent = `Board Status - (${statusLabel} Board)`;
            });
        });

        const fileInput = document.getElementById('feature-banner');
            const fileNameDiv = document.querySelector('.upload-input .file-name');

            fileInput.addEventListener('change', function() {
            if (this.files && this.files.length > 0) {
            fileNameDiv.textContent = this.files[0].name;
        } else {
            fileNameDiv.textContent = '';
        }
        });
        const toggle = document.getElementById("visibility1");
        const label = document.getElementById("visibilityLabel");

        function updateVisibilityLabel() {
            if (toggle.checked) {
                label.textContent = "Private (Hidden from structure)";
            } else {
                label.textContent = "Public (Your board is live and accessible at [subdomain])";
            }
        }
        updateVisibilityLabel();
        toggle.addEventListener("change", updateVisibilityLabel);

        function embedCodeFunction(event) {
            event.preventDefault();
            const embedInput = document.getElementById("embedCode");
            embedInput.select();
            embedInput.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(embedInput.value);
            alert("Embed code copied: " + embedInput.value);
        }
    </script>
@endsection
