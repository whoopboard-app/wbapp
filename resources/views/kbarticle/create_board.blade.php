@extends('layouts.app')

@section('content')
        <section class="section-content-center w-100 listing-changelog main-content-wrapper p-0">
            <div class="d-flex justify-content-between mb-2">
                <h4 class="fw-medium font-16">Add @customLabel('Knowledge Board')</h4>
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
                            <form action="{{ route('board.store') }}" method="POST" class="form">
                                @csrf

                                <div class="d-flex align-items-center border-title justify-content-between px-3 py-2">
                                    <h4 class="fw-medium mb-0">New Knowledge Board</h4>
                                    <div class="btn-wrapper mb-0 d-flex align-items-center justify-content-center gap15 flex-wrap">
                                        <a href="{{ route('board.create') }}" class="theme-btn bg-white sm secondary fw-semibold rounded d-inline-block">Cancel</a>
                                    </div>
                                </div>

                                <div class="mx-auto p-3">

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
                                            <span class="upload-input-text d-block mb-3">Format: .jpeg, .png & Max file size: 25 MB</span>
                                            <span class="theme-btn sm fw-semibold rounded">Browse Files</span>
                                            <div class="file-name mt-2 text-center fw-medium text-muted"></div>
                                        </label>
                                    </div>
                                    <!-- Board Information -->
                                    <div class="basic-information mt-3">
                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <div class="form-input">
                                                    <label for="boardName" class="input-label mb-1 fw-medium">Name</label>
                                                    <input type="text" id="boardName" name="boardName"
                                                           class="input-field w-100 rounded"
                                                           placeholder="Enter board name"
                                                           required>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-3">
                                                <div class="form-input">
                                                    <label for="boardDesc" class="input-label mb-1 fw-medium">Board Description</label>
                                                    <textarea id="boardDesc" name="boardDesc" rows="3" class="input-field w-100 rounded" placeholder="Enter description"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-3">
                                                <div class="form-input">
                                                    <label for="boardType" class="input-label mb-1 fw-medium">Board Type</label>
                                                    <select class="form-select w-100 border rounded" id="boardType" name="boardType" required>
                                                        <option value="">Select</option>
                                                        <option value="1">Public</option>
                                                        <option value="0">Private</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12 mb-3">
                                                <div class="form-input">
                                                    <label for="docsType" class="input-label mb-1 fw-medium">Document Type</label>
                                                    <select class="form-select w-100 border rounded" id="docsType" name="docsType">
                                                        <option value="">Select</option>
                                                        <option value="Help Document">Help Document</option>
                                                        <option value="Manual">Manual</option>
                                                        <option value="Requirement Document">Requirement Document</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <div class="form-input">
                                                    <label for="bublicURL" class="input-label mb-1 fw-medium">Your Knowledge Path URL</label>
                                                    <div class="form-input-group d-flex">
                                                        <input type="button" class="input-field input-btn rounded rounded-end-0 flex-grow-1 text-start"
                                                               value="{{ $tenant->custom_url }}.insighthq.app" readonly>
                                                        <input type="text" id="bublicURL" name="bublicURL"
                                                               class="input-field w-100 flex-shrink-1 rounded rounded-start-0 border-start-0 bg-white"
                                                               placeholder="" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-input">
                                                    <label for="embedCode" class="input-label mb-1 fw-medium">Embed Code</label>
                                                    <textarea id="embedCode" name="embedCode" rows="3" readonly class="input-field w-100 rounded border-dashed" placeholder="Placeholder"></textarea>
                                                    <a href="#" onclick="embedCodeFunction(event)" class="fw-medium label" id="copyBtn">Copy Embed Code</a>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-input">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="visibility1" name="visibility">
                                                        <label class="form-check-label" for="visibility1" id="visibilityLabel">
                                                            Private (Hidden from structure)
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-input">
                                                    <label for="status" class="input-label mb-1 fw-medium">
                                                        Status
                                                    </label>
                                                    <select class="form-select w-100 rounded border" id="status" name="status">
                                                        <option value="">Select</option>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                        <option value="2">Draft</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <span class="mt-3 label fw-medium" style="color: #CBD5E1;"><span id="schedulePostInfo" class="mt-3 label fw-medium" style="color: #CBD5E1;">
    @customLabel('Knowledge Board') - Board Status (Pending)
</span></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Footer -->
                                <div class="card-footer gap15 px-3 bg-white d-flex justify-content-start">
                                    <button type="submit" class="theme-btn sm fw-semibold rounded d-inline-block">Save</button>
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
